<?php
if (elgg_is_logged_in()) {
	echo elgg_view_form('products/rank', array(), $vars);
} else {
	echo elgg_echo('products:error:comment:login');
}