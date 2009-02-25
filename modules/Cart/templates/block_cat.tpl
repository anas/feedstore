{assign var="crumbs" value=$module->getCatsPath()}

{foreach from=$crumbs item=crumb}
<li id="l_{counter}">
	<h3 class="drawer-handle">{$crumb->getName()}</h3>
	<div class="drawer-content">
		<ul class="summary" style="padding: 10px">
			{foreach from=$crumb->getSubCategories() item=sub}
				<li><a href="/store/category/{$sub->getId()}">{$sub->getName()}</a></li>
			{foreachelse}
				{foreach from=$crumb->getCatManufacturers() item=man}
				{if $man->getId()}
				<li><a href="/store/category/{$crumb->getId()}/manufacturer/{$man->getId()}">{$man->getName()}</a></li>
				{/if}
				{/foreach}
			{/foreach}
		</ul>
	</div>
</li>
{/foreach}
{if $product && $product->getManufacturer()->getId()}
<li id="l_{counter}">
	<h3 class="drawer-handle">{$product->getManufacturer()->getName()}</h3>
	<div class="drawer-content">
		<ul class="summary" style="padding: 10px">
			{foreach from=$product->getManufacturer()->getProductsByCategory($crumb->getId()) item=p}
				<li><a href="/store/product/{$p->getId()}">{$p->getName()}</a></li>
			{/foreach}
		</ul>
	</div>
</li>

{/if}

{if $product && $product->getType()->getHandler() == 'multigas'}
<li id="l_{counter}">
	<h3 class="drawer-handle">Part Number Generator</h3>
	<div class="drawer-content">
		<h4>Part Number Generator</h4>
		<br />
		<form action="" method="post">
		
		Target Gas: <br />
		<select name="targetgas" style="width: 100%;">
			<option value="0">CH<sub>4</sub></option>
			<option value="1">C<sub>5</sub>H<sub>12</sub></option>
			<option value="2">C<sub>5</sub>H<sub>14</sub></option>
		</select><br /><br />
		
		Concentration: <br />
		<select name="targetgas" style="width: 100%;">
		{foreach from=$virtualatts.conc item=i}
		<option>{$i}</option>
		{/foreach}
		</select><br /><br />
		
		Carbon Monoxide (CO): <br />
		<select name="targetgas" style="width: 100%;">
		{foreach from=$virtualatts.co item=i}
		<option>{$i}</option>
		{/foreach}
		</select><br /><br />
		
		Hydrogen Sulfide (H<sub>2</sub>S): <br />
		<select name="targetgas" style="width: 100%;">
		{foreach from=$virtualatts.h2s item=i}
		<option>{$i}</option>
		{/foreach}
		</select><br /><br />
		
		Oxygen (O<sub>2</sub>): <br />
		<select name="targetgas" style="width: 100%;">
		{foreach from=$virtualatts.o2 item=i}
		<option>{$i}</option>
		{/foreach}
		</select><br /><br />
		
		Balance: <br />
		<select name="targetgas" style="width: 100%;">
		{foreach from=$virtualatts.bal item=i}
		<option>{$i}</option>
		{/foreach}
		</select><br /><br />
		
		Size: <br />
		<select name="targetgas" style="width: 100%;">
		{foreach from=$virtualatts.size item=i}
		<option>{$i}</option>
		{/foreach}
		</select><br /><br />
		
		</form>
	</div>
</li>
{else if $product && $product->getType()->getHandler() == 'nonreactmulti'}
<li id="l_{counter}">
	<h3 class="drawer-handle">Part Number Generator</h3>
	<div class="drawer-content">
		<h4>Part Number Generator</h4>
		<br />
		<form action="" method="post">
		
		Target Gas: <br />
		<select name="targetgas" style="width: 100%;">
			<option value="0">CH<sub>4</sub></option>
			<option value="1">C<sub>5</sub>H<sub>12</sub></option>
			<option value="2">C<sub>5</sub>H<sub>14</sub></option>
		</select><br /><br />
		
		Concentration: <br />
		<select name="targetgas" style="width: 100%;">
		{foreach from=$virtualatts.conc item=i}
		<option>{$i}</option>
		{/foreach}
		</select><br /><br />
		
		Carbon Monoxide (CO): <br />
		<select name="targetgas" style="width: 100%;">
		{foreach from=$virtualatts.co item=i}
		<option>{$i}</option>
		{/foreach}
		</select><br /><br />
		
		Hydrogen Sulfide (H<sub>2</sub>S): <br />
		<select name="targetgas" style="width: 100%;">
		{foreach from=$virtualatts.h2s item=i}
		<option>{$i}</option>
		{/foreach}
		</select><br /><br />
		
		Oxygen (O<sub>2</sub>): <br />
		<select name="targetgas" style="width: 100%;">
		{foreach from=$virtualatts.o2 item=i}
		<option>{$i}</option>
		{/foreach}
		</select><br /><br />
		
		Balance: <br />
		<select name="targetgas" style="width: 100%;">
		{foreach from=$virtualatts.bal item=i}
		<option>{$i}</option>
		{/foreach}
		</select><br /><br />
		
		Size: <br />
		<select name="targetgas" style="width: 100%;">
		{foreach from=$virtualatts.size item=i}
		<option>{$i}</option>
		{/foreach}
		</select><br /><br />
		
		</form>
	</div>
</li>
{/if}