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
	elgg_register_action('products/rank', PRODUCTS_ACTION_PATH . 'rank_a.php', 'logged_in');

	// menus
	elgg_register_menu_item('site', array(
		'name' => 'products',
		'text' => elgg_echo('products'),
		'href' => 'products/all',
	));
	
	// Permite utilizar la nomenclatura standar de URLS /all /view  /add 
	elgg_register_entity_url_handler('object', PRODUCTS_SUBTYPE, "product_entity_url_handler");
	
	elgg_register_event_handler('pagesetup', 'system', 'products_pagesetup');
	
//	elgg_register_js('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js');
	
	elgg_register_simplecache_view('js/elgg_products');
	elgg_register_js('elgg.products', elgg_get_simplecache_url('js', 'elgg_products'), 'footer');
	
	elgg_register_simplecache_view('css/products_style');
	elgg_register_css('products_style', elgg_get_simplecache_url('css', 'products_style'));
	
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

	elgg_set_context('products');
	
	$path = PRODUCTS_PATH . 'pages/products/';
		
	switch ($page) {
		case 'add':
			include_once $path . 'add_p.php';
			break;
		case 'view':
			elgg_push_context('products_profile');
			$guid = (int) elgg_extract('1', $pages, '0');
			set_input('guid', $guid);
			include_once $path . 'view_p.php';
			break;
		case 'edit':
			$guid = (int) elgg_extract('1', $pages, '0');
			set_input('guid', $guid);
			include_once $path . 'edit_p.php';
			break;
		default:
			include_once($path . 'all_p.php');
			break;
	}


	return TRUE;
}

function products_pagesetup() {
//	elgg_load_js('jquery_otro');
	
	if (elgg_in_context('products')) {
		elgg_load_css('products_style');
		elgg_load_js('elgg.products');
	}
	
	if (elgg_in_context('products_profile')) {
		elgg_extend_view('products/ext_profile', 'products/elements/show_price');
		elgg_extend_view('products/ext_profile', 'products/elements/rank');
		elgg_extend_view('page/elements/topbar', 'tunning/topbar');
		elgg_extend_view('page/elements/sidebar', 'tunning/sidebar');
	} else {
		elgg_extend_view('products/ext_profile', 'products/elements/show_price');
	}
}

function product_entity_url_handler($object) {
	$url = "products/view/{$object->getGUID()}/" . elgg_get_friendly_title($object->title);
	return elgg_normalize_url($url);
}
