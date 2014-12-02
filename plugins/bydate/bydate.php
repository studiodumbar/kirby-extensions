<?php
/**
 * Returns an array of Kirby URIs for pages which have a date,
 * or nested arrays when grouping by year or month.
 */
function pagesByDate( $source, $userOptions=NULL ) {

	// Make sure we have a valid source
	if (!method_exists($source, 'slice')) {
		throw new Exception('pagesByDate requires `$pages` or a similar Kirby Pages object as first argument');
	}

	// Merge options
	$defaults = array(
		'order' =>   c::get('bydate.order', 'desc'),
		'limit' =>   c::get('bydate.limit', 100),
		'offset' =>  c::get('bydate.offset', 0),
		'max' =>     c::get('bydate.max', time()),
		'min' =>     c::get('bydate.min', 0),
		'group' =>   c::get('bydate.group', 'none')
	);
	$options = is_array($userOptions) ? array_merge($defaults, $userOptions) : $defaults;

	// Normalize some options
	if (!is_int($options['limit'])) $options['limit'] = $defaults['limit'];
	if (!is_int($options['offset'])) $options['offset'] = $defaults['offset'];
	if (is_string($options['max'])) $options['max'] = strtotime($options['max']);
	if (is_string($options['min'])) $options['min'] = strtotime($options['min']);

	// Order source content
	$source = $source->sortBy('date', $options['order']);

	// We'll return $results in the end
	$temp = array();
	$results = array();

	// 1. Validate each page based on status metadata and integer dates
	foreach ($source as $page) {
		$status = $page->status() ? strtolower($page->status()) : 'unknown';
		$date = $page->date(); // false when no date, integer timestamp otherwise
		if (
			$status !== 'archive' && $status !== 'draft' && $status !== 'ignore'
			&& $date !== false && $date >= $options['min'] && $date <= $options['max']
		) {
			$temp[] = $page;
		}
	}

	// 2. Apply offset/limit on the validated pages
	$temp = array_slice($temp, $options['offset'], $options['limit']);

	// 3. Populate $results with page URIs

	if ($options['group'] == 'year' || $options['group'] == 'month') {
		// Grouping by year, or by year then by month
		foreach ($temp as $page) {
			$year = $page->date('Y');
			$month = $page->date('m');
			if (!array_key_exists($year, $results)) {
				$results[$year] = array();
			}
			if ($options['group'] == 'year') {
				$results[$year][] = $page->uri();
			}
			if ($options['group'] == 'month') {
				if (!array_key_exists($month, $results[$year])) {
					$results[$year][$month] = array();
				}
				$results[$year][$month][] = $page->uri();
			}
		}
		return $results;
	}
	else {
		// Returning URIs from page objects in $temp as-is.
		foreach ($temp as $page) {
			$results[] = $page->uri();
		}
		return $results;
	}
}

?>
