<h1>Products</h1>
<div id="cookieCrumbs">
	<a href="/store/&section=search&selSupplier={$product->getManufacturer()->getId()}">Supplier: ({$product->getManufacturer()->getName()})</a> ,
	<a href="/store/&section=search&selCategory={$product->getCategory()->getId()}">Category: ({$product->getCategory()->getName()})</a> ,
	<a href="/store/&section=search&selProductType={$product->getType()->getId()}">Product Type: ({$product->getType()->getName()})</a>
</div>

<div id="productHolder">
	<div id="productImage">
		<div id="largeImage"><img src="/images/image.php?id={$product->getImage()->getId()}&amp;w=141" border="0" /></div>
		<!--BEGIN THUMBS-->
		<div id="thumbnails">
			{foreach from=$product->getAltImages() item=image}
				<div class="thumbnailHolder">
					<a href="#"><img src="/images/image.php?id={$image.image_id}&amp;w=39" border="0" /></a>
					<div class="details">
						<a href="#"><img src="/images/image.php?id={$image.image_id}&amp;w=141" border="0" /></a>
					</div>
				</div>
			{/foreach}
		</div>
		<!--END THUMBS-->
	</div>

	<div id="productContent">
		<h4 id="title">{$product->getManufacturer()->getName()}</h4>
		<h5>{$product->getManufacturer()->getName()}</h5>
		<br />
		<p><b>Product Description:</b><br />
		{$product->getDescription()}
		<br /><br />
		
		<fieldset class="hidden">
			<label class="element">Weight</label>
			<div class="element">{$product->getWeight()} ({$product->getWeightUnit()})</div>
		</fieldset>
		
		<fieldset class="hidden">
			<label class="element">Price</label>
			<div class="element">${$product->getPrice()|string_format:"%.2f"}</div>
		</fieldset>
		<div id="pay_form">
			{$product->getAddToCartForm()->display()}
		</div>
	</div>
</div>