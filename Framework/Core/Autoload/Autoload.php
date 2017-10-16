<?php
// namespace Framework\Core\Autoload;
/**
 * ClassLoader implements a PSR-4 and classmap class loader.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Jordi Boggiano <j.boggiano@seld.be>
 * @see    http://www.php-fig.org/psr/psr-4/
 */
class Autoloader
{
    // PSR-4
    private $prefixLengthsPsr4 = [];
    private $prefixDirsPsr4 = [];
    private $fallbackDirsPsr4 = [];
	
    private $useIncludePath = false;
    private $classMap = [];
    private $classMapAuthoritative = false;
    private $missingClasses = [];
	

    /**
     * @param array $classMap Class to filename map
     */
    public function addClassMap(array $classMap)
    {
        if ($this->classMap) {
            $this->classMap = array_merge($this->classMap, $classMap);
        } else {
            $this->classMap = $classMap;
        }
    }

    /**
     * Registers a set of PSR-4 directories for a given namespace, either
     * appending or prepending to the ones previously set for this namespace.
     *
     * @param string       $prefix  The prefix/namespace, with trailing '\\'
     * @param array|string $paths   The PSR-4 base directories
     * @param bool         $prepend Whether to prepend the directories
     *
     * @throws \InvalidArgumentException
     */
    public function addPsr4($prefix, $paths, $prepend = false)
    {
        if (!$prefix) {
            // Register directories for the root namespace.
            if ($prepend) {
                $this->fallbackDirsPsr4 = array_merge(
                    (array) $paths,
                    $this->fallbackDirsPsr4
                );
            } else {
                $this->fallbackDirsPsr4 = array_merge(
                    $this->fallbackDirsPsr4,
                    (array) $paths
                );
            }
        } elseif (!isset($this->prefixDirsPsr4[$prefix])) {
            // Register directories for a new namespace.
            $length = strlen($prefix);
            if ('\\' !== $prefix[$length - 1]) {
                throw new \InvalidArgumentException("A non-empty PSR-4 prefix must end with a namespace separator.");
            }
            $this->prefixLengthsPsr4[$prefix[0]][$prefix] = $length;
            $this->prefixDirsPsr4[$prefix] = (array) $paths;
        } elseif ($prepend) {
            // Prepend directories for an already registered namespace.
            $this->prefixDirsPsr4[$prefix] = array_merge(
                (array) $paths,
                $this->prefixDirsPsr4[$prefix]
            );
        } else {
            // Append directories for an already registered namespace.
            $this->prefixDirsPsr4[$prefix] = array_merge(
                $this->prefixDirsPsr4[$prefix],
                (array) $paths
            );
        }
    }

    /**
     * Registers a set of PSR-0 directories for a given prefix,
     * replacing any others previously set for this prefix.
     *
     * @param string       $prefix The prefix
     * @param array|string $paths  The PSR-0 base directories
     */
    public function set($prefix, $paths)
    {
        if (!$prefix) {
            $this->fallbackDirsPsr0 = (array) $paths;
        } else {
            $this->prefixesPsr0[$prefix[0]][$prefix] = (array) $paths;
        }
    }

    /**
     * Registers a set of PSR-4 directories for a given namespace,
     * replacing any others previously set for this namespace.
     *
     * @param string       $prefix The prefix/namespace, with trailing '\\'
     * @param array|string $paths  The PSR-4 base directories
     *
     * @throws \InvalidArgumentException
     */
    public function setPsr4($prefix, $paths)
    {
        if (!$prefix) {
            $this->fallbackDirsPsr4 = (array) $paths;
        } else {
            $length = strlen($prefix);
            if ('\\' !== $prefix[$length - 1]) {
                throw new \InvalidArgumentException("A non-empty PSR-4 prefix must end with a namespace separator.");
            }
            $this->prefixLengthsPsr4[$prefix[0]][$prefix] = $length;
            $this->prefixDirsPsr4[$prefix] = (array) $paths;
        }
    }

    /**
     * Registers this instance as an autoloader.
     *
     * @param bool $prepend Whether to prepend the autoloader or not
     */
    public function register($prepend = false)
    {
        spl_autoload_register(array($this, 'loadClass'), true, $prepend);
    }

    /**
     * Unregisters this instance as an autoloader.
     */
    public function unregister()
    {
        spl_autoload_unregister(array($this, 'loadClass'));
    }

    /**
     * Loads the given class or interface.
     *
     * @param  string    $class The name of the class
     * @return bool|null True if loaded, null otherwise
     */
    public function loadClass($class)
    {        
        if ($file = $this->findFile($class)) {
            includeFile($file);

            return true;
        }
    }

    /**
     * Finds the path to the file where the class is defined.
     *
     * @param string $class The name of the class
     *
     * @return string|false The path if found, false otherwise
     */
    public function findFile($class)
    {
        // class map lookup
        if (isset($this->classMap[$class])) {
            return $this->classMap[$class];
        }
        if ($this->classMapAuthoritative || isset($this->missingClasses[$class])) {
            return false;
        }      
        
        $file = $this->findFileWithExtension($class, '.php');

        if (false === $file) {
            // Remember that this class does not exist.
            $this->missingClasses[$class] = true;
        }

        return $file;
    }

    private function findFileWithExtension($class, $ext)
    {
        // PSR-4 lookup
        $logicalPathPsr4 = strtr($class, '\\', DIRECTORY_SEPARATOR) . $ext;
        $first = $class[0];
        
        if (isset($this->prefixLengthsPsr4[$first])) {
            $subPath = $class;
            while (false !== $lastPos = strrpos($subPath, '\\')) {
                $subPath = substr($subPath, 0, $lastPos);
                $search = $subPath.'\\';
                if (isset($this->prefixDirsPsr4[$search])) {
                    foreach ($this->prefixDirsPsr4[$search] as $dir) {
                        $length = $this->prefixLengthsPsr4[$first][$search];
                        if (file_exists($file = $dir . DIRECTORY_SEPARATOR . substr($logicalPathPsr4, $length))) {
                            return $file;
                        }
                    }
                }
            }
        }
        
        if (file_exists($file = $logicalPathPsr4)) {
            return $file;
        }

        // PSR-4 fallback dirs
        foreach ($this->fallbackDirsPsr4 as $dir) {
            if (file_exists($file = $dir . DIRECTORY_SEPARATOR . $logicalPathPsr4)) {
                return $file;
            }
		}
		
        return false;
    }
}

/**
 * Scope isolated include.
 *
 * Prevents access to $this/self from included files.
 */
function includeFile($file)
{
    include $file;
}
