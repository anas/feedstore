{foreach from=$productTypes item=productType}
	{counter start=$count assign=count}
	<tr class="{cycle values="row1,row2"}">
	<td>{$productType->getName()}</td>
	<td>{$productType->getCountProducts()}</td>
	<td>
	<form method="POST" action="/admin/Cart" style="float: left;">
		<input type="hidden" name="section" value="product_types" />
		<input type="hidden" name="cartproducttype_type_id" value="{$productType->getId()}" />
		<input type="hidden" name="action" value="addedit" />
		<input type="image" name="edit" id="edit" value="edit" src="/images/admin/pencil.gif" />
	</form>
	<form method="POST" action="/admin/Cart" onsubmit="return !deleteConfirm(this);" style="float: left;">
		<input type="hidden" name="section" value="product_types" />
		<input type="hidden" name="cartproducttype_type_id" value="{$productType->getId()}" />
		<input type="hidden" name="action" value="delete" />
		<input type="image" name="delete" id="delete" value="delete" src="/images/admin/cross.gif" />
	</form>
	</td>
	</tr>
{/foreach}
