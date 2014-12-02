# Titlecase plugin

A field method for [Kirby CMS](http://getkirby.com) to convert text to Title Case.

## How to use it?

Call from template:

```php
<?php echo titlecase('Resulting in a Cool Title Case Title'); ?>
```

or…

```php
<?php echo $site->title()->smartypants()->titlecase(); ?>
```

## Authors

Marijn Tijhuis, Jonathan van Wunnik
<http://www.studiodumbar.com>

## Credits

Credits go to Camen Design’s [PHP Title Case script](http://camendesign.com/code/title-case) (what was originally a John Gruber Perl script).

## Changelog

* **1.0.1** Add field method
* **1.0.0** Initial release
