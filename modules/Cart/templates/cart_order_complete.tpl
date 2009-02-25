<h1>Your order is complete</h1>

<h2>Order #{$order->getId()}</h2>

<p>Please print this page for your records</p>

{include file="cart_order_details.tpl"}

<h1>Billing Address</h1>
<p id="billing_address">
{include file="cart_address_format.tpl" address=$bill_address adr_type="billing_address" noedit=true}
</p>

<h1>Shipping Address</h1>
<p id="shipping_address">
{include file="cart_address_format.tpl" address=$ship_address adr_type="shipping_address" noedit=true}
</p>
