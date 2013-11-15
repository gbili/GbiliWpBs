<?php

require_once __DIR__ . '/GbiliClassFile.php';

class GbiliClassDir
{
    protected $dir_iterator;
    protected $files;
    protected $required_classes;

    public function __construct($dir_path)
    {
        //realpath(dirname(__FILE__) . '/src')
        $this->dir_iterator = new \DirectoryIterator($dir_path);
    }

    public function require_classes()
    {
        if (null === $this->required_classes) {
            $required_classes = array();
            foreach ($this->get_files() as $file) {
                if ($file->require_class(false)) {
                    $required_classes[] = $file->get_class_name();
                }
            }
        }
        return $this->required_classes = $required_classes;
    }

    public function get_required_classes()
    { 
        if (null === $this->required_classes) {
            $this->require_classes();
        }
        return $this->required_classes;
    }

    public function all_files_contain_classes()
    {
        return count($this->get_files()) === count($this->get_required_classes());
    }

    public function get_files($file_name_regex = '/^[A-Z][A-Za-z]*\.php$/')
    {
        if (null !== $this->files) {
            return $this->files;
        }
        $files = array();
        foreach ($this->dir_iterator as $item) {
            if (!$item->isFile()) continue;
            $file = new GbiliClassFile($item->getPath(), $item->getBasename());
            if ($file->respects_naming_convention($file_name_regex)) {
                $files[] = $file;
            }
        }
        return $this->files = $files;
    }
}
