<?php
/**
 * Quote
 * ----
 * Adds an inline quote tag.
 *
 * What it does:
 * Wraps the text in <q> tag, with appropriate classes and language attribute
 *
 * Usage:
 * (quote: This is an English inline quote lang: en)
 */

kirbytext::$tags['quote'] = array(
	'attr' => array(
		'lang'
		),
	'html' => function($tag) {

		$text = $tag->attr('quote');
		$lang = $tag->attr('lang', c::get('lang.default', 'en'));

		return '<q class="Quote" lang="' . $lang . '">' . $text . '</q>';

	}
);

?>
