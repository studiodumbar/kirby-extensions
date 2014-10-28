# Detect plugin 2.0.1

## What is it?

Load different snippets based on the detected device class, e.g. mobile, tablet or desktop.

## How to use it?

Add the folder to your plugins directory.

* Create device specific snippets by adding the ‘.desktop’ postfix to snippets in the ‘/snippets’ folder (e.g. html_head.desktop.php)
* Include a device-specific snippet:

	<?php snippet_detect('header'); ?>

* Or ot only display certain parts of a template on desktop or mobile devices:

	<?php if(s::get('device_class') == 'desktop'): ?>
		This is only displayed on desktop…
	<?php endif; ?>

	<?php if(s::get('device_class') == 'mobile'): ?>
		This is only displayed on mobile…
	<?php endif; ?>

## Author(s)
Marijn Tijhuis, Jonathan van Wunnik
<http://www.studiodumbar.com>

## Credits

Credits go to [PHP Mobile Detect](https://github.com/serbanghita/Mobile-Detect) by Browserstack.com -- without this script this plugin wouldn't work.

## Changelog

* **2.0.1** Use Toolkit's session handling
* **2.0.0** Update to Kirby v2 compatability
* **1.1.0** Remove the tablet detection
* **1.0.0** Initial detect plugin
