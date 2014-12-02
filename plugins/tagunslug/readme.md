# Tagunslug plugin

A plugin for [Kirby CMS](http://getkirby.com) to convert a tag slug (see *tagslug* plugin) string to a human readable tag name (e.g. convert *interactive-and-web* to *Interactive & Web*).

## How to use it?

Call from template:

```php
<?php
	$key = key(param());
	$tag = tagunslug(param(key(param())));
	$products = $page->children()->visible()->filterBy($key, ($tag), ',')->flip()->paginate(24);
?>
<?php foreach($paintings as $painting):	?>
	…
<?php endforeach; ?>
```

## Authors
Jonathan van Wunnik, Marijn Tijhuis
<http://www.studiodumbar.com>

## Changelog

* **1.0.0** Initial release
