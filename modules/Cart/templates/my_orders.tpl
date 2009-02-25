<h2>My Orders</h2>
<br><br>
<table id="myOrders" style="clear: both; float: left;" width=100% border="0" cellpadding="0" cellspacing="0">
	<tbody>
	<tr>
		<th valign="center">Order #</th>
		<th valign="center">Date</th>
		<th valign="center">Status</th>
		<th valign="center">Total</th>
		<th style="width: 50px;" valign="center">Details</th>
	</tr>
	{foreach from=$orders item=order}
	{cycle values="row1,row2" assign="rowClass"}
	<tr class="{$rowClass}">
		<td>{$order->getId()}</td>
		<td>{$order->getDate_purchased()|date_format}</td>
		<td>{$order->getStatus()->getName()}</td>
		<td>${$order->getTotal()} ({$order->getCurrency()})</td>
		<td>
			<form method="POST" action="/store/orderDetails/" style="float: left;" onSubmit="return !requestOrderDetails(this);">
				<input type="hidden" name="cartorder_orders_id" value="{$order->getId()}" />
				<input type="image" name="details" id="details" value="details" src="/modules/Cart/images/basket_go.png" />
			</form>
		</td>
	</tr>
	<tr class="{$rowClass}">
		<td colspan="5">
			<p><strong>Delivery Address:</strong> {$order->getDeliveryAddress()}</p>
			<p><strong>Billing Address:</strong> {$order->getBillingAddress()}</p>
		</td>
	</tr>
{/foreach}
</tbody>
</table>