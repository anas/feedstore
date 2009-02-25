<div id="orderInfo">
	<h2>Equine and Acreage Essentials</h2><br><br>
	Your order has been completed. Your reference number is {$order->getPaypal_ipn_id()}. Keep it in a safe place for future reference.<br><br>
	Your order information:<br><br>
	<b>Order #{$order->getId()}</b><br>
	
	{foreach from=$order->getOrderProducts() item=product}
		{math equation="x * y" x=$product->getQuantity() y=$product->getPrice() assign=productPrice}
		{$product->getQuantity()} x {$product->getName()}: ${$productPrice|string_format:"%.2f"}<br>
	{/foreach}
	<br>
	
	Tax: ${$order->getTax()}<br>
	Shipping cost: ${$shippingCost}<br>
	<b>Total value: ${$order->getTotal()}</b><br><br>
	
	Shipping Address:<br>
	{if $address->getId()}
		{$address->getStreetAddress()}<br>
		{$address->getCity()}, {$address->getStateCode()}, {$address->getPostalCode()}<br>
		{$address->getCountryName()} <br />
	{/if}
	<br><br>
	Thank you for your order. E&A Essentials will be contacting you in the next business day to confirm your delivery date and address.
</div>
<a href="#" onclick="javascript:printOrder();">Friendly Print</a>