<?php
/**
 * Quote
 * ----
 * Inline quotation with language locale.
 *
 * What it does:
 * Wraps  passed text string in <q> tag, with class `Quote`
 * and passed or oterhwise default language attribute.
 *
 * Usage:
 * (quote: This is an English inline quote)
 * (quote: This is an English inline quote lang: en)
 *
 * Example:
 * http://altair.studiodumbar.com/base#paragraph
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
