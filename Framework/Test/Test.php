<?php
/**
 * Main TestClass
 */
class Test
{
	private $totalTestCount;
	
	private $faild = array();

	private $TestTypeCount = [
		'TestEquality' => '',
		'TestContening' => '',
		'Test' => '',
		'' => '';
	];


	public function __construct($testDirectory = 'Tests', $output = 'cli')
	{
		
	}

	private function getTestFileList($path)
	{
		$dirContent = opendir($path);

		foreach ($dirContent as $file) {
			if ($file != '.' && $file != '..') {
				if (pathinfo($file, PATHINFO_EXTENSION) == 'php') {
					$testFileList[] = $file;
				}
				elseif (is_dir($file))
				{
					$testDirectory .= $this->getTestFileList($file);
				}
			}	
		}
	}


	public function run()
	{
		$startTestTime = microtime();

		$testFileList = getTestFileList();
		
		foreach ($testFileList as $testFile) {
			

			try
			{
				require_once $testFile;

				new $testFile($this);
			}
			catch 
			{

			}

			if(is_callable(array('Foo', '__construct')))
			{
				
			}
		}


		
		var_dump($this);
		foreach ($this as $propertise) {
			if (is_callable($this->$propertise())) {
				$this->$propertise();
			}
		}



		$endTestTime = microtime();
		$testDurration = $endTestTime - $startTestTime;
	}

	public function faild($message)
	{
		$this->testFaild = array(
			'name' => $functionName,
			'LineNumber' => ,
			'name' => ,
			'name' => ,
		);
	}

}
