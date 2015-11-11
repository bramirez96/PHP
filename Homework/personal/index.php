<?php #index.php //Just some shit (I want whiskey)
//Admins are GOD
//Users, products
//Shopping cart is some products
//An order is a shopping cart + a user
$page_title = "Index";
$content = [];
$content['module1'] = "<p>This is a paragraph.</p>";
$content['module2'] = "<h1>This is a big header</h1>";
$content['module3'] = "<p>Another paragraph</p>";
include("./header.php");
//Put the inside of the #container tag in the following thingy
echo <<<_END
	<div class="grid clearfix">
		<div class="col-1-4">
			{$content['module1']}
		</div>
		<div class="col-1-2">
			{$content['module2']}
		</div>
		<div class="col-1-4">
			{$content['module3']}
		</div>
	</div>
	<div class="grid clearfix">
	
	</div>
_END;
include("./footer.php");
?>