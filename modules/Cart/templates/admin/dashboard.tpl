{include file="admin/subnav.tpl"}

<h3>Status</h3>
<strong>Categories:</strong> {$categories|@count}<br />
<strong>Products:</strong> {$products}<br />
<strong>Orders:</strong> {$orders|@count}

<h2>Configuration Options</h2>
<ul>
<li><a href="/admin/Cart&section=manufacturers">Suppliers</a></li>
<li><a href="/admin/Cart&amp;section=categories">Categories</a></li>
<li><a href="/admin/Cart&section=product_types">Product Types</a></li>
<li><a href="/admin/Cart&section=tax_classes">Tax Classes</a></li>
<li><a href="/admin/Cart&section=tax_rates">Tax Rates</a></li>
</ul>