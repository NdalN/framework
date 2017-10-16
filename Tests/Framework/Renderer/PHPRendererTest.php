<?php
//namespace Test\Framework\Renderer;

use Framework\Test\UnitTest;
use Framework\Renderer\PHPRenderer;

class PHPRendererTest extends UnitTest
{
	/**
	 * Renderer instance
	 *
	 * @var Renderer
	 */
	private $Renderer;

	public function initTestEnvironement()
	{
		$this->Renderer = new PHPRenderer;
	}

	private function testRenderTheRightPath()
	{
		$this->Renderer->addPath('blog', __DIR__ . '/Views');
		$content = $this->Renderer->render('@blog/demo');

		$this->testEquals('Hello test', $content);
	}

	private function testRenderTheDefaultPath()
	{
		$this->Renderer->addPath( __DIR__ . '/Views');
		$content = $this->Renderer->render('@blog/demo');

		$this->testEquals('Hello test', $content);
	}
}
