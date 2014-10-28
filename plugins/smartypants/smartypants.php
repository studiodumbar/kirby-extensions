<?php

/**
 * Smartypants Plugin
 *
 * @author Jonathan van Wunnik <jonathan@studiodumbar.com>
 * @version 1.0.0
 */

field::$methods['smartypants'] = function($field) {
	$field->value = smartypants($field);
	return $field;
};

?>
