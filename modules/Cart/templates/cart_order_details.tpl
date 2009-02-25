<div id="cart_detail">
<table width="100%" id="order_product_list">
	<thead>
	<tr>
		<td>Product</td>
		<td>Model #</td>
		<td>Tax</td>
		<td>Unit Price</td>
		<td>Total</td>
	</tr>
	</thead>
	{foreach from=$order->getOrderProducts() item=product}
	<tr>
		<td valign="top">
			{$product->getQuantity()} x {$product->getName()}
			{if $product->getOrderProductAttributes()}
			<ul class="productAttributes">
				{foreach from=$product->getOrderProductAttributes() item=attribute}
				<li>{$attribute.products_options}: {$attribute.products_options_values} ({$attribute.price_prefix|default:"+"}${math equation="q * x" q=$product->getQuantity() x=$attribute.options_values_price})</li>
				{/foreach}
			</ul>
			{/if}
		</td>
		<td valign="top">{$product->getModel()}</td>
		<td valign="top">{$product->getTax()|string_format:"%.2f"}%</td>
		<td valign="top">${$product->getPrice()|string_format:"%.2f"}</td>
		<td valign="top">${$product->getFinalPrice()|string_format:"%.2f"}</td>
	</tr>
	{/foreach}
	{foreach from=$order->getOrderTotals() item=total}
	<tr>
		<td colspan="3">&nbsp;</td>
		<td><strong>{$total.title}</strong></td>
		<td>{$total.text}</td>
	</tr>
	{/foreach}
</table>
</div>