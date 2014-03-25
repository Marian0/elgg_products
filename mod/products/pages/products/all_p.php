<?php

elgg_register_title_button();


$title = elgg_echo('products:listing:title');

$options = array(
	'type' => 'object',
	'subtype' => PRODUCTS_SUBTYPE,
//	'limit' => 0,
	'full_view' => FALSE,
);
$content = elgg_list_entities($options);


$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
));

echo elgg_view_page($title, $body);