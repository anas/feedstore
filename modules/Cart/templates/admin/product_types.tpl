{include file="admin/subnav.tpl"}

<a href="/admin/Cart&section=product_types&amp;action=addedit">Create New Product Type</a>

<table class="adminList" style="clear: both; float: left;" border="0" cellpadding="0" cellspacing="0">

	<tbody><tr>
		<th valign="center">Title</th>
		<th valign="center">Products</th>
		<th style="width: 100px;" valign="center">Actions</th>

	</tr>
	{include file="admin/renderproduct_types.tpl" count=0}
	</tbody>
	</table>
