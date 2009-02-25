{if $userNotLoggedIn || $paymentLessThanMinimum || $shippingAddressNotPresent || $billingAddressNotPresent || $shipmentTypeNotPresent}
You cannot proceed to the payment right now, you are missing the following:

{else}
proceed
{/if}
{if $userNotLoggedIn}
You have to login first to be able to checkout.

{/if}
{if $paymentLessThanMinimum}
We maintain a minimum order of ${$minimumPayment}, please go back to our store and select more items in order to meet this minimum requirement for checking out.

{/if}
{if $shippingAddressNotPresent}
You have not entered your shipping address

{/if}
{if $billingAddressNotPresent}
You have not entered your billing address

{/if}