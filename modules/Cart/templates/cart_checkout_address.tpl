<div id="cart_detail">{include file="cart_detail.tpl"}</div>

<h1>Billing Address</h1>
<div id="billing_address">
	{include file="cart_address_format.tpl" address=$bill_address adr_type="billing_address"}
</div>

<a href="/Content/Shipping" target="_blank">Click here</a> to see how the shipping cost is calculated<br>

<h1>Shipping Address</h1>
<div id="shipping_address">
	{include file="cart_address_format.tpl" address=$ship_address adr_type="shipping_address" sameAsBilling=1}
</div>

<h1>Delivery Directions:</h1>
<div id="delivery_directions">
	<textarea id="delivery_direction_textarea" cols="50" rows="10">{$delivery_direction}</textarea>
</div>
<a href="javascript:return;" onclick="javascript:updateDirections()">Update delivery directions</a>

<div id="payment_information">
<h1>Payment Information</h1>
<div id="pay_form">
{$payment_types->display()}
</div>
</div>