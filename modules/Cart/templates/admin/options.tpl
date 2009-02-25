{include file="admin/subnav.tpl"}

<a href="/admin/Cart&amp;section=attributes&amp;action=addedit">Create New</a>

<table class="adminList" style="clear: both; float: left;" border="0" cellpadding="0" cellspacing="0">

	<tbody><tr>
		<th valign="center">Name</th>
		<th style="width: 50px;" valign="center">Actions</th>

	</tr>
{foreach from=$options item=option}

	
		<tr class="{cycle values="row1,row2"}">
		<td>{$option->getName()}</td>
		<td>
		<form method="POST" action="/admin/Cart" style="float: left;" onsubmit="return !thickboxAddEdit(this);">
				<input type="hidden" name="cartproductoption_id" value="{$option->getId()}" />
				<input type="hidden" name="section" value="attributes" />
				<input type="hidden" name="action" value="addedit" />

				<input type="image" name="edit" id="edit" value="edit" src="/images/admin/pencil.gif" />
			</form>
			<form method="POST" action="/admin/Cart" onsubmit="return !deleteConfirm(this);" style="float: left;">
				<input type="hidden" name="cartproductoption_id" value="{$option->getId()}" />
				<input type="hidden" name="section" value="attributes" />
				<input type="hidden" name="action" value="delete" />
				<input type="image" name="delete" id="delete" value="delete" src="/images/admin/cross.gif" />
			</form>
		</td>

	</tr>

{/foreach}
</tbody>
</table>