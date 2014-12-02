<?php
/**
 * Syntaxic sugar for getting values from Kirby page fields
 *
 * Example usage with the custom field method on a first line,
 * and the corresponding logic (aka what you could write without
 * the syntactic sugar methods) on the second line.
 *
 *     // Use a fallback field if the first one is empty
 *     $title = $page->shorttitle()->or($page->title());
 *     $title = $page->shorttitle()->empty() ? $page->title() : $page->shorttitle();
 *     
 *     // Use a fallback value if the first one is empty
 *     $category = $page->category()->or('misc');
 *     $category = $page->category()->empty() ? 'misc' : $page->category();
 *     
 *     // Parse a field value as a number (with default value)
 *     $number = $page->mynumber()->int(50);
 *     $number = $page->mynumber()->empty() ? 50 : intval($page->mynumber()->value);
 *     
 *     // Parse a field value as a boolean (with default value)
 *     $showSidebar = $page->sidebar()->bool(false);
 *     $showSidebar = $page->sidebar()->empty() ? false : filter_var($page->sidebar()->value, FILTER_VALIDATE_BOOLEAN);
 *
 * @package  KirbyFieldSugar
 * @license  http://www.wtfpl.net/txt/copying/  WTFPL
 * @author   fvsch <florent@fvsch.com>
 */

/**
 * Adds 'or' method to Field objects, which allows getting a field
 * value or getting back a default value if the field is empty.
 * @param   Object(Field) [$field] The calling Kirby Field instance
 * @param   mixed [$fallback] Fallback value returned if field is empty
 * @return  mixed
 */
field::$methods['or'] = function($field, $fallback=NULL) {
	return $field->empty() ? $fallback : $field;
};

/**
 * Filter the Field value, or a fallback value if the Field is empty,
 * to get a boolean value. '1', 'on', 'true' or 'yes' will be true,
 * and everything else will be false.
 * @param   Object(Field) [$field] The calling Kirby Field instance
 * @param   boolean [$default] Default value returned if field is empty
 * @return  boolean
 */
field::$methods['bool'] = function($field, $default=false) {
    $val = $field->empty() ? $default : $field->value;
    return filter_var($val, FILTER_VALIDATE_BOOLEAN);
};

/**
 * Get an integer value for the Field.
 * @param   Object(Field) [$field] The calling Kirby Field instance
 * @param   integer [$default] Default value returned if field is empty
 * @return  integer
 */
field::$methods['int'] = function($field, $default=0) {
	$val = $field->empty() ? $default : $field->value;
	return intval($val);
};
