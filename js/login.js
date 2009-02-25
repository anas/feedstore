function loginSubmit(form) {
	return new Ajax.Request('/user/login', {
		method: 'post',
		parameters: { username:form.username.value, password:form.password.value },
		onSuccess: function(transport) {
			$('loginBlock').update(transport.responseText);
		}
	}); 
}

function logoutSubmit(form) {
	return new Ajax.Request('/user/logout', {
		method: 'post',
		parameters: { logout:true},
		onSuccess: function(transport) {
			$('loginBlock').update(transport.responseText);
		}
	});
}
