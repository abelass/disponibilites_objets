<?php

/**
 * Trie les dates
 *
 * @param array $dates
 * @return array
 */
function dd_sort_dates (array $dates) {
	usort($dates, "cmp");
	return $dates;
}

/**
 * cmp()
 * @param int $a
 * @param int $b
 * date comparison callback
 **/
function cmp($a, $b) {
	if ($a == $b) return 0;

	return (strtotime($a) < strtotime($b))? -1 : 1;
}
