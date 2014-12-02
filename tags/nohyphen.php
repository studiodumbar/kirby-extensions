<?php
/**
 * No hyphen
 * ----
 * No hyphenation.
 *
 * What it does:
 * Wraps a text string in a <span> tag with class `no-hyphen`.
 *
 * Usage:
 * (nohyphen: CompanyName)
 *
 * Example:
 * http://altair.studiodumbar.com/base#paragraph
 */

kirbytext::$tags['nohyphen'] = array(
	'html' => function($tag) {

		$text = $tag->attr('nohyphen');

		return '<span class="u-textNoHyphen">' . $text . '</span>';

	}
);

?>
