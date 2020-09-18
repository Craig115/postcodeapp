<?php

namespace Postcodes;

use Exception;
use ZipArchive;

class Downloader
{
	public static function downloadFile($url, $dir)
	{
		if(file_put_contents($dir,file_get_contents($url))) {
			return;
		} else {
			throw new Exception("Failed to download file.");
		}
	}

	public static function unzipFile($file)
	{
		$zip = new ZipArchive;
		
		if ($zip->open($file) === TRUE) {
			$zip->extractTo("/tmp/");
    		$zip->close();
    		return;
		} else {
    		throw new Exception("Failed to unzip file: " . $zip->getStatusString() . "\n");
		}
	}
}