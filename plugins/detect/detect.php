<?php

/**
 * (Mobile) Detect Plugin
 *
 * @author Marijn Tijhuis <marijn@studiodumbar.com>
 * @author Jonathan van Wunnik <jonathan@studiodumbar.com>
 * @version 2.0.0
 */

// Include/load the Mobile_Detect.php script
include_once('Mobile_Detect.php');

// Now create a new mobile detect class
$detect = new Mobile_Detect();

// Start a session
s::start();

// Set the session variables for the device classes
if($detect->isMobile() && !$detect->isTablet()) {
	s::set('device_class', 'mobile');
}
else {
	s::set('device_class', 'desktop'); // if (mobile) device can't be detected, assume it's desktop
}

// Load the device pecific template snippets
function snippet_detect($file, $data = array(), $return = false) {
	if(is_object($data)) $data = array('item' => $data);

	// If the session variable is not found, set the default value (e.g 'mobile')
	$device_class = s::get('device_class', 'mobile');

	// Embed the device class specific snippet
	if ($device_class == 'mobile') {
		// Embed the mobile snippet (`mobile` is the default snippet, without the device specific `.postfix`, e.g. footer.php)
		return tpl::load(kirby::instance()->roots()->snippets() . DS . $file . '.php', $data, $return);
	} else {
		// Embed the device class specific snippet (e.g. `footer.desktop.php`)
		return tpl::load(kirby::instance()->roots()->snippets() . DS . $file . '.' . $device_class . '.php', $data, $return);
	}
}

?>
