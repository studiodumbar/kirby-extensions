<?php
/**
 * No hyphen
 * ----
 *
 * What it does:
 * Wraps the passed text in a span with class .no-hyphen
 *
 * Usage:
 * (nohyphen: CompanyName)
 */

kirbytext::$tags['nohyphen'] = array(
	'html' => function($tag) {

		$text = $tag->attr('nohyphen');

		return '<span class="u-textNoHyphen">' . $text . '</span>';

	}
);

?>
