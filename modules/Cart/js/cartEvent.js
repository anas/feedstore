function thickBoxLoaded(){//This function will get called right after the thick box is loaded
	selectCountry();	
}

function selectCountry(){
	var r = $('cartshippingrate_country');
	var selectedCountry = r.options[r.selectedIndex].text;
	if (selectedCountry == "Canada"){
		$("cartshippingrate_state").up('li').show();		
	}
	else{
		$("cartshippingrate_state").up('li').hide();		
	}	
}
