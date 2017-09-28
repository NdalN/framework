<?php
/**
 * An example of a general-purpose implementation that includes the optional
 * functionality of allowing multiple base directories for a single namespace
 * prefix.
 */
class Autoloader
{
    /**
     * 
     *
     * @var array
     */
    protected $namespaceMapping = [];

    /**
     * Register loader with SPL autoloader stack.
     *
     * @return void
     */
    public function register()
    {
        spl_autoload_register(array($this, 'loadClass'));
    }

    /**
     * Adds a base directory for a namespace .
     *
     * @param string $prefix The namespace prefix.
     * @param string $base_dir A base directory for class files in the namespace.
     * 
     * @return void
     */
    public function addNamespace($namespace, $realDir)
    {
        $this->namespaceMapping[$namespace] = $realDir;
    }

    /**
     * Loads the class file for a given class name.
     *
     * @param string $class The fully-qualified class name.
     * @return mixed The mapped file name on success, or boolean false on
     * failure.
     */
    public function loadClass($inputNamespace)
    {
        $path = $inputNamespace;


        foreach ($this->namespaceMapping as $namespace => $path)
        {
            if (preg_match('#^'.$namespace.'#', $inputNamespace))
            {
                $path = preg_replace($namespace, $path, $inputNamespace);
                break;
            }
        }
    
        $filename = str_replace('\\', '/', $path).'.php';
        var_dump($path, $filename, $inputNamespace);
    
        if (is_readable($filename)) {
            require $filename;
        } else {
            echo "<h1>Want to load $filename</h1>\n\n\n";
        }
    }
}