<?php

class i2spanEngine{
	
	function __construct(){
		$allPluginFiles = $this->getAllPluginFiles($_POST["dir"]);
		$f = fopen("./test.txt","w");
		foreach($allPluginFiles as $file){
			fwrite($f, $file);
		}
		fclose($f);
		$this->replaceIcons($allPluginFiles);
	}
	
	
	
	function getAllPluginFiles($dir){
		$allFilePaths = [];
		$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
		foreach ($iterator as $file) {
			if ($file->isDir()) continue;
			$path = $file->getPathname();
			$allFilePaths[] = $path;
		}
		
		return $allFilePaths;
	}
	
	
	 function replaceIcons($allFilePaths){
		$f = fopen("./ext.txt","w");
		
		foreach($allFilePaths as $file){
			$fileParts = pathinfo($file);
			$fileExt = $fileParts["extension"];
			fwrite($f,$fileExt);
			if(($fileExt=="php" || $fileExt =="html" || $fileExt =="js") && $fileParts["basename"]!= "i2spanEngine.php"){
				
				$fileContents = file_get_contents($file);
				$fileContents = preg_replace("/<i\s+/","<span ",$fileContents);
				$fileContents = str_replace("<i>","<span>",$fileContents);
				$fileContents = str_replace("</i>","</span>",$fileContents);
				file_put_contents($file,$fileContents);
			}
		}
		fclose($f);
	}
}

$i2spanEngine = new i2spanEngine();