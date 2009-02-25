<select name="pay_type">
{foreach from=$payment_types item=type}
	<option value="{$type->getClass()}">{$type->getName()}</option>
{/foreach}
</select>

<div id="pay_form">
</div>