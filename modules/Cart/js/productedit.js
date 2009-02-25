var deleteAtt = function(id) {
	if (confirm(strings.deleteItem.evaluate({type: 'product option'}))) {
		return new Ajax.Request('/admin/Cart', {
			parameters: { section: 'products', action: 'addedit', delete_att: id },
			onComplete: function(transport) {
				var el = $('product_options_' + id);
				el.remove();
			}
		});
	}
	return true;
}

var deleteAltImage = function(id) {
	if (confirm(strings.deleteItem.evaluate({type: 'product alternate image'}))) {
		return new Ajax.Request('/admin/Cart', {
			parameters: { section: 'products', action: 'addedit', delete_altimage: id },
			onComplete: function(transport) {
				var el = $('cartproduct_altimage_' + id).up('li');
				el.remove();
				$('delete_altimage_div_' + id).remove();
			}
		});
	}
	return true;
}

var getValues = function(el) {
	el = $(el);
	new Ajax.Request('/admin/Cart', {
		parameters: { section: 'attributes', action: 'values', id: el.value },
		onComplete: function(transport) {
			var values = transport.responseText.evalJSON();
			
			var select = $('newvalue');
			select.length = 0;
			
			values.each(function(value) {
				select.insert({bottom: Builder.node('option', {value: value.id}, value.value)});
			});
						
		}
	});
}