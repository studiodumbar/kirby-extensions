<?php
/**
 * Widont
 * ----
 * Remove widows from text string.
 *
 * What it does:
 * Replaces last space by a non-breaking-space (e.g. `&nbsp;`).
 * Uses Kirby toolkit's widont helper function (based on str::widont)
 *
 * Usage:
 * (widont: This is a title without widows)
 */

kirbytext::$tags['widont'] = array(
	'html' => function($tag) {

		$text = $tag->attr('widont');

		return widont($text);

	}
);

?>
