<?php

namespace Framework\Renderer;

class PHPRenderer
{
	/**
	 * Contain all path
	 *
	 * @var array
	 */
	private $paths = [];

	/**
	 *  Contain globals vars
	 *
	 * @var array
	 */
	private $globals = [];

	/**
	 * Default name of namespace 
	 */
	const DEFAULT_RENDERER_NAMESPACE = 'MAIN';
	
	/**
	 * Adding path with path
	 *
	 * @param string $namespace
	 * @param String|null $path
	 * @return void
	 */
	public function addPath(String $namespace, ?String $path = null): void
	{
		//??? review this systeme beacause is dirty to assigne the render
		if (is_null($path))
		{
			$this->paths[self::DEFAULT_RENDERER_NAMESPACE] = $namespace;
		}
		else
		{
			$this->paths[$namespace] = $path;
		}
	}

	/**
	 * Undocumented function
	 *
	 * @param String $path
	 * @return Void
	 */
	public function addGlobals($var): Void
	{
		$this->globals[] = $var;
	}

	/**
	 * Renderign a view with parameters
	 *
	 * @param String $view
	 * @param Array $params
	 * @return String
	 */
	public function render(String $view, Array $params = []): String
	{
		if ($this->hasNamespace($view))
		{
			$file = $this->replaceNamespace($view) . '.php';
		}
		else
		{
			$file = $this->paths[self::DEFAULT_RENDERER_NAMESPACE] . DIRECTORY_SEPARATOR . $view . '.php';
		}
		
		ob_start();// start cache
		$renderer = $this; //return the renderer instance
		extract($globals);
		extract($params);
		require($file);
		return ob_get_clean(); //return cache
	}

	/**
	 * If view is the namespace
	 *
	 * @param String $view
	 * @return Bool
	 */
	private function hasNamespace(String $view): Bool
	{
        return ($view[0] === '@');
	}
	
	/**
	 * Get the namespace
	 *
	 * @param String $view
	 * @return String
	 */
	private function getNamespace(String $view): String
	{
        return substr($view, 1, strpos($view, '/') - 1);
	}
	
	/**
	 * Replaces @ with namspace
	 *
	 * @param String $view
	 * @return String
	 */
	private function replaceNamespace(String $view): String
	{
        $namespace = $this->getNamespace($view);
        return str_replace('@' . $namespace, $this->paths[$namespace], $view);
    }

}
