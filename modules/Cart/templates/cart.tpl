{include file="cart_detail.tpl"}

<h1>Checkout</h1>

<h2>Returning Customer</h2>
{if !$user}
<p>Please enter your username and password below.</p>
<form method="post" action="/store/checkout">
<fieldset class="hidden">

<label for="username" class="element">Username:</label><div class="element"><input type="text" id="username" name="username" /></div>
<label for="password" class="element">Password:</label><div class="element"><input type="password" id="password" name="password" /></div>

<label for="submit" class="element">&nbsp;</label><div class="element"><input value="Login" id="doLogin" name="doLogin" type="submit" /></div>

</fieldset>
</form>
{else}
<form method="post" action="/store/checkout">
<fieldset class="hidden">
<input type="hidden" name="account" value="{$user->getId()}" />
<input type="submit" name="checkouttype_submit" value="Checkout" />

</fieldset>
</form>
{/if}

<h2>New Customer</h2>
{if $usernameexists}
<font color="red">Username already exists</font>
{/if}
{$user_form->display()}