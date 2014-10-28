<?php
/**
 * Thumb
 * ----
 *
 *
 * What it does:
 *
 *
 * Usage:
 *
 */
kirbytext::$tags['thumb'] = array(
	'attr' => array(
		'width',
		'height',
		'alt',
		'quality',
		'crop'
		),
	'html' => function($tag) {

		$url = $tag->attr('thumb');
		$file = $tag->file($url);
		$quality = $tag->attr('quality', c::get('thumb.quality', 100));

		$image = thumb($file,array(
			'width' => $tag->attr('width'),
			'height' => $tag->attr('height'),
			'alt' => $tag->attr('alt'),
			'quality' => $quality,
			'crop' => $tag->attr('crop'),
		));

		$figure = new Brick('figure');
		$figure->append($image);

		return $figure;

	}
);

?>
