<form name="frm_cartsearch" method="POST" action="/store/cart">
<input type="hidden" name="section" value="search">
<table width="240" border="0">
	<tr>
	  <td><h3>Supplier</h3></td>
	</tr>
	<tr>
	  <td>
	  	<select class="orderSelect" id="selSupplier" name="selSupplier">
			<option value="">All</option>
			{assign var=suppliers value=$module->getSearchMenu('Suppliers')}
			{foreach from=$suppliers item=supplier}
				<option value="{$supplier->getId()}" {if ($selSupplier == $supplier->getId())} selected {/if}>{$supplier->getName()|truncate:30}</option>
			{/foreach}
		</select>
	  </td>
	</tr>
	<tr>
	  <td><h3>Category</h3></td>
	</tr>
	<tr>
	  <td>
	  	<select class="orderSelect" id="selCategory" name="selCategory">
			<option value="">All</option>
			{assign var=categories value=$module->getSearchMenu('Categories')}
			{foreach from=$categories item=category}
				<option value="{$category->getId()}" {if ($selCategory == $category->getId())} selected {/if}>{$category->getName()|truncate:30}</option>
			{/foreach}
		</select>
	  </td>
	</tr>
	<tr>
	  <td><h3>Product Type</h3></td>
	</tr>
	<tr>
	  <td>
	  	<select class="orderSelect" id="selProductType" name="selProductType">
			<option value="">All</option>
			{assign var=productTypes value=$module->getSearchMenu('ProductTypes')}
			{foreach from=$productTypes item=productType}
				<option value="{$productType->getId()}" {if ($selProductType == $productType->getId())} selected {/if}>{$productType->getName()|truncate:30}</option>
			{/foreach}
		</select>
	  </td>
	</tr>
	<tr>
	  <td><h3>Order products 24 hours a day whenever it's convenient for you!</h3><br /></td>
	</tr>
	<tr>
	  <td><input type="image" src="/images/searchBtn.jpg" /></td>
	</tr>
</table>
</form>