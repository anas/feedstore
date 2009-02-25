{if $cur_cat}<h1 class="title">{$cur_cat->getName()}</h1>
{$cur_cat->getDescription()}
{/if}

{if $categories}
	{foreach from=$categories item=category}
		{if $category->getId()}
			<div class="categoryHolder">
				<div class="categoryImage"><a href="/store/category/{$category->getId()}"><img border="0" src="/images/image.php?id={$category->getImage()}&amp;cliph=140"/></a></div>
				<div class="categoryContent">
					<h4>{$category->getName()}</h4>
					<h5>{$category->getDescription()|strip_tags|truncate:"50":" ..."}</h5>
					<a href="/store/category/{$category->getId()}">View Info</a>
				</div>
			</div>
		{/if}
	{/foreach}
{/if}


{if $suppliers}
	{foreach from=$suppliers item=supplier}
		{if $supplier->getId()}
			<div class="categoryHolder">
				<div class="categoryImage"><a href="/store/&section=search&selSupplier={$supplier->getId()}"><img border="0" src="/images/image.php?id={$supplier->getImage()->getId()}&amp;cliph=140"/></a></div>
				<div class="categoryContent">
					<h4>{$supplier->getName()}</h4>
					<a href="/store/&section=search&selSupplier={$supplier->getId()}">View Info</a>
				</div>
			</div>
		{/if}
	{/foreach}
{/if}


{if $products}
	<p>
	{if $page_numbers.total > 1}
		{$pager_links}
	{/if}
	</p>
	{assign var=i value=0}
	{foreach from=$products item=product}
      <div class="categoryHolder">
      	<div class="categoryImage"><a href="/store/product/{$product->getId()}"><img border="0" src="/images/image.php?id={$product->getImage()->getId()}&amp;cliph=140"/></a></div>
        <div class="categoryContent">
        	<h4>{$product->getName()}</h4>
            <h5>${$product->getPrice()|string_format:"%.2f"}</h5>
            <a href="/store/product/{$product->getId()}">View Info</a>
        </div>
      </div>
	  {assign var=i value=$i+1}
	  {if $i == 4}
		  {assign var=i value=0}
		  <br style="clear:both;">
	  {/if}
	{/foreach}
{/if}

{if !$categories && !$products && !$suppliers}
<h2>Category is Empty</h2>
<p>There are currently no products to view here.</p>
{/if}

</div>
<div id="farRightCol">
	{if $manufacturer}
	<h1 class="title">{$manufacturer->getName()}</h1>
	{if $manufacturer->getImage()}<img src="/images/image.php?id={$manufacturer->getImage()->getId()}&amp;w=153" />{/if}
	{if $manufacturer->getDescription()}
	<p>{$manufacturer->getDescription()}</p>
{/if}
{/if}