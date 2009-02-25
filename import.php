<?php
	exit;//DO NOT COMMENT THIS LINE UNLESS YOU WANT TO DROP ALL THE PRODUCTS AND RE-IMPORT THEM
	define("DIR_PATH","csv");
	define("VALUE_SEPARATOR", ",");
	
	mysql_connect("localhost",'feedstore','Y8fXh6D2');
	mysql_select_db("feedstore");
	
	$totalProducts = 0;
	$totalCategories = 0;
	$totalProductType =0;
	$totalSuppliers = 0;
	
	function resetDatabase(){
		//$query = mysql_query("delete from cart_manufacturers");
		//$query = mysql_query("delete from cart_categories");
		//$query = mysql_query("delete from cart_categories_description");
		//$query = mysql_query("delete from cart_product_types");
		$query = mysql_query("delete from cart_products");
		$query = mysql_query("delete from cart_products_description");
		$query = mysql_query("delete from cart_products_to_categories");
	}
	
	function getSupplierID($value){
		$query = mysql_query("select manufacturers_id as cnt from cart_manufacturers where manufacturers_name like '$value'");
		$num = mysql_num_rows($query);
		if ($num == 0){
			global $totalSuppliers;
			$totalSuppliers++;
			mysql_query("insert into cart_manufacturers (manufacturers_name) values ('$value')");
			return mysql_insert_id();
		}
		$row = mysql_fetch_object($query);
		return $row->cnt;
	}
	
	function getCategoryID($value){
		$query = mysql_query("select categories_id as cnt from cart_categories_description where categories_name like '$value'");
		$num = mysql_num_rows($query);
		if ($num == 0){
			global $totalCategories;
			$totalCategories++;
			mysql_query("insert into cart_categories values()");
			$lastID = mysql_insert_id();
			mysql_query("insert into cart_categories_description (categories_id,language_id,categories_name) values ('$lastID','1','$value')");
			return $lastID;
		}
		$row = mysql_fetch_object($query);
		return $row->cnt;
	}
	
	function getProductTypeID($value){
		$query = mysql_query("select type_id as cnt from cart_product_types where type_name like '$value'");
		$num = mysql_num_rows($query);
		if ($num == 0){
			global $totalProductType;
			$totalProductType++;
			mysql_query("insert into cart_product_types (type_name) values ('$value')");
			return mysql_insert_id();
		}
		$row = mysql_fetch_object($query);
		return $row->cnt;
	}
	
	function getProduct($supplier, $category, $productType, $value, $weight, $palletCount, $price){
		global $totalProducts;
		$totalProducts++;
		if ($palletCount == 0)
			$palletCount = 20;
		preg_match( "/(\d+(.\d+)?)/", $price, $results);
		if ($results)
			$price = $results[0];
		else
			$price = 0;
		$pos = strpos(strtolower($weight), strtolower("lb"));
		preg_match( "/(\d+(.\d+)?)/", $weight, $results);
		if ($results)
			$weight = $results[0];
		else
			$weight = 0;
		if ($pos)
			$weight = 0.45323 * $weight;
		$weight = round($weight * 100) / 100;
		$weight = (float)$weight;
		$palletCount = (int)$palletCount;
		$price = (float)$price;
		$sql = "insert into cart_products (products_type, manufacturers_id, master_categories_id, products_weight, products_pallet_count, products_price, products_tax_class_id,products_status,products_quantity)
				values($productType,$supplier,$category,$weight,$palletCount,$price,1,1,1)";
		echo "$sql<br>";
		mysql_query($sql);
		$lastID = mysql_insert_id();
		echo "$lastID<br>";
		mysql_query("insert into cart_products_description (products_id,language_id,products_name) values ('$lastID','1','$value')");
		mysql_query("insert into cart_products_to_categories (products_id,categories_id) values ('$lastID','$category')");
		return $lastID;
	}
	
	function processFile($path){
		$content = file_get_contents($path);
		$lines = explode("\n",$content);
		$header = explode(VALUE_SEPARATOR,$lines[0]);
		//for($i = 0; $i < count($header); $i++)
		//	echo $header[$i] . "<br>";
		//echo $content;
		for ($i = 1; $i < count($lines); $i++){
			$oneLine = explode(VALUE_SEPARATOR,addslashes($lines[$i]));
			$supplierID = getSupplierID($oneLine[0]);
			$categoryID = getCategoryID($oneLine[1]);
			$producyTypeID = getProductTypeID($oneLine[2]);
			$producyID = getProduct($supplierID, $categoryID, $producyTypeID, $oneLine[3], $oneLine[4],$oneLine[5],$oneLine[6]);
			/*
			echo "$oneLine[0] ($supplierID)<br>";
			echo "$oneLine[1] ($categoryID)<br>";
			echo "$oneLine[2] ($producyTypeID)<br>";
			echo "$oneLine[3] ($producyID)<br>";
			*/
		}
		echo "<hr>\n\n";
	}
	
	resetDatabase();
	if ($handle = opendir(DIR_PATH)) {
		while (false !== ($file = readdir($handle))) 
			if (is_file(DIR_PATH . "/" . $file))
				processFile(DIR_PATH . "/" . $file);
		closedir($handle);
	}
	echo "totalProducts = $totalProducts <br>totalCategories=$totalCategories<br>totalProductType=$totalProductType<br>totalSuppliers=$totalSuppliers";
	
?>