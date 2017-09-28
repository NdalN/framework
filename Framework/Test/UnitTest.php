<?php
namespace Framework\Test;

class UnitTest
{
	/**
	 * MainTestClass
	 *
	 * @var Instance of MainTestClass
	 */
	private $TestClass;

	/**
	 * Constructor
	 */
	public function __construct($Test)
	{
		$this->TestClass = $Test;

		var_dump($this);

		if (is_callable([$this, 'initTestEnvironement'])) {
			$this->initTestEnvironement();
		}

		foreach ($this as $element)
		{
			if (is_callable($element))
			{
				$element($this);
			}
		}
	}

	/**
	 * Passesed if value is true
	 *
	 * @param boolean $value test value
	 * @param string $message message display if test faild
	 */
	public function testTrue(boolean $value, string $message = '', $name = __FUNCTION__, $file =__FILE__, $line = __LINE__)
	{
		if (is_bool($value) && $value)
		{
			$this->TestClass->testSucces($name , $file , $line, __FUNCTION__, $message);
		}
		else
		{
			$this->TestClass->testFaild($name , __FUNCTION__, $message);
		}		
	}

	/**
	 * Passesed if value is false
	 *
	 * @param boolean $value
	 * @param string $message message display if test faild
	 */
	public function testFalse(boolean $value, string $message = '')
	{
		if (is_bool($value) && !$value)
		{
			$this->TestClass->test;
		}
		else
		{
			$this->TestClass->test;
		}
	}

	/**
	 * Passesed if $referenceValue == $toTestValue
	 *
	 * @param boolean $referenceValue valid value
	 * @param mixed $toTestValue value to test
	 * @param mixed $message message display if test faild
	 */
	public function testEquals(mixed $referenceValue, mixed $toTestValue, string $message = '')
	{
		if ($referenceValue == $toTestValue)
		{
			$this->TestClass->test;
		}
		else
		{
			$this->TestClass->test;
		}
	}
	
	/**
	 * Passesed if $referenceValue != $toTestValue
	 *
	 * @param boolean $referenceValue valid value
	 * @param mixed $toTestValue value to test
	 * @param mixed $message message display if test faild
	 */
	public function testNotEquals(mixed $referenceValue, mixed $toTestValue, string $message = '')
	{
		if ($referenceValue != $toTestValue)
		{
			$this->TestClass->test;
		}
		else
		{
			$this->TestClass->test;
		}
	}

	/**
	 * Passesed if $referenceValue === $toTestValue
	 *
	 * @param boolean $referenceValue valid value
	 * @param mixed $toTestValue value to test
	 * @param mixed $message message display if test faild
	 */
	public function testSame(mixed $referenceValue, mixed $toTestValue, string $message = '')
	{
		if ($referenceValue === $toTestValue)
		{
			$this->TestClass->test;
		}
		else
		{
			$this->TestClass->test;
		}
	}

	/**
	 * Passesed if $referenceValue !== $toTestValue
	 *
	 * @param boolean $referenceValue valid value
	 * @param mixed $toTestValue value to test
	 * @param mixed $message message display if test faild
	 */
	public function testNotSame(mixed $referenceValue, mixed $toTestValue, string $message = '')
	{
		if ($referenceValue !== $toTestValue)
		{
			$this->TestClass->test;
		}
		else
		{
			$this->TestClass->test;
		}
	}

	/**
	 * Passesed if $referenceValue is contains in $toTestValue
	 *
	 * @param boolean $referenceValue valid value
	 * @param mixed $toTestValue value to test
	 * @param mixed $message message display if test faild
	 */
	public function testContains(mixed $value, array $arr, string $message = '')
	{
		if (in_array($toTestValue ,$referenceValue))
		{
			$this->TestClass->test;
		}
		else
		{
			$this->TestClass->test;
		}
	}

	/**
	 * Passesed if $referenceValue is not contains in $toTestValue
	 *
	 * @param boolean $referenceValue valid value
	 * @param mixed $toTestValue value to test
	 * @param mixed $message message display if test faild
	 */
	public function testNotContains(mixed $value, array $arr, string $message = '')
	{
		if (!in_array($toTestValue ,$referenceValue))
		{
			$this->TestClass->test;
		}
		else
		{
			$this->TestClass->test;
		}
	}
}
