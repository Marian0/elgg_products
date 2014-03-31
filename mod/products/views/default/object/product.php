<?php

$full = elgg_extract('full_view', $vars, FALSE);
$product = elgg_extract('entity', $vars, FALSE);

if (!$product) {
	return;
}

if ($full) {
	echo elgg_view('products/profile', $vars);
} else {
	echo elgg_view('products/item_list', $vars);
}