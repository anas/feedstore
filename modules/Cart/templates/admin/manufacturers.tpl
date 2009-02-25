{include file="admin/subnav.tpl"}

<h3>Suppliers</h3>


<a href="/admin/Cart&section=manufacturers&action=addedit" title="Create New">Create New</a>

<table class="adminList" style="clear: both; float: left;" border="0" cellpadding="0" cellspacing="0">

	<tbody><tr>
		<th valign="center">Name</th>
		<th style="width: 50px;" valign="center">Actions</th>

	</tr>
	
	{foreach from=$manufacturers item=manufacturer}
	<tr class="{cycle values="row1,row2"}">
		<td>{$manufacturer->getName()|strip_tags}</td>
		<td>
		<form method="POST" action="/admin/Cart" style="float: left;">
				<input type="hidden" name="cartmanufacturer_manufacturers_id" value="{$manufacturer->getId()}" />
				<input type="hidden" name="section" value="manufacturers" />
				<input type="hidden" name="action" value="addedit" />
				<input type="image" name="edit" id="edit" value="edit" src="/images/admin/pencil.gif" />
			</form>
			<form method="POST" action="/admin/Cart" onsubmit="return !deleteConfirm(this);" style="float: left;">
				<input type="hidden" name="cartmanufacturer_manufacturers_id" value="{$manufacturer->getId()}" />
				<input type="hidden" name="section" value="manufacturers" />
				<input type="hidden" name="action" value="delete" />
				<input type="image" name="delete" id="delete" value="delete" src="/images/admin/cross.gif" />
			</form>
		</td>
	</tr>
{/foreach}

</tbody>
</table>

<div id="thickbox_wrapper" style="display: none;">
	<div id="thickbox_header" style="display: block;">&nbsp;</div>
	<div id="thickbox">&nbsp;</div>
	<div id="thickbox_footer">&nbsp;</div>
</div>