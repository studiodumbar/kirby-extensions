<?php
/**
 * Thumb
 * ----
 * (Cropped) thumb generation.
 *
 * What it does:
 * Generates a thumb image in a <figure> tag.
 *
 * Usage:
 * (thumb: image.jpg width: 225 height: 225 alt: Just a thumb)
 * (thumb: image.jpg width: 225 height: 225 quality: 75 alt: Thumb with quality 75)
 * (thumb: image.jpg width: 400 height: 250 crop: true alt: Thumb cropped)
 *
 * Example:
 * http://altair.studiodumbar.com/images
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
