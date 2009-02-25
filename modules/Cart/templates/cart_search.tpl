{foreach from=$products item=product}
  <div class="categoryHolder">
  	<div class="categoryImage"><a href="/store/product/{$product->getId()}"><img border="0" src="/images/image.php?id={$product->getImage()->getId()}&amp;cliph=120"/></a></div>
    <div class="categoryContent">
    	<h4>{$product->getName()}</h4>
        <h5>${$product->getPrice()|string_format:"%.2f"}</h5>
        <a href="/store/product/{$product->getId()}">View Info</a>
    </div>
  </div>
{/foreach}
