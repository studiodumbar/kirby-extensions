<?php

/**
 * Tagunslag Plugin
 *
 * @author Marijn Tijhuis <marijn@studiodumbar.com>
 * @version 1.0.0
 */

// Field method
field::$methods['tagunslug'] = function($field) {
	$field->value = tagunslug($field);
	return $field;
};

// Convert tag slug (see tagslug plugin) string to tag name
function tagunslug($text){
	// uppercase first character after -and-
	$text = implode('-and-', array_map('ucfirst', explode('-and-', $text)));

	// replace -and- by <space>&<space>
	$text = str_replace('-and-', ' & ', $text);

	// replace - buy <space>
	$text = str_replace('-', ' ', $text);

	// uppercase
	$text = ucfirst($text);

	return $text;
}

?>
