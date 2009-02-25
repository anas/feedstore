{include file="admin/subnav.tpl"}

<h3>Shipping Rates</h3>

<div id="header">
	<ul id="primary">
		<li><a href="/admin/Cart&section=shipping&action=addedit" title="Create New">Create New</a></li>
	</ul>
</div>
<table class="adminList" style="clear: both; float: left;" border="0" cellpadding="0" cellspacing="0">

	<tbody><tr>
		<th valign="center">State / Country</th>
		<th valign="center">Shipping Cost</th>
		<th style="width: 50px;" valign="center">Actions</th>

	</tr>
	
	{foreach from=$rates item=rate}
	<tr class="{cycle values="row1,row2"}">
		<td>
			{$rate->countryname}
			{if ($rate->statename)}
				, 
				{$rate->statename}
			{/if}
		</td>
		<td>{$rate->getCost()}</td>
		<td>
			<form method="POST" action="/admin/Cart" style="float: left;" onSubmit="return !thickboxAddEdit(this);">
				<input type="hidden" name="cartshippingrate_id" value="{$rate->getId()}" />
				<input type="hidden" name="section" value="shipping" />
				<input type="hidden" name="action" value="addedit" />
				<input type="image" name="edit" id="edit" value="edit" src="/images/admin/pencil.gif" />
			</form>
			<form method="POST" action="/admin/Cart" onsubmit="return !deleteConfirm(this);" style="float: left;">
				<input type="hidden" name="cartshippingrate_id" value="{$rate->getId()}" />
				<input type="hidden" name="section" value="shipping" />
				<input type="hidden" name="action" value="delete" />
				<input type="image" name="delete" id="delete" value="delete" src="/images/admin/cross.gif" />
			</form>
		</td>
	</tr>
{/foreach}

</tbody>
</table>