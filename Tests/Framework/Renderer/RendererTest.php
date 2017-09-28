<?php
namespace Test\Framework\Renderer;

use Framework\Test\UnitTest;

use Framework\Renderer\Renderer;

class RendererTest extends UnitTest
{
	/**
	 * Renderer instance
	 *
	 * @var Renderer
	 */
	private $Renderer;

	public function initTestEnvironement()
	{
		$this->Renderer = new Renderer;
	}

	
}
