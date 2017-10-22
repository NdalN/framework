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

		var_dump('Class name : ' . get_class($this));

		$methods = get_class_methods(get_class($this));
		$testMethods = get_class_methods(get_class());

		foreach ($methods as $method)
		{
			//If methods is a methods of current class don't test it
			if (in_array($method, $testMethods))
			{
				continue;
			}

			if (is_callable([$this, 'initTestEnvironement'])) {
				$this->initTestEnvironement();
			}
			
			
			if (is_callable([$this, $method]) && ($method != '__construct'))
			{
				var_dump($method);
				$this->$method();
			}
		}
	}

	/**
	 * Passesed if value is true
	 *
	 * @param boolean $value test value
	 * @param string $message message display if test faild
	 */
	public function testTrue(Boolean $value, String $message = '', $name = __FUNCTION__, $file =__FILE__, $line = __LINE__)
	{
		if (is_bool($value) && $value)
		{
			$this->TestClass->testSucces($name , $file , $line, __FUNCTION__, $message);
		}
		else
		{
			$this->TestClass->testFaild($name , $file , $line, __FUNCTION__, $message);
		}		
	}

	/**
	 * Passesed if value is false
	 *
	 * @param boolean $value
	 * @param string $message message display if test faild
	 */
	public function testFalse(Boolean $value, String $message = '', $name = __FUNCTION__, $file =__FILE__, $line = __LINE__)
	{
		if (is_bool($value) && !$value)
		{
			$this->TestClass->testSucces($name , $file , $line, __FUNCTION__, $message);
		}
		else
		{
			$this->TestClass->testFaild($name , $file , $line, __FUNCTION__, $message);
		}
	}

	/**
	 * Passesed if $referenceValue == $toTestValue
	 *
	 * @param boolean $referenceValue valid value
	 * @param mixed $toTestValue value to test
	 * @param mixed $message message display if test faild
	 */
	public function testEquals(mixed $referenceValue, mixed $toTestValue, string $message = '', $name = __FUNCTION__, $file =__FILE__, $line = __LINE__)
	{
		if ($referenceValue == $toTestValue)
		{
			$this->TestClass->testSucces($name , $file , $line, __FUNCTION__, $message);
		}
		else
		{
			$this->TestClass->testFaild($name , $file , $line, __FUNCTION__, $message);
		}
	}
	
	/**
	 * Passesed if $referenceValue != $toTestValue
	 *
	 * @param boolean $referenceValue valid value
	 * @param mixed $toTestValue value to test
	 * @param mixed $message message display if test faild
	 */
	public function testNotEquals(mixed $referenceValue, mixed $toTestValue, string $message = '', $name = __FUNCTION__, $file =__FILE__, $line = __LINE__)
	{
		if ($referenceValue != $toTestValue)
		{
			$this->TestClass->testSucces($name , $file , $line, __FUNCTION__, $message);
		}
		else
		{
			$this->TestClass->testFaild($name , $file , $line, __FUNCTION__, $message);
		}
	}

	/**
	 * Passesed if $referenceValue === $toTestValue
	 *
	 * @param boolean $referenceValue valid value
	 * @param mixed $toTestValue value to test
	 * @param mixed $message message display if test faild
	 */
	public function testSame(mixed $referenceValue, mixed $toTestValue, string $message = '', $name = __FUNCTION__, $file =__FILE__, $line = __LINE__)
	{
		if ($referenceValue === $toTestValue)
		{
			$this->TestClass->testSucces($name , $file , $line, __FUNCTION__, $message);
		}
		else
		{
			$this->TestClass->testFaild($name , $file , $line, __FUNCTION__, $message);
		}
	}

	/**
	 * Passesed if $referenceValue !== $toTestValue
	 *
	 * @param boolean $referenceValue valid value
	 * @param mixed $toTestValue value to test
	 * @param mixed $message message display if test faild
	 */
	public function testNotSame(mixed $referenceValue, mixed $toTestValue, string $message = '', $name = __FUNCTION__, $file =__FILE__, $line = __LINE__)
	{
		if ($referenceValue !== $toTestValue)
		{
			$this->TestClass->testSucces($name , $file , $line, __FUNCTION__, $message);
		}
		else
		{
			$this->TestClass->testFaild($name , $file , $line, __FUNCTION__, $message);
		}
	}

	/**
	 * Passesed if $referenceValue is contains in $toTestValue
	 *
	 * @param boolean $referenceValue valid value
	 * @param mixed $toTestValue value to test
	 * @param mixed $message message display if test faild
	 */
	public function testContains(mixed $value, array $arr, string $message = '', $name = __FUNCTION__, $file =__FILE__, $line = __LINE__)
	{
		if (in_array($toTestValue ,$referenceValue))
		{
			$this->TestClass->testSucces($name , $file , $line, __FUNCTION__, $message);
		}
		else
		{
			$this->TestClass->testFaild($name , $file , $line, __FUNCTION__, $message);
		}
	}

	/**
	 * Passesed if $referenceValue is not contains in $toTestValue
	 *
	 * @param boolean $referenceValue valid value
	 * @param mixed $toTestValue value to test
	 * @param mixed $message message display if test faild
	 */
	public function testNotContains(mixed $value, array $arr, string $message = '', $name = __FUNCTION__, $file =__FILE__, $line = __LINE__)
	{
		if (!in_array($toTestValue ,$referenceValue))
		{
			$this->TestClass->testSucces($name , $file , $line, __FUNCTION__, $message);
		}
		else
		{
			$this->TestClass->testFaild($name , $file , $line, __FUNCTION__, $message);
		}
	}
}
