var uid = (
	function(){
		var id=1;
		return function(){
		return id++ ;
	};
}
)();

var deleteValue = function(el) {
	el = $(el);
	if (confirm(strings.deleteItem.evaluate({type: 'value'}))) {
		new Ajax.Request('/admin/Cart', {
			parameters: {section: 'attributes', action: 'addedit', delete_value: el.identify(), },
			onComplete: function(transport) {
				el.up('li').remove();
			}
		});

	}

	return true;
}

var addNewValue = function(el) {
	el = $(el).up('li');
	var prev = el.previous();
	var newuid = uid();
	
	var newNode = Builder.node('li', [
		Builder.node( 'label', { for: 'newvalue[' + newuid + ']' }, 'New Option ' + newuid + ': '), 
		Builder.node( 'input', { type: 'text', name: 'newvalue[' + newuid + ']' })
	]);

	if (prev) {
		prev.insert({after: newNode});
	} else {
		el.insert({before: newNode});
	}
	
	return true;
}