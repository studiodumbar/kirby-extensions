<?php

/**
 * Camelcase Plugin
 *
 * @author Jonathan van Wunnik <jonathan@studiodumbar.com>
 * @version 1.0.0
 */

// Field method
field::$methods['camelcase'] = function($field) {
	$field->value = camelcase($field);
	return $field;
};

// Convert a string to camelCase
function camelcase($text) {
	// lower case everything
	$text = strtolower($text);

	// make alphanumeric (removes all other characters)
	$text = preg_replace('/[^a-z0-9_\s-]/', '', $text);

	// clean up multiple dashes or whitespaces
	$text = preg_replace('/[\s-]+/', ' ', $text);

	// convert underscores to spaces
	$text = preg_replace('/[\s_]/', ' ', $text);

	// uppercase the first character of each word
	$text = ucwords(trim($text));

	// remove whitespaces
	$text = str_replace(' ', '', $text);

	// make first character lowercased if that character is alphabetic
	$text = lcfirst($text);

	// return string
	return $text;
}

?>
