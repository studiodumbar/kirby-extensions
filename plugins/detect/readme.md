# Detect plugin

A plugin for [Kirby CMS](http://getkirby.com) to load a device specific snippets based on the detected device class, e.g. mobile or desktop (tablet is possible too, but disabled by default).

## How to use it?

* First add the `detect` folder to your `/site/plugins` directory.
* Create device specific snippets by adding the ‘.desktop’ postfix to snippets in the `/snippets` folder (e.g. html_head.desktop.php)
* Include the device-specific snippet:

```php
<?php snippet_detect('header'); ?>
```

* Or to display certain parts of a template to specific device classes (e.g. desktop or mobile):

```php
<?php if(s::get('device_class') == 'desktop'): ?>
	This is only displayed on desktop…
<?php endif; ?>

<?php if(s::get('device_class') == 'mobile'): ?>
	This is only displayed on mobile…
<?php endif; ?>
```

## Author(s)
Jonathan van Wunnik, Marijn Tijhuis
<http://www.studiodumbar.com>

## Credits

Credits go to [PHP Mobile Detect](https://github.com/serbanghita/Mobile-Detect) by Browserstack.com -- without this script this plugin wouldn't work.

## Changelog

* **2.0.1** Use Toolkit's session handling
* **2.0.0** Update to Kirby v2 compatibility
* **1.1.0** Remove the tablet detection
* **1.0.0** Initial release
