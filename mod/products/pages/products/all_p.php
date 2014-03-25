<?php

$content = 'Contenido 1';
$title = 'Titulo 1';

$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
));

echo elgg_view_page($title, $body);