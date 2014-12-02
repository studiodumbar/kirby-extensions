# Tagslug plugin

A plugin for [Kirby CMS](http://getkirby.com) to convert a tag name to a slug (url) string (e.g. convert *Interactive & Web* to *interactive-and-web*).

## How to use it?

Call from template:

```php
<?php foreach(str::split($page->tags(),’,’) as $tag): ?>
	<a href="<?php echo $page->parent()->url().'/tag:'.tagslug($tag); ?>"><?php echo $tag; ?></a><?php if($i < (count($tags) -1)): echo ', '; endif; ?>
<?php endforeach; ?>
```

## Authors
Jonathan van Wunnik, Marijn Tijhuis
<http://www.studiodumbar.com>

## Changelog

* **1.0.0** Initial release
