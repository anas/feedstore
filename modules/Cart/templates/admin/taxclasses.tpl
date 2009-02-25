{include file="admin/subnav.tpl"}

<h3>Tax Classes</h3>

<div id="header">
	<ul id="primary">
		<li><a href="/admin/Cart&section=tax_classes&action=addedit" title="Create New">Create New</a></li>
	</ul>
</div>
<table class="adminList" style="clear: both; float: left;" border="0" cellpadding="0" cellspacing="0">

	<tbody><tr>
		<th valign="center">Title</th>
		<th valign="center">Description</th>
		<th style="width: 50px;" valign="center">Actions</th>

	</tr>
	
	{foreach from=$taxclasses item=class}
	<tr class="{cycle values="row1,row2"}">
		<td>{$class->getTitle()|strip_tags}</td>
		<td>{$class->getDescription()}</td>
		<td>
		<form method="POST" action="/admin/Cart" style="float: left;" onSubmit="return !thickboxAddEdit(this);">
				<input type="hidden" name="carttaxclass_tax_class_id" value="{$class->getId()}" />
				<input type="hidden" name="section" value="tax_classes" />
				<input type="hidden" name="action" value="addedit" />
				<input type="image" name="edit" id="edit" value="edit" src="/images/admin/pencil.gif" />
			</form>
			<form method="POST" action="/admin/Cart" onsubmit="return !deleteConfirm(this);" style="float: left;">
				<input type="hidden" name="carttaxclass_tax_class_id" value="{$class->getId()}" />
				<input type="hidden" name="section" value="tax_classes" />
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