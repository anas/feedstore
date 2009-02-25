<p>Welcome to your shopping cart. You have to register as a user first in order to continue to your checkout page.</p>
<table id="cart_products" width="100%">
	<thead>
	<tr>
		<th>Delete</th>
		<th>Product</th>
		<th>Quantity</th>
		<th>Price / Unit</th>
		<th>Total</th>
	</tr>
	</thead>
	<tbody>
{foreach from=$cart item=item}
	<tr class="{cycle values="cart_row1,cart_row2"}">
		<td>
		<form action="/store/cart" method="post">
			{if $item->getId()}
			<input type="hidden" name="cartbasket_id" value="{$item->getId()}" />
			{else}
			<input type="hidden" name="product_id" value="{$item->getProduct()->getId()}" />
			{/if}
			<input type="image" src="/images/admin/cross.gif" name="action" value="remove" />
		</form>
		</td>
		<td><a href="/store/product/{$item->getProduct()->getId()}" rel="facebox">{$item->getProduct()->getName()}{if $item->getAttribute()}<br />{$item->getAttribute()->getValueText()}{/if}</a></td>
		<td>{$item->getQuantity()}</td>
		<td>${$item->getPrice()|string_format:"%.2f"}</td>
		{math equation="productPrice * productQuantity" productPrice=$item->getPrice() productQuantity=$item->getQuantity() assign=price}
		<td>${$price|string_format:"%.2f"}</td>
	</tr>
{/foreach}
	<tr>
		<td colspan="3"></td>
		<td align="right"><strong>Subtotal</strong></td>
		<td>${$module->getSubtotal()}</td>
	</tr>
{if $module->getTax()}
	<tr>
		<td colspan="4" align="right"><strong>Tax</strong></td>
		<td>${$module->getTax()}</td>
	</tr>
{/if}
{if $shipping}
	<tr>
		<td colspan="4" align="right"><strong>Shipping</strong></td>
		<td>${$module->getShipping()}</td>
	</tr>
{/if}
	<tr>
		<td colspan="3"></td>
		<td align="right"><strong>TOTAL</strong></td>
		<td><strong>${$module->getTotal()} CAD</strong></td>
	</tr>
	</tbody>
</table>