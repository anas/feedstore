{include file="admin/subnav.tpl"}

<h3>Tax Rates</h3>

<div id="header">
	<ul id="primary">
		<li><a href="/admin/Cart&section=tax_rates&action=addedit" title="Create New">Create New</a></li>
	</ul>
</div>
<table class="adminList" style="clear: both; float: left;" border="0" cellpadding="0" cellspacing="0">

	<tbody><tr>
		<th valign="center">Title</th>
		<th valign="center">Tax Rate (%)</th>
		<th valign="center">Zone</th>
		<th style="width: 50px;" valign="center">Actions</th>

	</tr>
	
	{foreach from=$taxrates item=rate}
	<tr class="{cycle values="row1,row2"}">
		<td>{$rate->getDescription()|strip_tags}</td>
		<td>{$rate->getRate()}</td>
		<td>{$rate->getZoneName()}</td>
		<td>
		<form method="POST" action="/admin/Cart" style="float: left;" onSubmit="return !thickboxAddEdit(this);">
				<input type="hidden" name="carttaxrate_tax_rates_id" value="{$rate->getId()}" />
				<input type="hidden" name="section" value="tax_rates" />
				<input type="hidden" name="action" value="addedit" />
				<input type="image" name="edit" id="edit" value="edit" src="/images/admin/pencil.gif" />
			</form>
			<form method="POST" action="/admin/Cart" onsubmit="return !deleteConfirm(this);" style="float: left;">
				<input type="hidden" name="carttaxrate_tax_rates_id" value="{$rate->getId()}" />
				<input type="hidden" name="section" value="tax_rates" />
				<input type="hidden" name="action" value="delete" />
				<input type="image" name="delete" id="delete" value="delete" src="/images/admin/cross.gif" />
			</form>
		</td>
	</tr>
{/foreach}

</tbody>
</table>

{*
<div id="thickbox_wrapper" style="display: none;">
	<div id="thickbox_header" style="display: block;">&nbsp;</div>
	<div id="thickbox">&nbsp;</div>
	<div id="thickbox_footer">&nbsp;</div>
</div> *}