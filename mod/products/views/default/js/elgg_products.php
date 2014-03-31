<?php if (FALSE) { ?> <script> <?php } ?>

elgg.provide('elgg.products');

elgg.products.init = function() {
//	alert('js load');
	$(".elgg-form-products-rank").live('submit', elgg.products.vote_submit);


};


elgg.products.vote_submit = function(evt) {

	evt.preventDefault();

	var $form = $(this),
			$button = $form.find('.elgg-button-submit');
	
	var xhr = elgg.action($form.attr('action'), {data: $form.serialize()});
	
	$button.val('Sending ..').attr('disabled', 'disabled');
	
//	xhr.beforeSend(function() {
//		alert('antes de mandar el ajax');
//	});
	
	xhr.done(function(data) {
		if (data.output.status === elgg.ajax.SUCCESS) {
			$(".feedback").text(elgg.echo("products:after:voting"));
		}
	});
	
	xhr.always(function() {
		$button.val('Vote!').removeAttr('disabled');
	});
};

elgg.register_hook_handler('init', 'system', elgg.products.init);