<?php

class UnitTest
{
	/**
	 * Passesed if value is true
	 *
	 * @param boolean $value test value
	 * @param string $message message display if test faild
	 */
	protected function TestTrue(boolean $value, string $message = '')
	{
		if (is_bool($value) && $value)
		{
			# code...
		}
		else
		{
			# code...
		}		
	}

	/**
	 * Passesed if value is false
	 *
	 * @param boolean $value
	 * @param string $message message display if test faild
	 */
	protected function TestFalse(boolean $value, string $message = '')
	{
		if (is_bool($value) && !$value)
		{
			# code...
		}
		else
		{
			# code...
		}
	}

	/**
	 * Passesed if $referenceValue == $toTestValue
	 *
	 * @param boolean $referenceValue valid value
	 * @param mixed $toTestValue value to test
	 * @param mixed $message message display if test faild
	 */
	protected function TestEquals(mixed $referenceValue, mixed $toTestValue, string $message = '')
	{
		if ($referenceValue == $toTestValue)
		{
			# code...
		}
		else
		{
			# code...
		}
	}
	
	/**
	 * Passesed if $referenceValue != $toTestValue
	 *
	 * @param boolean $referenceValue valid value
	 * @param mixed $toTestValue value to test
	 * @param mixed $message message display if test faild
	 */
	protected function TestNotEquals(mixed $referenceValue, mixed $toTestValue, string $message = '')
	{
		if ($referenceValue != $toTestValue)
		{
			# code...
		}
		else
		{
			# code...
		}
	}

	/**
	 * Passesed if $referenceValue === $toTestValue
	 *
	 * @param boolean $referenceValue valid value
	 * @param mixed $toTestValue value to test
	 * @param mixed $message message display if test faild
	 */
	protected function TestSame(mixed $referenceValue, mixed $toTestValue, string $message = '')
	{
		if ($referenceValue === $toTestValue)
		{
			# code...
		}
		else
		{
			# code...
		}
	}

	/**
	 * Passesed if $referenceValue !== $toTestValue
	 *
	 * @param boolean $referenceValue valid value
	 * @param mixed $toTestValue value to test
	 * @param mixed $message message display if test faild
	 */
	protected function TestNotSame(mixed $referenceValue, mixed $toTestValue, string $message = '')
	{
		if ($referenceValue !== $toTestValue)
		{
			# code...
		}
		else
		{
			# code...
		}
	}

	/**
	 * Passesed if $referenceValue is contains in $toTestValue
	 *
	 * @param boolean $referenceValue valid value
	 * @param mixed $toTestValue value to test
	 * @param mixed $message message display if test faild
	 */
	protected function TestContains(mixed $value, array $arr, string $message = '')
	{
		if (in_array($toTestValue ,$referenceValue))
		{
			# code...
		}
		else
		{
			# code...
		}
	}

	/**
	 * Passesed if $referenceValue is not contains in $toTestValue
	 *
	 * @param boolean $referenceValue valid value
	 * @param mixed $toTestValue value to test
	 * @param mixed $message message display if test faild
	 */
	protected function TestNotContains(mixed $value, array $arr, string $message = '')
	{
		if (!in_array($toTestValue ,$referenceValue))
		{
			# code...
		}
		else
		{
			# code...
		}
	}
}
