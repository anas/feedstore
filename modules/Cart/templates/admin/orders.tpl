{include file="admin/subnav.tpl"}

<table class="adminList" style="clear: both; float: left;" border="0" cellpadding="0" cellspacing="0">

	<tbody><tr>
		<th valign="center">Customer Name</th>
		<th valign="center">Date</th>
		<th valign="center">Pay Type</th>
		<th valign="center">Status</th>
		<th valign="center">Total</th>
		<th style="width: 50px;" valign="center">Actions</th>

	</tr>
	
	{foreach from=$orders item=order}
	{cycle values="row1,row2" assign="rowClass"}
	<tr class="{$rowClass}">
		<td>{$order->getCustomer()->getName()|strip_tags}</td>
		<td>{$order->getDate_purchased()|date_format}</td>
		<td>{$order->getPaymentMethod()}</td>
		<td>{$order->getStatus()->getName()}</td>
		<td>${$order->getTotal()} ({$order->getCurrency()})</td>
		<td>
		<form method="POST" action="/admin/Cart" style="float: left;" onSubmit="return !thickboxAddEdit(this);">
				<input type="hidden" name="cartorder_orders_id" value="{$order->getId()}" />
				<input type="hidden" name="section" value="orders" />
				<input type="hidden" name="action" value="details" />
				<input type="image" name="details" id="details" value="details" src="/modules/Cart/images/basket_go.png" />
			</form>
		<form method="POST" action="/admin/Cart" style="float: left;" onsubmit="return !thickboxAddEdit(this);">
				<input type="hidden" name="cartorder_orders_id" value="{$order->getId()}" />
				<input type="hidden" name="section" value="orders" />
				<input type="hidden" name="action" value="addedit" />
				<input type="image" name="edit" id="edit" value="edit" src="/images/admin/pencil.gif" />
			</form>
			<form method="POST" action="/admin/Cart" onsubmit="return !deleteConfirm(this);" style="float: left;">
				<input type="hidden" name="cartorder_orders_id" value="{$order->getId()}" />
				<input type="hidden" name="section" value="orders" />
				<input type="hidden" name="action" value="delete" />
				<input type="image" name="delete" id="delete" value="delete" src="/images/admin/cross.gif" />
			</form>
		</td>
	</tr>
	<tr class="{$rowClass}">
		<td colspan="6">
			<p><strong>Customers Address:</strong> {$order->getCustomerAddress()}</p>
			<p><strong>Delivery Address:</strong> {$order->getDeliveryAddress()}</p>
			<p><strong>Billing Address:</strong> {$order->getBillingAddress()}</p>
		</td>
	</tr>
{/foreach}

</tbody>
</table>