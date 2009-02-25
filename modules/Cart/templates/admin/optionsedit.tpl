{$form->display()}

<form action="/admin/Cart" method="post">
<input type="hidden" name="section" value="attributes" />
<input type="hidden" name="action" value="addedit" />
<input type="hidden" name="cartproductoption_id" value="{$option->getId()}" />

{if $option->getId()}
	<ul style="margin-left: 12px; list-style-type: none;">
	{foreach from=$values item=value}
		<li><label for="value_{$value->getId()}">Option {counter}:</label> <input id="value_{$value->getId()}" name="value[{$value->getId()}]" value="{$value->getName()}" />
		<input type="image" src="/images/admin/cross.gif" name="delete_value" id="delete_{$value->getId()}" onclick="return !deleteValue(this)"/>
		</li>
	{/foreach}
		<li id="addnewvalue"><a href="#" onclick="return !addNewValue(this);">Add New</a></li>
	</ul>

	<input type="submit" name="valuesubmit" value="Update Values" />
	</form>
{/if}
