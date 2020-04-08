<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();

$autoload['libraries'] = array('database','session','table','logs','template');

$autoload['drivers'] = array("cache");

$autoload['helper'] = array('url','form','html','string','text','security');

$autoload['config'] = array();

$autoload['language'] = array();

$autoload['model'] = array(
	"model_users"		=> "mouse",
	"model_locations"	=> "motions",
	"model_registrasi"	=> "mogis",
	"model_informasi"	=> "moin"
);
