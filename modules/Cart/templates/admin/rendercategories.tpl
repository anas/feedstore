{foreach from=$categories item=category}
	{counter start=$count assign=count}
	<tr class="{cycle values="row1,row2"}">
	{math equation="x * y + 5" x=$count y=30 assign=padding}
	<td style="padding-left: {$padding}px">{if $count > 0}<img src="/modules/Cart/images/subitem.png" />{/if} {$category->getName()}
	</td>
	<td>{$category->getCountCatProducts()}</td>
	<td>
	<form method="POST" action="/admin/Cart" style="float: left;">
				<input type="hidden" name="cartcategory_categories_id" value="{$category->getId()}" />
				<input type="hidden" name="section" value="categories" />
				<input type="hidden" name="action" value="addedit" />
				<input type="image" name="edit" id="edit" value="edit" src="/images/admin/pencil.gif" />
			</form>
			<form method="POST" action="/admin/Cart" onsubmit="return !deleteConfirm(this);" style="float: left;">
				<input type="hidden" name="cartcategory_categories_id" value="{$category->getId()}" />
				<input type="hidden" name="section" value="categories" />
				<input type="hidden" name="action" value="delete" />
				<input type="image" name="delete" id="delete" value="delete" src="/images/admin/cross.gif" />
			</form>
	
	</td>
	</tr>
	{assign var='subcats' value=$category->getSubCategories()}
	{if $subcats}
		{math equation="x + y" x=$count y=1 assign=inccount}
		{include file="admin/rendercategories.tpl" categories=$subcats count=$inccount}
	{/if}
{/foreach}
