# Figure plugin

A plugin for [Kirby CMS](http://getkirby.com) that generates an image in a figure tag, with a lot of options: among others crop ratio, alt-tag and (an opinionated) lazyload setting.

## Installation

Put the `figure` folder in `/site/plugins`.

Update the contents of the included `template.php` file to your likings and setup.

## How to use it

You can use this in a template file.

## Example usage

### Snippets

```php
<?php echo figure($page->images()->first()); ?>
```

or…

```php
<?php echo figure($page->images()->first(), array('cropratio' => 2/3’)); ?>
```

or…

```php
<?php
	echo figure($page->images()->first(), array(
		'crop'       => true,
		'cropratio'  => '.5',
		'class'      => 'Image Image--left',
		'alt'        => $page->title()->smartypants(),
		'caption'    => 'A beautiful image of trees'
		'lazyload'   => false
	));
?>
```

### Options

Check out the `$defaults` array in `figure.php` for more options.

## Author

Jonathan van Wunnik, Marijn Tijhuis
<http://studiodumbar.com>
