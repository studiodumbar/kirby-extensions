# RSS Feed Plugin

This is a plugin for [Kirby](http://getkirby.com/) that generates RSS feeds for any set of pages.

## Installation

Put the `feed` folder in `/site/plugins`.

## How to use it

You can use this in a tempalte for a dedicated feed page or in a template controller.

## Example usage


	<?php

	echo page('blog')->children()->visible()->limit(10)->feed(array(
		'title'       => 'Latest articles',
		'description' => 'Read the latest news about our company',
		'link'        => 'blog'
		));

	?>

Check out the $defaults array in feed.php for more options.

## Author

Bastian Allgeier
<http://getkirby.com>
