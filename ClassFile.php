<?php
namespace Gbili;

require_once 'ClassNameHelper.php';

class ClassFile
{
    protected $path;
    protected $base_name;
    protected $class_name;

    public function __construct($path, $base_name, $class_name = null)
    {
        $this->path = $path;
        $this->base_name = $base_name;
        if (null !== $class_name) {
            $this->class_name = $class_name;
        }
    }

    public function respects_naming_convention($regex = '/^[A-Z][A-Za-z]*\.php$/')
    {
        $ret = preg_match($regex, $this->get_base_name());
        return $ret !== 0 && $ret !== false;
    }

    public function require_class($throw = true)
    {
        require_once $this->get_file_path();
        if (class_exists($this->get_class_name())) {
            return true;
        }
        if ($throw) {
            throw new Exception('Expected class: ' . $this->get_class_name() . ', not found in : ' . $this->get_file_path());
        }
        return false; 
    }

    public function get_file_path()
    {
        return $this->get_path() . DIRECTORY_SEPARATOR . $this->get_base_name();
    }

    public function get_path()
    {
        return $this->path;
    }

    public function get_base_name()
    {
        return $this->base_name;
    }

    public function get_class_name()
    {
        if (null === $this->class_name) {
            $class_name = substr($this->get_base_name(), 0, -4);
            if(!$this->class_name = \Gbili\ClassNameHelper::namespace_until_class_exists($class_name, $this->get_path())) {
                throw new \Exception('It looks like the class file is not conventional. Cannot get the class name from the file name: ' . $class_name . '. Path is: ' . $this->get_path());
            }
        }
        return $this->class_name;
    }
}
