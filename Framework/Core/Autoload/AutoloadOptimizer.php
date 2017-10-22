<?php

class AutoloadOptimizer
{
	private $AutoloadConfig = [];

	/**
	 *  Creating the optimized autoload config file
	 *
	 * @param String $ouputFile file to put the generated config
	 * @return bool
	 */
	public function generatingOptimizedFile(String $ouputFile): Array
	{

	}

	/**
	 * Creating key value array with autoload map
	 *
	 * @param array $input
	 * @return array
	 */
	private function makeOptimizedAutoloadMap(array $input = []): array
	{
		foreach ($input as $key => $value) {
			# code...
		}


		return $
	}

	/**
	 * C
	 *
	 * @param [type] $file
	 * @return bool
	 */
	private function createOptimizedFile($file): bool
	{

	}

	/**
	 * Adding Autoload Config file (json foramt)
	 *
	 * @param String $file path of config file
	 * @return Bool
	 */
	public function setAutoloadConfig(String $file = MAIN_CONFIG_DIR . DIRECTORY_SEPARATOR . 'Autoload.json'): Bool
	{
		if ($contents = file_get_contents($file))
		{
		 	$this->AutoloadConfig = array_merge(json_decode($contents, true), $this->AutoloadConfig);

			return true;
		}
		return false;
	}

	public function getObtimizedAutoloadConfig(): Array
	{
		return $this->AutoloadConfig;
	}

	public function getObtimizedAutoloadConfigJson(): String
	{
		return json_encode($this->AutoloadConfig);
	}
}
