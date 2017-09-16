<?php

class UnitTest
{
	protected $totalTestCount;

	protected $TestTypeCount = [
		'TestEquality' => '',
		'TestContening' => '',
		'Test' => '',
		'' => '';
	];

	protected $testFaild = [];

	protected function __construct()
	{
		var_dump($this);

		foreach ($this as $propertise) {
			if (is_callable($this->$propertise())) {
				$this->$propertise();
			}
		}
	}

	protected function TestEquality($toFind, $toTest)
	{
		
	}

	protected function CountTest()
	{

	}
}
