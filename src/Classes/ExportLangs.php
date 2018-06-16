<?php

namespace YazeedObaid\Lang\Classes;


use YazeedObaid\Lang\Events\LaravelLangExported;

class ExportLangs implements \JsonSerializable
{
    /**
     * @var $strings array
     */
    protected $strings = [];

    /**
     * @var $strings string
     */
    protected $phpRegex = '/^.+\.php$/i';

    /**
     * @var $strings string
     */
    protected $excludePath = DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR;


    /**
     * Method to return generate array with contents of parsed language files
     *
     * @return object
     */
    public function export()
    {
        $files = [];
        $packagesAliases = array_keys(config('laravel-lang.files_to_exclude'));

        // Loop through the paths array in config
        foreach (config('laravel-lang.paths') as $name => $path) {

            // Get the languages files for the package specified
            $packageFiles = $this->findLanguageFiles(base_path() . $path);

            // If package name in exclude array, then use that name to filter out
            // the files specified.
            if (in_array($name, $packagesAliases)) {

                $packageFiles = $this->excludeFiles($packageFiles, $name);

            }

            // Merge filtered out files to final files list

            array_walk($packageFiles, [$this, 'parseLangFiles'], $name);
            $files = array_merge_recursive($files, $packageFiles);
        }


        event(new LaravelLangExported($this->strings));

        return $this;
    }


    /**
     * Method to exclude files from each package
     *
     * @param $files
     * @param $name
     * @return mixed
     */
    public function excludeFiles($files, $name)
    {
        // filter out the files in the exclude array obtained from config file
        foreach (config('laravel-lang.files_to_exclude.' . $name) as $file) {
            $files = array_filter($files, function ($element) use ($file) {

                return !preg_match("/$file.php/", $element);

            });
        }

        return $files;
    }

    /**
     * Method to return array for json serialization
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->strings;
    }

    /**
     * Method to return array
     *
     * @return array
     */
    public function toArray()
    {
        return $this->strings;
    }

    /**
     * Method to return array as collection
     *
     * @return \Illuminate\Support\Collection
     */
    public function toCollection()
    {
        return collect($this->strings);
    }

    /**
     * Find available language files and parse them to array
     *
     * @param string $path
     *
     * @return array
     */
    protected function findLanguageFiles($path)
    {
        // Loop through directories
        $dirIterator = new \RecursiveDirectoryIterator($path, \RecursiveDirectoryIterator::SKIP_DOTS);
        $recIterator = new \RecursiveIteratorIterator($dirIterator);

        // Fetch only php files - skip others
        $phpFiles = array_values(
            array_map('current',
                iterator_to_array(
                    new \RegexIterator($recIterator, $this->phpRegex, \RecursiveRegexIterator::GET_MATCH)
                )
            )
        );

        // Sort array by filepath
        sort($phpFiles);

        // Fetch non-vendor files from filtered php files
        $langsFiles = array_filter($phpFiles, function ($file) {
            return strpos($file, $this->excludePath) === false;
        });

        // Fetch vendor files from filtered php files

        return array_values($langsFiles);
    }

    /**
     * Method to parse language files
     *
     * @param string $file
     * @param string $index
     * @param string $name
     */
    protected function parseLangFiles($file, $index, $name)
    {
        // Base package name without file ending
        $packageName = basename($file, '.php');

        // Get package, language and file contents from language file
        $fileContents = require($file);

        // Remove full path from items
        $file = str_replace(base_path(), '', $file);

        $language = explode(DIRECTORY_SEPARATOR, $file)[1];

        // Check if language already exists in array
        if (array_key_exists($language, $this->strings)) {
            $this->strings[$language][$name][$packageName] = $fileContents;
        } else {
            $this->strings[$language][$name] = [
                $packageName => $fileContents
            ];
        }

    }
}
