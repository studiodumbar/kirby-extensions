<?php
/**
 * Widont
 * ----
 * Use widont function from kirby toolkit helpers (based on str::widont)
 *
 * What it does:
 * If text contains more than 3 spaces, replace last space by a &nbsp:
 *
 * Usage:
 * (widont: dit is een hele lange titel)
 */

kirbytext::$tags['widont'] = array(
	'html' => function($tag) {

		$text = $tag->attr('widont');

		return widont($text);

	}
);

?>
