<?php
defined("BASEPATH") OR exit("No direct script access allowed");

$config = array(
	///// USER VALIDATION /////
	"simmas-oauth"=>array(
		"username"	=> array(
			"field"	=> "username",
			"label"	=> "username",
			"rules"	=> "required|min_length[8]"
		),
		"password"	=> array(
			"field"	=> "password",
			"label"	=> "password",
			"rules"	=> "required|min_length[8]"
		)
	),

	"save_propinsi"=>array(
		"propinsi"	=> array(
			"field"	=> "propinsi",
			"label"	=> "nama propinsi",
			"rules"	=> "required|min_length[3]"
		)
	)
);