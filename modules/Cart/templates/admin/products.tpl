{include file="admin/subnav.tpl"}

<a href="/admin/Cart&section=products&action=addedit">Create New Product</a>

<p>

<div id="auto_stuff">
<form method="post">
<input type="text" id="autocomplete" name="autocomplete_parameter"/>
<span id="indicator1" style="display: none">
  <img src="/images/spinner.gif" alt="Working..." />
</span>
<div id="autocomplete_choices" class="autocomplete"></div>
<input type="submit" value="Edit Product" />

<input type="hidden" name="cartproduct_products_id" id="cartproduct_products_id" value="" />
<input type="hidden" name="section" value="products" />
<input type="hidden" name="action" value="addedit" />
</form>
</div>

{if $page_numbers.total > 1}
{$pager_links}
{/if}
</p>

<script>{literal}
new Ajax.Autocompleter("autocomplete", "autocomplete_choices", "/admin/Cart&section=products&action=auto", { paramName: "value", afterUpdateElement: function(text, li) {
	$('cartproduct_products_id').value = li.id;
} });

{/literal}</script>

<table class="adminList" style="clear: both; float: left;" border="0" cellpadding="0" cellspacing="0">

	<tbody><tr>
		<th valign="center">Title</th>
		<th valign="center">Pallet Count</th>
		<th valign="center">Status</th>
		<th valign="center">Price</th>
		<th valign="center">Qty In Stock</th>
		<th style="width: 50px;" valign="center">Actions</th>

	</tr>
	
	{foreach from=$products item=product}
	<tr class="{cycle values="row1,row2"}">
		<td>{$product->getName()|strip_tags}</td>
		<td>{$product->getPalletCount()}</td>
		<td>
			<img src="/modules/Cart/images/{if $product->getStatus()}icon_green_on.gif{else}icon_red_on.gif{/if}" />
			{if $product->getOptimizationTips()}
				<img src="/modules/Cart/images/icon_yellow_on.gif" title="{foreach from=$product->getOptimizationTips() item=tip}{$tip}{/foreach}"/>
			{/if}
		</td>
		<td>
			{if $product->getSpecials()}<strike style="color: red;">{/if}
			${$product->getPrice()|string_format:"%.2f"}
			{if $product->getSpecials()}</strike>{/if}
			{if $product->getSpecials()}
				<span style="color: red; font-weight: bolder;">Sale</span> ${$product->getSpecials()->getNew_products_price()|string_format:"%.2f"}
			{/if}
		</td>
		<td>{$product->getQuantity()}</td>
		<td>
		<form method="POST" action="/admin/Cart" style="float: left;">
				<input type="hidden" name="cartproduct_products_id" value="{$product->getId()}" />
				<input type="hidden" name="section" value="products" />
				<input type="hidden" name="action" value="addedit" />
				<input type="image" name="edit" id="edit" value="edit" src="/images/admin/pencil.gif" />
			</form>
			<form method="POST" action="/admin/Cart" onsubmit="return !deleteConfirm(this);" style="float: left;">
				<input type="hidden" name="cartproduct_products_id" value="{$product->getId()}" />
				<input type="hidden" name="section" value="products" />
				<input type="hidden" name="action" value="delete" />
				<input type="image" name="delete" id="delete" value="delete" src="/images/admin/cross.gif" />
			</form>
		</td>
	</tr>
{/foreach}

</tbody>
</table>