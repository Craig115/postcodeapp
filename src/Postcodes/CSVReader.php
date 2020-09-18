<?php

namespace Postcodes;

use League\Csv\Reader;

class CSVReader
{
    public static function loadData($dir)
    {
		$files = array_slice(scandir($dir), 2);
		foreach($files as $file) {
			$reader = Reader::createFromPath($dir . $file, 'r');
			return $reader->getRecords();
		}
    }
}