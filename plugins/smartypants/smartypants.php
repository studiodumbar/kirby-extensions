<?php

/**
 * Smartypants Plugin
 *
 * @author Jonathan van Wunnik <jonathan@studiodumbar.com>
 * @version 1.0.0
 */

if($this->options['smartypants']) {
	field::$methods['smartypants'] = function($field) {
		$field->value = smartypants($field);
		return $field;
	};
}

?>
