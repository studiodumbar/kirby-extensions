# Imgsrc Plugin

This is a plugin for [Kirby](http://getkirby.com/) that generates an src attribute only, for creating img tag or for use as background image, dependigng on passed variables.

## Installation

Put the `imgsrc` folder in `/site/plugins`.

## How to use it

You can use this in a template file.

## Example usage

Example snippet embed codes:

````
<img <?php echo imgsrc($page->images()->first()); ?> class="MyImage"/>


<div <?php echo imgsrc($page->images()->first(), array('bgimage' => true, 'class' => 'CoverImage FluidEmbed FluidEmbed--16by9')); ?>></div>

````

Check out the $defaults array in imgsrc.php for more options.

## Author

Jonathan van Wunnik, Marijn Tijhuis
<http://studiodumbar.com>
