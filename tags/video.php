<?php
/**
 * Video
 * ----
 * A generic tag to embed video's
 *
 * What it does:
 * Embeds youtube or vimeo video in a fluid embed.
 *
 * Usage:
 * 1) (video: 77383196 host: vimeo)
 * 2) (video: hXU63NXzg5A host: youtube ratio: 4by3)
 * 3) (video: zJs9p-VNORw host: vimeo ratio: 2by1)
 */

kirbytext::$tags['video'] = array(
	'attr' => array(
		'ratio',
		'host'
		),
	'html' => function($tag) {

		$video = $tag->attr('video');
		$ratio = $tag->attr('ratio');
		$host = $tag->attr('host');

		// fill the ratio string
		if($ratio == ''){
			$ratio = 'FluidEmbed--16by9';
		}
		else {
			$ratio = 'FluidEmbed--' . $ratio;
		}

		// display the embedcode
		if($host == 'vimeo') {
			$videoelement = '<iframe src="//player.vimeo.com/video/' . $video . '?title=0&amp;byline=0&amp;portrait=0&amp;color=0000ff" width="' . c::get('video.height', '500') . '" height="' . c::get('video.width', '281') . '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
		}
		elseif ($host == 'youtube') {
			$videoelement = '<iframe width="' . c::get('video.width', '500') . '" height="' . c::get('video.height', '281') . '" src="//www.youtube.com/embed/' . $video . '?rel=0" frameborder="0" allowfullscreen></iframe>';
		}
		else {
			$videoelement = '<a href="' . $video . '" class="FluidEmbed-item">' . $video . '</a>';
		}

		$figure = new Brick('figure');
		$figure->addClass('FluidEmbed '.$ratio);
		$figure->append($videoelement);

		return $figure;

	}
);

?>
