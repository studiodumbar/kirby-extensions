<?php
/**
 * Blockquote
 * ----
 * Blockquote tag, wrapped in a figure with optional (fig)caption.
 *
 * What it does:
 * Generates markup based on A List Apart's article example code:
 * http://j.mp/1oRDK9x, http://j.mp/1h7RLbF
 * Good to know: the <cite> tag is not meant for people's names.
 * According to the spec, it is only for works (not people)!
 *
 * Usage:
 * 1) (blockquote: Tomorrow is another day. attribution: Scarlett O'Hara in Margaret Mitchell's cite: Gone with the Wind)
 * 2) (blockquote: I'm going to make him an offer he can't refuse. attribution: Don Vito Corleone's famous line in cite: The Godfather link: http://www.imdb.com/title/tt0068646/)
 * 3) (blockquote: Bij fotografie is zien belangrijker dan de tools. lang: nl attribution: Jonathan van Wunnik)
 *
 * Example:
 * http://altair.studiodumbar.com/base#blockquote
 */

kirbytext::$tags['blockquote'] = array(
	'attr' => array(
		'lang',
		'attribution',
		'cite',
		'link'
		),
	'html' => function($tag) {

		$text = $tag->attr('blockquote');
		$lang = $tag->attr('lang');
		$attribution = $tag->attr('attribution');
		$cite = $tag->attr('cite');
		$link = $tag->attr('link');

		if(!empty($lang)) {
			$lang_attr = ' lang="' . $lang . '"';
		}
		else {
			$lang_attr = '';
		}

		$html = '<figure class="Blockquote">';
		$html .= '<blockquote' . $lang_attr . '>';
		$html .= kirbytext($text);
		$html .= '</blockquote>';

		// open figcaption with attribution, citation and link if one is available
		if(!empty($attribution)) {
			if(!empty($cite)) {
				if(!empty($link)) {
					$html .= '<figcaption>' . smartypants($attribution) . ' <cite><a href="' . html($link) . '" rel="external nofollow">' . smartypants($cite) . '</a></cite></figcaption>';
				} else {
					$html .= '<figcaption>' . smartypants($attribution) . ' <cite>' . smartypants($cite) . '</cite></figcaption>';
				}
			} else {
				$html .= '<figcaption>' . smartypants($attribution) . '</figcaption>';
			}
		}

		$html .= '</figure>';

		return $html;

	}
);

?>
