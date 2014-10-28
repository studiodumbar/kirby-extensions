# Figure Plugin

This is a plugin for [Kirby](http://getkirby.com/) that generates an image in a figure, with a lot of possible options. Cropratio, alt-tag or (optinionated) lazyload are one of the many possibilities.

## Installation

Put the `figure` folder in `/site/plugins`.

## How to use it

You can use this in a template file.

## Example usage

Example snippet embed codes:

````
echo figure($page->images()->first());

echo figure($page->images()->first(), array(
	'cropratio'  => '2/3'
));

echo figure($page->images()->first(), array(
	'crop'       => true,
	'cropratio'  => '.5',
	'class'      => 'Image Image--left',
	'alt'        => $page->title()->smartypants(),
	'caption'    => 'A beautiful image of trees'
	'lazyload'   => false
));

````

Check out the $defaults array in figure.php for more options.

## Author

Jonathan van Wunnik, Marijn Tijhuis
<http://studiodumbar.com>
