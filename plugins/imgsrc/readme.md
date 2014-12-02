# Imgsrc plugin

A plugin for [Kirby CMS](http://getkirby.com/) that generates an `src` attribute only. Handy for creating an `img` tag or for use as background image url.

## Installation

Put the `imgsrc` folder in `/site/plugins` directory.

Update the contents of the included `template.php` file to your likings and setup.

## How to use it

You can use this in a template file.

## Example usage

### Snippets

```php
<img <?php echo imgsrc($page->images()->first()); ?> class="MyImage"/>
```

or… 

```<?php
<div <?php echo imgsrc($page->images()->first(), array('bgimage' => true, 'class' => 'CoverImage FluidEmbed FluidEmbed--16by9')); ?>></div>
```

### Options

Check out the `$defaults` array in `imgsrc.php` for all options.

## Author

Jonathan van Wunnik, Marijn Tijhuis
<http://studiodumbar.com>
