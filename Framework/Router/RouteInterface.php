<?php

namespace Framework\Router\;

/**
 * Class View
 * Permet d'intéragir avec la gestion de template (ici Twig).
 */
interface RouteInterface
{
	public function getName(): String;

	public function getCallback(): Callable;

	public function getParams(): Array;

	public function addParam(String $name, String $regex);

	public function setParams(Array $params);


}
