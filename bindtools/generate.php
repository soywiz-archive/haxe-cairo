<?php

require_once(__DIR__ . '/functions.php');

function generate($info) {
	$functions = $info['functions'];
	$abstracts = $info['abstracts'];

	ob_start();
	include(__DIR__ . '/template_ExternalInterface.php');
	$output = ob_get_clean();
	file_put_contents(__DIR__ . '/../project/ExternalInterface.cpp', $output);

	ob_start();
	include(__DIR__ . '/template_Raw.php');
	$output = ob_get_clean();
	file_put_contents(__DIR__ . '/../src/cairo/CairoRaw.hx', $output);
}

generate(CairoFunctions::get());
