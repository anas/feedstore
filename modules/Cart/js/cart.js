function printOrder(){
	var a = window.open('','','width=300,height=300');
	a.document.open("text/html");
	a.document.write(document.getElementById('orderInfo').innerHTML);
	a.print();
	a.close();
}

function checkBeforeSendToPaypal(){
	deliveryDirections = document.getElementById('delivery_direction_textarea').value;//When checking out, save the delivery directions in the session 
	new Ajax.Request('/store/canCheckout', {
	  method: 'post',
	  parameters: { delivery_direction:  deliveryDirections},
	  onComplete: function(transport) {
		var result = transport.responseText;//If the variable result has a value, it means that the user is missing something and they cannot go to Paypal
		if (result.substring(0,7) == 'proceed')//If the variable result is equal to proceed, it means that the user can go to Paypal
			document.payment_form.submit();
	  	else
			alert(result);
	  }
	});
	return false;
}

var detailsHover = function(itm) {
	
}

function addressEdit( element , sameAsBilling) {
	//The variable sameAsBilling will get the value 1 when the user clicks on the link: "Same as billing address"
	var section = element;
	var element = $(element);
	return new Ajax.Request('/store/address', {
	  method: 'post',
	  parameters: { adr_type: section, sameAsBilling: sameAsBilling },
	  onSuccess: function(transport) {
	    element.update(transport.responseText);
	    var form = element.down('form');
	    if (sameAsBilling){//update the payment form because the shipping address was set
	    	updateCartDetails();
	    	updatePaymentForm();
	    }
		$(form).observe('submit', function(event){
			form.request({
				parameters: { adr_type: element.identify() },
				onComplete: function(transport) {
					//updateShipping(element);
					element.update(transport.responseText);
					updateCartDetails();
					updatePaymentForm();
				}
			});
			Event.stop(event);
		});
	  }
	});
}

function updateCartDetails(){
	new Ajax.Request('/store/cartdetail', {
	  method: 'get',
	  onComplete: function(transport) {
	  	$('cart_detail').update(transport.responseText);
	  }
	});
}

function updateDirections(){
	deliveryDirections = document.getElementById('delivery_direction_textarea').value;
	new Ajax.Request('/store/deliverydirections', {
	  method: 'post',
	  parameters: { delivery_direction:  deliveryDirections}
	});
}

function updatePaymentForm(){
	new Ajax.Request('/store/payform', {
	  method: 'get',
	  onComplete: function(transport) {
	  	$('pay_form').update(transport.responseText);
	  }
	});
}

function updateShipping(element) {
	return new Ajax.Request('/store/cartdetail', {
	  method: 'post',
	  parameters: { ship_type: element.getValue() },
	  onComplete: function(transport) {
	  	$('cart_detail').update(transport.responseText);
	  }
	});
}

function updateProduct(form) {
	var form = $(form);
	var productdiv = form.up();
	
	var id = $(form['productId']).getValue();
	form['action'].disable();
	
	var els = form.serialize();
	
	return new Ajax.Request('/store/productform', {
	  method: 'post',
	  postBody: els,
	  onSuccess: function(transport) {
	  	productdiv.update(transport.responseText);
	  }
	});
}

var htmlcache = null;

Event.observe(window, 'load', function() {
	var images = $$('div.thumbnailHolder');
	images.each(function(imagediv) {
		imagediv.observe('mouseover', function(event) {
			var preview = imagediv.down('div.details');
			var replace = $('largeImage');
			if (preview.innerHTML == replace.innerHTML) {
	  			return;
	  		}
			htmlcache = replace.innerHTML;
			replace.update(preview.innerHTML);
		});
		
		imagediv.observe('mouseout', function(event) {
	  		if (htmlcache != null) {
	  			$('largeImage').update(htmlcache);
	  		}
	  	});
	})
	
	
  var thumbs = $$('div.prodThumb');
  thumbs.each(function(el) {
  	el.observe('mouseover', function(event) {
  		var details = el.down('div.details');
  		var replace = $('farRightCol');
  		if (details.innerHTML == replace.innerHTML) {
  			return;
  		}
  		htmlcache = $('farRightCol').innerHTML;
  		$('farRightCol').update(details.innerHTML);

		details.update(replace.innerHTML);
  		
  	});
  	
  	el.observe('mouseout', function(event) {
  		if (htmlcache != null) {
  			$('farRightCol').update(htmlcache);
  		}
  	});
  });
});

var requestOrderDetails = function(element) {
	return $(element).request({
		onSuccess: function(transport) {
			showThickBox(transport);
		}
	});
}

function showThickBox(transport) {
	facebox.loading();
	facebox.reveal(transport.responseText);
	new Effect.Appear($('facebox'), {duration: 0.2, fps: 100});
	//$('facebox').show();
	
	if (form = $('facebox').down('form')) {
		Event.observe(form, 'submit', function(event) {
	  		formSubmit(form);
	  		Event.stop(event);
	 	});
 	}
	
	//Trigger the event thickBoxLoaded.
	//If the developer wants to execute some JS functions at the thick box load,
	//all they have to do is to declare a function called thickBoxLoaded in their javascript file. 
	if (typeof thickBoxLoaded == "function")
		thickBoxLoaded();
}
