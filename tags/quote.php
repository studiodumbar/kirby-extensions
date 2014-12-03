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

		if($tag->attr('lang')) {
			$language_locale = $tag->attr('lang');
		}
		else {
			$language_locale = 'en'; // Fallback language locale if no is passed, e.g. 'en, nl_NL', 'de_DE', ect.
		}

		return '<q class="Quote" lang="' . $language_locale . '">' . $text . '</q>';

	}
);

?>
