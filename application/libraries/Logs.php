<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');  

class Logs{

	public $folderFile;
	public $namePrefix ;
	public $nameExtension ;
	public $intervalType ; // 1 = daily; 2 = monthly; 3 = hourly
	public $withTimeStamp ; // true = with time stamp leading, false = without time stamp

	public function __construct($logString = "", $folderFile = "", $namePrefix = "", $nameExtension = "", $intervalType = 1, $withTimeStamp = false) {
		$this->folderFile = "/var/log/logging" ;
		$this->namePrefix = "logfile_" ;
		$this->nameExtension = ".log" ;
		$this->intervalType = 1 ;
		$this->withTimeStamp = false ;
		if ($logString) {
			$this->logging($logString, $folderFile, $namePrefix, $nameExtension, $intervalType, $withTimeStamp);
		}
	}

	public function __destruct() {
		unset($this->folderFile, $this->namePrefix, $this->nameExtension, $this->intervalType, $this->withTimeStamp) ;
	}

	public function logging($logString = "", $folderFile = "", $namePrefix = "", $nameExtension = "", $intervalType = 1, $withTimeStamp = false) {
		$logString = trim($logString);
		if ($logString) {
			$this->folderFile = ($folderFile)?$folderFile:$this->folderFile ;
			$this->namePrefix = ($namePrefix)?$namePrefix:$this->namePrefix ;
			$this->nameExtension = ($nameExtension)?$nameExtension:$this->nameExtension ;
			$this->intervalType = ($intervalType)?$intervalType:$this->intervalType ;
			$this->withTimeStamp = ($withTimeStamp)?$withTimeStamp:$this->withTimeStamp ;
			$FileName = $this->setFileName() ;
			$this->fixFolder();
			$this->createFolder() ;
			$timeStamp = "" ;
			if ($this->withTimeStamp) {
				$timeStamp = date("Y/m/d H:i:s")."\t" ;
			}
			$hasHandle = false ;
			$handleCounter = 0 ;
			do {
				$FH = fopen(sprintf("%s/%s",$this->folderFile,$FileName),"a+");
				if ($FH) {
					$hasHandle = true ;
					fwrite($FH,sprintf("%s%s\n",$timeStamp,$logString));
					fclose($FH);
				} else {
					usleep(5000);	
					$handleCounter++ ;
				}
			} while (!$hasHandle && $handleCounter < 10) ;
		}
		unset($logString, $folderFile, $namePrefix, $nameExtension, $intervalType,$FileName,$FH);
	}

	private function fixFolder() {
		$this->folderFile = preg_replace("/\/+$/i","",$this->folderFile);
	}

	private function createFolder() {
		if (!is_dir($this->folderFile)) {
			mkdir($this->folderFile, 0777, true);
		}
	}

	private function setFileName() {
		$FileName = "" ;
		switch ($this->intervalType):
		case 1:
			$FileName = sprintf("%s%s%s",$this->namePrefix,date("Ymd"),$this->nameExtension) ;
			break;
		case 2:
			$FileName = sprintf("%s%s%s",$this->namePrefix,date("Ym"),$this->nameExtension) ;
			break;
		case 3:
			$FileName = sprintf("%s%s%s",$this->namePrefix,date("YmdH"),$this->nameExtension) ;
			break;
		default:
			$FileName = sprintf("%s%s%s",$this->namePrefix,date("Ymd"),$this->nameExtension) ;
		endswitch;
		return $FileName ;
	}
}