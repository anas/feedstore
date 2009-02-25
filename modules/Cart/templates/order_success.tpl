You have a new order. Check your administration area for more details:

Order #{$order->getId()}

{foreach from=$order->getOrderProducts() item=product}
{$product->getQuantity()} x {$product->getName()}
{if $product->getOrderProductAttributes()}
{foreach from=$product->getOrderProductAttributes() item=attribute}
{$attribute.products_options}: {$attribute.products_options_values} ({$attribute.price_prefix}
{/foreach}
{/if}
{/foreach}

Shipping Address:
{if $address->getId()}
{$address->getStreetAddress()}
{$address->getCity()}, {$address->getStateCode()}, {$address->getPostalCode()}
{$address->getCountryName()} <br />
{/if}