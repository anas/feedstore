<div id="orderInfo">
	<h2>Order Details [#{$order->getId()}]</h2>
	<strong>Order Date:</strong> {$order->getDate_purchased()|date_format} <br />
	<strong>Status:</strong> {$order->getStatus()->getName()}<br />
	<strong>Total:</strong> {$order->getTotal()}<br />
	<strong>Currency:</strong> {$order->getCurrency()}<br />
	<strong>Payment Method:</strong> {$order->getPaymentMethod()} <br />
	<strong>Reference number:</strong> {$order->getPaypal_ipn_id()} <br />
	<br />
	<p>
	Phone: {$order->getCustomerTelephone()}<br />
	Email: <a href="mailto:{$order->getCustomerEmail()}">{$order->getCustomerEmail()}</a>
	</p>
	
	<table width="100%">
	<tr>
		<td valign="top">
			<strong>Delivery Info:</strong> <br />
			{$order->getDeliveryAddress()->getStreetAddress()} <br />
			{$order->getDeliveryAddress()->getCity()} <br />
			{$order->getDeliveryAddress()->getStateName()} <br />
			{$order->getDeliveryAddress()->getPostalCode()} <br />
			{$order->getDeliveryAddress()->getCountryName()} <br />
		</td>
		<td valign="top">
			<strong>Billing Info:</strong> <br />
			{$order->getBillingAddress()->getStreetAddress()} <br />
			{$order->getBillingAddress()->getCity()} <br />
			{$order->getBillingAddress()->getStateName()} <br />
			{$order->getBillingAddress()->getPostalCode()} <br />
			{$order->getBillingAddress()->getCountryName()} <br />
		</td>
	</tr>
	</table>
	
	<br />
	
	<table width="100%" id="order_product_list">
		<tr>
			<td>Product</td>
			<td>Tax</td>
			<td>Unit Price</td>
			<td>Total</td>
		</tr>
		{foreach from=$order->getOrderProducts() item=product}
		<tr>
			<td valign="top">
				{$product->getQuantity()} x {$product->getName()}
				{if $product->getOrderProductAttributes()}
				<ul class="productAttributes">
					{foreach from=$product->getOrderProductAttributes() item=attribute}
					<li>{$attribute.products_options}: {$attribute.products_options_values} ({$attribute.price_prefix}${math equation="q * x" q=$product->getQuantity() x=$attribute.options_values_price})</li>
					{/foreach}
				</ul>
				{/if}
			</td>
			<td valign="top">{$product->getTax()|string_format:"%.2f"}%</td>
			<td valign="top">${$product->getPrice()|string_format:"%.2f"}</td>
			<td valign="top">${$product->getFinalPrice()|string_format:"%.2f"}</td>
		</tr>
		{/foreach}
		{foreach from=$order->getOrderTotals() item=total}
		<tr>
			<td colspan="2">&nbsp;</td>
			<td><strong>{$total.title}</strong></td>
			<td>{$total.text}</td>
		</tr>
		{/foreach}
	</table>
	
	<br />
	
	<h2>Delivery Directions</h2>
	{nl2br st=$order->getDeliveryDirections()}
	
	<br />
	<h2>Comments</h2>
	{foreach from=$order->getOrderHistory() item=status}
	<p>
	<strong>{$status->getStatus()->getName()}  @ {$status->getDate_added()|date_format:"%Y-%m-%d %H:%M:%S"}: </strong>
	{$status->getComments()|default:"<em>no comment</em>"}
	</p>
	{/foreach}
</div>
<br style="clear:both;"><br/>
<a href="#" onclick="javascript:printOrder();">Friendly Print</p>