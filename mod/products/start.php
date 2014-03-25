<?php

/**
 * Elgg tiene:
 * 		Eventos
 * 		Hooks
 * 		Acciones
 */
define('PRODUCTS_PATH', dirname(__FILE__) . '/');
define('PRODUCTS_ACTION_PATH', PRODUCTS_PATH . 'actions/products/');
define('PRODUCTS_SUBTYPE', 'product');

elgg_register_event_handler('init', 'system', 'products_init');

function products_init() {
	//Registramos un page handler, todo lo que sea sitio/products/ será procesado por el callback products_page_handler
	elgg_register_page_handler('products', 'products_page_handler');

	//Registramos una accion con permisos de logged in
	elgg_register_action('products/edit', PRODUCTS_ACTION_PATH . 'edit_a.php', 'logged_in');

	// menus
	elgg_register_menu_item('site', array(
		'name' => 'products',
		'text' => elgg_echo('products'),
		'href' => 'products/all'
	));
}

/**
 * Dispatcher for products.
 *
 * URLs take the form of
 *  All products:        products/all
 *  User's products:     products/owner/<username>
 *  Friends' products:   products/friends/<username>
 *  View bookmark:       products/view/<guid>/<title>
 *  New bookmark:        products/add/<guid> (container: user, group, parent)
 *  Edit bookmark:       products/edit/<guid>
 *  Group products:      products/group/<guid>/all
 *  Bookmarklet:         products/bookmarklet/<guid> (user)
 *
 * Title is ignored
 *
 * @param array $page
 * @return bool
 */
function products_page_handler($pages) {
	$page = elgg_extract('0', $pages, 'all');

	$path = PRODUCTS_PATH . 'pages/products/';

	switch ($page) {
		case 'add':
			include_once $path . 'add_p.php';
			break;
		default:
			include_once($path . 'all_p.php');
			break;
	}


	return TRUE;
}
