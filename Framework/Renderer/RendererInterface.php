<?php

namespace Framework\Renderer;

interface Renderer
{	
	/**
	 * Adding path with path
	 *
	 * @param string $namespace
	 * @param String|null $path
	 * @return void
	 */
	public function addPath(String $namespace, ?String $path = null): Void;

	/**
	 * Add globals var
	 *
	 * @param String $path
	 * @return Void
	 */
	public function addGlobals(String $path): Void;

	/**
	 * Renderign a view with parameters
	 *
	 * @param String $view
	 * @param Array $params
	 * @return String
	 */
	public function render(String $view, Array $params = []): String;


}
