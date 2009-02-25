{if $address}
	{$address->getStreetAddress()}
	{if $address->getStreetAddress()}<br />{/if}
	
	{$address->getCity()}
	{if $address->getCity()},{/if}
	
	{$address->getStateCode()}
	{if $address->getStateCode()},{/if}
	
	{$address->getPostalCode()}
	{if $address->getCity() || $address->getStateCode() || $address->getPostalCode()}<br />{/if}
	
	{$address->getCountryName()}
	{if $address->getCountryName()}<br />{/if}
{/if}
{if !$noedit}
	<a href="#" onclick="return !addressEdit('{$adr_type}');">Edit</a>
{/if}
{if $sameAsBilling}
	<a href="#" onclick="return !addressEdit('shipping_address', 1)">Same as billing address</a>
{/if}