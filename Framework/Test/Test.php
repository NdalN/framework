<?php
namespace Framework\Test;

/**
 * Main TestClass
 */
class Test
{
	/**
	 * All test count
	 *
	 * @var [type]
	 */
	private $totalTestCount = 0;

	/**
	 * Count type of test
	 *
	 * @var array
	 */
	private $TestTypeCount = [];
	
	/**
	 * Test Faild count
	 *
	 * @var int
	 */
	private $faild = 0;
	
	/**
	 * Test Success count
	 *
	 * @var int
	 */
	private $success = 0;

	/**
	 * Test List
	 *
	 * @var array
	 */
	private $test = [];

	/**
	 * Current Tested File
	 *
	 * @var string
	 */
	private $currentTestedFile = '';
	
	/**
	 * List of tested file
	 *
	 * @var array
	 */
	private $testFileList = [];

	/**
	 * Init unit testing
	 *
	 * @param string $testDirectory
	 * @param string $output
	 */
	public function __construct(array $testDirectorys = ['Tests'], string $output = 'cli')
	{
		foreach ($testDirectorys as $testDirectory)
		{
			$this->testFileList = $this->getTestFileList($testDirectory);
		}
	}

	/**
	 * Get all php file of $path
	 *
	 * @param string $path
	 * @return void
	 */
	private function getTestFileList(string $path)
	{
		$testFileList = [];
		$dirContent = scandir($path);

		foreach ($dirContent as $file)
		{
			if ($file != '.' && $file != '..')
			{
				if (is_dir($path.DIRECTORY_SEPARATOR.$file)) {
					$testFileList = array_merge($testFileList, $this->getTestFileList($path.DIRECTORY_SEPARATOR.$file));
				}
				elseif (pathinfo($file, PATHINFO_EXTENSION) == 'php')
				{
					$testFileList[] = $path.DIRECTORY_SEPARATOR.$file;;
				}
			}	
		}

		return $testFileList;
	}

	/**
	 * Run test
	 *
	 * @return void
	 */
	public function run()
	{
		$startTestTime = (int) microtime(false);

		// var_dump($this->testFileList);

		foreach ($this->testFileList as $testFile)
		{
			if (file_exists($testFile)) {
				require_once $testFile;
				
				try
				{
					$className = pathinfo($testFile, PATHINFO_FILENAME);
					$testedClass = new $className($this);
				}
				catch (Exception $e)
				{
					throw new Exception('Error Processing Request' . $e->getMessage(), 1);
				}
			}

			// foreach ($testedClass as $propertise) {
			// 	if (is_callable($testedClass->$propertise())) {
			// 		$testedClass->$propertise();
			// 	}
			// }
		}

		$endTestTime = (int) microtime(false);
		var_dump($endTestTime, $startTestTime);
		$testDurration = $endTestTime - $startTestTime;
	}

	/**
	 * If test faild
	 *
	 * @param string $name the name of tested function
	 * @param string $fileName current tested file
	 * @param int $lineNumber test line number
	 * @param string $testType type of test
	 * @param string $message message of test
	 * @return void
	 */
	public function testFaild(string $name, string $fileName, int $lineNumber, string $testType, string $message)
	{
		$this->testFaild = array(
			'Name' => $name,
			'FileName' => $fileName,
			'LineNumber' => $lineNumber,
			'TestType' => $testType,
			'Message' => $message
		);
	}

	/**
	 * If test is passed
	 *
	 * @param string $name
	 * @param string $fileName
	 * @param int $lineNumber
	 * @param string $testType
	 * @param string $message
	 * @return void
	 */
	public function testSucces(string $name, string $fileName, int $lineNumber, string $testType, string $message)
	{
		$this->testFaild = array(
			'Name' => $name,
			'FileName' => $fileName,
			'LineNumber' => $lineNumber,
			'TestType' => $testType,
			'Message' => $message
		);
	}

}
