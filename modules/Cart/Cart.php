<?php

class Module_Cart extends Module {
	
	/**
	 * Build and return admin interface
	 * 
	 * Any module providing an admin interface is required to have this function, which
	 * returns a string containing the (x)html of it's admin interface.
	 * @return string
	 */
	public function getAdminInterface() {
		switch (@$_REQUEST['section']) {
			case 'attributes':
				$this->addJS('/modules/Cart/js/optionvalueedit.js');
				switch (@$_REQUEST['action']) {
					case 'values':
						$option = new CartProductOption($_REQUEST['id']);
						return json_encode($option->getValues());
						die();
					case 'addedit':
						$option = new CartProductOption(@$_REQUEST['cartproductoption_id']);
						$form = $option->getAddEditForm();
						
						if (isset($_REQUEST['delete_value'])) {
							$v = new CartProductOptionValue(trim($_REQUEST['delete_value'], 'delete_'));
							$v->delete();
							die();
						}
						
						if (isset($_REQUEST['value'])) {
							foreach (@$_REQUEST['value'] as $key => $value) {
								$v = new CartProductOptionValue($key);
								$v->setName($value);
								$v->save();
							}
						}
						if (isset($_REQUEST['newvalue'])) {
							foreach (@$_REQUEST['newvalue'] as $key => $value) {
								$v = new CartProductOptionValue();
								$v->setName($value);
								$v->setLanguage_id(1);
								$v->optionid = $option->getId();
								$v->save();
							}
						}
						
						if (!$form->validate() || !$form->isSubmitted() || (!isset($_REQUEST['cartproductoption_submit']) && !isset($_REQUEST['valuesubmit']))) {
							$this->smarty->assign('form', $form);
							$this->smarty->assign('option', $option);
							if ($option->getId())
								$this->smarty->assign('values', $option->getOptionsValues());
							return $this->smarty->fetch('admin/optionsedit.tpl');
						}
						break;
					case 'delete':
						$option = new CartProductOption(@$_REQUEST['cartproductoption_id']);
						$option->delete();
				}
				$options = CartProductOption::getAllCartProductOptions();
				$this->smarty->assign('options', $options);
				
				return $this->smarty->fetch('admin/options.tpl');
			case 'products':
				require_once('include/CartProduct.php');
				switch (@$_REQUEST['action']) {
					case 'addedit':
						if (isset($_REQUEST['delete_att'])) {
							$a = new CartProductAttribute($_REQUEST['delete_att']);
							$a->delete();
							die();
						}
						if (isset($_REQUEST['delete_altimage'])) {
							$sql = 'delete from cart_products_images where id=' . e($_REQUEST['delete_altimage']);
							Database::singleton()->query($sql);
							die();
						}
						
						$this->addJS('/modules/Cart/js/productedit.js');
						$product = new CartProduct(@$_REQUEST['cartproduct_products_id']);
						$form = $product->getAddEditForm();
						
						if (!isset($_REQUEST['cartproduct_submit'])) {
							return $form->display();
						}
						break;
					case 'delete':
						$product = new CartProduct(@$_REQUEST['cartproduct_products_id']);
						$product->delete();
						break;
					case 'auto':
						$array = CartProduct::toArray($_REQUEST['value']);
						$rs = array_slice($array, 1, count($array), true);
						$str = '<ul>';
						foreach ($rs as $key => $r) {
							$str .= '<li id="' . $key . '">' . $r . '</li>';
						}
						$str .= '</ul>';
						return $str;
				}
				
				require_once 'Pager.php';

				$pagerOptions = array(
				    'mode'     => 'Sliding',
				    'delta'    => 5,
				    'perPage'  => 20,
					'append'   => false,
					'path'	   => '/',
					'fileName' => "Cart&section=products&pageID=%d",
					'totalItems' => CartProduct::getCountCartProducts()
				);
				$pager =& Pager::factory($pagerOptions);
				list($from, $to) = $pager->getOffsetByPageId();
				$items = CartProduct::getAllCartProducts($from, 20);
				$this->smarty->assign('pager_links', $pager->links);
				$this->smarty->assign(
				    'page_numbers', array(
				        'current' => $pager->getCurrentPageID(),
				        'total'   => $pager->numPages()
				    )
				);
				
				$this->smarty->assign('products', $items);
				
				return $this->smarty->fetch('admin/products.tpl');
				break;
			case 'categories':
				require_once('include/CartCategory.php');
				error_reporting(E_ALL);
				switch (@$_REQUEST['action']) {
					case 'addedit':
						$category = new CartCategory(@$_REQUEST['cartcategory_categories_id']);
						$form = $category->getAddEditForm();
						if (!$form->validate() || !$form->isSubmitted() || !isset($_REQUEST['cartcategory_submit'])) {
							return $form->display();
						}
						break;
					case 'delete':
						$category = new CartCategory(@$_REQUEST['cartcategory_categories_id']);
						$category->delete();
						break;
				}
				$this->smarty->assign('categories', CartCategory::getCartCategorys(array('parent_id'=>0)));
				
				return $this->smarty->fetch( 'admin/categories.tpl' );
				break;
			case 'product_types':
				require_once('include/CartProductType.php');
				error_reporting(E_ALL);
				switch (@$_REQUEST['action']) {
					case 'addedit':
						$productType = new CartProductType(@$_REQUEST['cartproducttype_type_id']);
						$form = $productType->getAddEditForm();
						if (!$form->validate() || !$form->isSubmitted() || !isset($_REQUEST['cartproducttype_submit'])) {
							return $form->display();
						}
						break;
					case 'delete':
						$productType = new CartProductType(@$_REQUEST['cartproducttype_type_id']);
						$productType->delete();
						break;
				}
				$this->smarty->assign('productTypes', CartProductType::getAllCartProductTypes());
				
				return $this->smarty->fetch( 'admin/product_types.tpl' );
				break;
			case 'shipping':
				require_once('include/CartShippingRate.php');
				$this->addJS('/modules/Cart/js/cartEvent.js');
				
				switch (@$_REQUEST['action']) {
					case 'addedit':
						$rate = new CartShippingRate(@$_REQUEST['cartshippingrate_id']);
						$form = $rate->getAddEditForm();
						if (!$form->validate() || !isset($_REQUEST['cartshippingrate_submit'])) {
							return $form->display();
						}
						break;
					case 'delete':
						$rate = new CartShippingRate(@$_REQUEST['cartshippingrate_id']);
						$rate->delete();
						break;
				}
				
				$rates = CartShippingRate::getAllCartShippingRates();
				$this->smarty->assign('rates', $rates);
				return $this->smarty->fetch('admin/shippingrates.tpl');
				break;
			case 'tax_classes':
				require_once('include/CartTaxClass.php');
				switch (@$_REQUEST['action']) {
					case 'addedit':
						$class = new CartTaxClass(@$_REQUEST['carttaxclass_tax_class_id']);
						$form = $class->getAddEditForm();
						if (!$form->validate() || !isset($_REQUEST['carttaxclass_submit'])) {
							return $form->display();
						}
						break;
					case 'delete':
						$class = new CartTaxClass(@$_REQUEST['carttaxclass_tax_class_id']);
						$class->delete();
						break;
				}
				
				$classes = CartTaxClass::getAllCartTaxClasses();
				$this->smarty->assign('taxclasses', $classes);
				return $this->smarty->fetch('admin/taxclasses.tpl');
				break;
			case 'tax_rates':
				require_once('include/CartTaxRate.php');
				switch (@$_REQUEST['action']) {
					case 'addedit':
						$rate = new CartTaxRate(@$_REQUEST['carttaxrate_tax_rates_id']);
						$form = $rate->getAddEditForm();
						
						if (!$form->validate() || !isset($_REQUEST['carttaxrate_submit'])) {
							return $form->display();
						}
						break;
					case 'delete':
						$rate = new CartTaxRate(@$_REQUEST['carttaxrate_tax_rates_id']);
						$rate->delete();
						break;
				}
				
				$rates = CartTaxRate::getAllCartTaxRates();
				$this->smarty->assign('taxrates', $rates);
				return $this->smarty->fetch('admin/taxrates.tpl');
				break;
				
			case 'manufacturers':
				require_once('include/CartManufacturer.php');
				switch (@$_REQUEST['action']) {
					case 'addedit':
						$man = new CartManufacturer(@$_REQUEST['cartmanufacturer_manufacturers_id']);
						$form = $man->getAddEditForm();
						
						if (!isset($_REQUEST['cartmanufacturer_submit'])) {
							return $form->display();
						}
						break;
					case 'delete':
						$man = new CartManufacturer(@$_REQUEST['cartmanufacturer_manufacturers_id']);
						$man->delete();
						break;
				}
				
				$manufacturers = CartManufacturer::getAllCartManufacturers();
				$this->smarty->assign('manufacturers', $manufacturers);
				return $this->smarty->fetch('admin/manufacturers.tpl');
				break;
			case 'orders':
				require_once('include/CartOrder.php');
				$this->addCSS('/modules/Cart/css/cart.css');
				$this->addJS('/modules/Cart/js/cart.js');
				switch (@$_REQUEST['action']) {
					case 'addedit':
						$order = new CartOrder(@$_REQUEST['cartorder_orders_id']);
						$form = $order->getAddEditForm();
						
						if (!$form->validate() || !isset($_REQUEST['cartorder_submit'])) {
							return $form->display();
						}
						break;
					case 'delete':
						$order = new CartOrder(@$_REQUEST['cartorder_orders_id']);
						$order->delete();
						break;
					case 'details':
						$order = new CartOrder(@$_REQUEST['cartorder_orders_id']);
					
						$this->smarty->assign('order', $order);
						return $this->smarty->fetch('admin/order_details.tpl');
						break;
				}
				
				$orders = CartOrder::getAllCartOrders();
				$this->smarty->assign('orders', $orders);
				return $this->smarty->fetch('admin/orders.tpl');
				break;
			default:
				require_once('include/CartCategory.php');
				require_once('include/CartProduct.php');
				
				$cats = CartCategory::getCartCategorys();
				$prods = CartProduct::getCountCartProducts();
				
				$this->smarty->assign('categories', $cats);
				$this->smarty->assign('products', $prods);
				
				return $this->smarty->fetch( 'admin/dashboard.tpl' );
				break;		
		}
	}

	public function getUserInterface($params) {
		//$this->setPageTitle('Feed Store');//Foreign Affair
		$this->addCSS('/modules/Cart/css/cart.css');
		$this->addJS('/modules/Cart/js/cart.js');
		
		switch (@$params['action']) {
			case 'add':
				require_once('include/CartBasket.php');
				require_once('include/CartProduct.php');
				$item = new CartBasket();
				
				$product = new CartProduct($params['productId']);
				
				$price = 0;
				if (isset($_REQUEST['att'])) {
					$uniqid = uniqid(rand(), true);
					$item->setProduct($params['productId'] . ':' . $uniqid);
					
					$price = $item->getPrice();

					foreach ($_REQUEST['att'] as $key => $newatt) {
						$attribute = new CartProductAttribute($newatt);
						
						$att = new CartBasketAttribute();
						$att->setProduct($params['productId'] . ':' . $uniqid);
						$att->setOptionsId($attribute->getOptionsId()->getId());
						$att->setValueId($attribute->getValue()->getId());
						
						$att->setValueText($attribute->getOptionsId()->getName() . ': ' . $attribute->getValue()->getName());
						
						$price = $price + $attribute->getValuesPrice();
						
						if (isset($_SESSION['authenticated_user'])) {
							$att->setUser($_SESSION['authenticated_user']->getId());
							$att->save();
						} 
					}
				} else {
					$item->setProduct($params['productId']);
				}
				
				if ($product->getSpecials()) {
					$price += $product->getSpecials()->getNew_products_price();
				} else {
					$price += $product->getPrice();
				}
				
				$item->setPrice($price);
				
				if (isset($params['productQuantity'])) {
					$item->setQuantity($params['productQuantity']);
				} else {
					$item->setQuantity(1);
				}
				
				if (isset($_SESSION['authenticated_user'])) {
					$item->setUser($_SESSION['authenticated_user']->getId());
					$item->save();
				} else {
					$_SESSION['cart_basket'][] = $item;
				}
				break;
			case 'remove':
				$item = @new CartBasket(@$_REQUEST['cartbasket_id']);
				if (is_null($item->delete())) {
					$tmp = array();
					foreach ($_SESSION['cart_basket'] as &$item) {
						if ($item->getProduct()->getId() != $_REQUEST['product_id']) {
							$tmp[] = $item;
						}
					}
					$_SESSION['cart_basket'] = $tmp;
				}
				
				
				break;
		}
		//var_dump($_REQUEST);
		//echo $params['section'];exit;
		switch ($params['section']) {
			case 'search':
				$items = CartProduct::searchProducts(@$_REQUEST["selSupplier"], @$_REQUEST["selCategory"], @$_REQUEST["selProductType"]);
				$this->smarty->assign('products', $items);
				return $this->smarty->fetch('store.tpl');
				break;
			case 'canCheckout':
				/*Check to see if the user is ready to go to Paypal
				 * We should check the following:
				 * - The user is actually logged in
				 * - The price of the order is at least $250
				 * - The shipping address is present
				 * - The billing address is present
				 * - The shipping information is there (Canada Post or FedEx)
				*/
				
				$canCheckout = Module_Cart::canUserCheckout();
				foreach ($canCheckout as $key=>$value){
					$this->smarty->assign($key, $value);
				}
				$_SESSION['cart_checkout']['delivery_direction'] = @$_REQUEST["delivery_direction"];
				return $this->smarty->fetch("canDoCheckOut.tpl");
				break;
			case 'cartdetail':
				if (isset($_REQUEST['ship_type'])) {
					$_SESSION['cart_checkout']['shipping'] = Shipping::factory($_REQUEST['ship_type']);
				}
				
				$this->setUpCartDetail();
				
				return $this->smarty->fetch('cart_detail.tpl');
				break;
			case 'cart':
				if (!isset($_SESSION['authenticated_user'])){//Reset all the shipping variables and addresses
					$_SESSION['cart_checkout']['shipping'] = null;
					$_SESSION['cart_checkout']['address']['billing_address'] = null;
					$_SESSION['cart_checkout']['address']['shipping_address'] = null;
				}
				$this->setUpCartDetail();
				$user = new User();
				$form = $user->getUserAddEditForm('/store/checkout');
				$form->removeElement ( 'section' );
				$form->setConstants( array ( 'account' => 'create' ) );
				$form->addElement( 'hidden', 'account' );
				$this->smarty->assign('user_form', $form);
				$this->smarty->assign('usernameexists', @$_REQUEST["usernameexists"]);
				return $this->smarty->fetch('cart.tpl');
				break;
			case 'buyOrder':
				//DO NOT UNCOMMENT THE FOLLOWING LINE UNLESS YOU WANT TO TEST THE PURCHASE OPERATION
				//The following line buys the products that are in session. In other words, it bypasses Paypal.
				$_SESSION['cart_checkout']['payment']->process();
			case 'deliverydirections':
				$_SESSION['cart_checkout']['delivery_direction'] = @$_REQUEST["delivery_direction"];
				return $_SESSION['cart_checkout']['delivery_direction'];
				break;
			case 'checkout':
				$_SESSION['cart_checkout']['order'] = null;//Make sure to remove the old order (if any) from the session
				$_SESSION['cart_checkout']['orderFailureReason'] = null;//AND delete the previous failure reason
				Module_Cart::initSessionVariables();
				switch (@$_REQUEST['account']) {
					case 'create':
						$user = new User();
						$form = $user->getUserAddEditForm();
						if (@$_REQUEST["user_created"] == 1) {
							$_POST["username"] = $_REQUEST["a_username"]; 
							$_POST["password"] = $_REQUEST["a_password"];
							$_POST["doLogin"] = "Login";
							$auth_container = new CMSAuthContainer();
							$auth = new Auth($auth_container, null, 'authInlineHTML');
							$auth->start();
						}
						if (@$_REQUEST["username_already_exists"]){
							header('Location: /store/cart&usernameexists=1');
							exit;
						}
						$_SESSION['authenticated_user'] = $user;
						break;
				}
				//Only logged in users can view this page
				if (!isset($_SESSION['authenticated_user'])){
					header('Location: /store/cart');
					exit;
				}
				//echo $_SESSION['authenticated_user']->getAddress()->getId() . "))))";exit;
				$_SESSION['cart_checkout']['shipping'] = Shipping::factory('EAndA');//Always set the shipping to EAndA
				//The billing address of the order will be the addres of the user
				$_SESSION['cart_checkout']['address']['billing_address'] = @$_SESSION['authenticated_user']->getAddress();
				$_SESSION['cart_checkout']['address']['shipping_address'] = @$_SESSION['authenticated_user']->getShippingAddress();
				$this->setUpCartDetail();
				
				$this->addJS('/modules/Cart/js/cart.js');
				$shipping = Shipping::getAllShippings();
				
				if (isset($_SESSION['cart_checkout']['payment'])) {
					$this->smarty->assign('payment_types', $_SESSION['cart_checkout']['payment']->getForm(Payment::getForm()));
				} else {
					$this->smarty->assign('payment_types', Payment::getForm());
				}
				
				if (isset($_SESSION['cart_checkout']['shipping'])) {
					$this->smarty->assign('ship_types', $_SESSION['cart_checkout']['shipping']->getForm());
				} else {
					$this->smarty->assign('ship_types', Shipping::getForm());
				}
				
				if (!isset($_SESSION['cart_checkout']['address']['shipping_address'])) {
					$_SESSION['cart_checkout']['address']['shipping_address'] = new Address();
				}
				$this->smarty->assign('ship_address', $_SESSION['cart_checkout']['address']['shipping_address']);
				
				if (!isset($_SESSION['cart_checkout']['address']['billing_address'])) {
					$_SESSION['cart_checkout']['address']['billing_address'] = new Address();
				}
				$this->smarty->assign('bill_address', $_SESSION['cart_checkout']['address']['billing_address']);
				$this->smarty->assign('shipping_types', $shipping);
				$delivery_direction = @$_SESSION['cart_checkout']['delivery_direction'];
				$this->smarty->assign('delivery_direction', $delivery_direction);
				return $this->smarty->fetch('cart_checkout_address.tpl');
				break;
			case 'payment':
				//$this->addJS('/modules/Cart/js/cart.js');
				$payment = $_SESSION['cart_checkout']['payment'];
				$form = $payment->getForm(Payment::getForm());
				
				if ($form->validate() && $form->isSubmitted() && isset($_REQUEST['cart_submit'])) {
					return $payment->complete($this->smarty);
				} else {
					return '<div id="pay_form">' . $form->display() . '</div>';
				}
				
				break;
			case 'payform':
				if (!isset($_REQUEST['pay_type']))
					$_REQUEST['pay_type'] = "Paypal";
				if (isset($_REQUEST['pay_type'])) {
					$_SESSION['cart_checkout']['payment'] = Payment::factory($_REQUEST['pay_type']);
				}
				
				$form = Payment::getForm();
				
				return $_SESSION['cart_checkout']['payment']->getForm($form)->display();
				//return Payment::getForm($form)->display();
				
				break;
			case 'address':
				//No need to set the ID of the address to null.
				//$_SESSION['cart_checkout']['address'][$_REQUEST['adr_type']]->setId(null);
				if (@$_REQUEST["sameAsBilling"]){
					//The user has clicked on the link: "The shipping address is the same as the billing address"
					//Copy the billing address object to the shipping address object
					//Make sure we're not assigning pointers
					$_SESSION['cart_checkout']['address']["shipping_address"]->copy($_SESSION['cart_checkout']['address']["billing_address"]);
				}
				if ($_REQUEST['adr_type'] == "shipping_address"){
					$this->smarty->assign('sameAsBilling', "1");
				}
				$form = $_SESSION['cart_checkout']['address'][$_REQUEST['adr_type']]->getAddEditForm($_REQUEST['adr_type']);
				$form->addElement('submit', 'submit', 'Submit');
				$form->updateAttributes(array('action' => '/store/address'));
				
				$form->setConstants( array ( 'adr_type' => $_REQUEST['adr_type'] ) );
				$form->addElement('hidden', 'adr_type');
				
				if (isset($_REQUEST['submit'])) {
					$this->smarty->assign('address', $_SESSION['cart_checkout']['address'][$_REQUEST['adr_type']]);
					$this->smarty->assign('adr_type', $_REQUEST['adr_type']);
					
					/***************************************
					 * The following lines are important.
					 * Even though the billing address ID is stored in the user's object and there is no need to re-assign it
					 * The old users have that ID set to zero. So, we need to change that to the ID of the billing address
					 */
					if ($_REQUEST['adr_type'] == "billing_address"){
						$_SESSION['authenticated_user']->setAddress($_SESSION['cart_checkout']['address']["billing_address"]);
						$_SESSION['authenticated_user']->save();
					}
					
					if ($_REQUEST['adr_type'] == "shipping_address"){
						$_SESSION['authenticated_user']->setShippingAddress($_SESSION['cart_checkout']['address']["shipping_address"]);
						$_SESSION['authenticated_user']->save();
					}
					
					return $this->smarty->fetch('cart_address_format.tpl');	
				} else {
					return $form->display();
				}
				break; 
			case 'product':
				$this->addJS('/modules/Cart/js/cart.js');
				$this->addCSS('/modules/Cart/css/product.css');
				
				$product = new CartProduct($params['page']);
				/*
				switch (@$_REQUEST['subsection']) {
					case 'accessories':
						$this->smarty->assign('products', $product->getAccessories());
						$this->smarty->assign('section', 'accessories');
						break;
					default:
				}
				*/
				$this->smarty->assign('product', $product);
				return $this->smarty->fetch('cart_product.tpl');
				break;
			case 'productform':
				$product = new CartProduct($params['productId']);
				$form = $product->getAddToCartForm();
				return $form->display();
				break;
			case 'manufacturer':
				$this->addJS('/modules/Cart/js/cart.js');
				$this->smarty->assign('threecol', true);
				//$products = CartManufacturer::getProductsByManufacturer($params['page']);
				require_once 'Pager.php';

				$pagerOptions = array(
				    'mode'     => 'Sliding',
				    'delta'    => 3,
				    'perPage'  => 8,
					'append'   => false,
					'path'		=> '/store/manufacturer',
					'fileName'  => $params['page'] . "/%d",
					'totalItems' => CartManufacturer::getCountCartManufacturer($params['page'])
				);
				$pager =& Pager::factory($pagerOptions);
				list($from, $to) = $pager->getOffsetByPageId();
				//$items = CartManufacturer::getCategoriesByManufacturer($params['page']);
				$items = CartManufacturer::getProductsByManufacturer($params['page'], $from, $to);
				
				$this->smarty->assign('pager_links', $pager->links);
				$this->smarty->assign(
				    'page_numbers', array(
				        'current' => $pager->getCurrentPageID(),
				        'total'   => $pager->numPages()
				    )
				);
				
				$this->smarty->assign('products', $items);
				$this->smarty->assign('manufacturer', new CartManufacturer($params['page']));
				
				//$this->smarty->assign('products', $products);
				return $this->smarty->fetch('store.tpl');
				break;
			case 'IPN':
				Module_Cart::initSessionVariables();
				require_once('include/PaypalIPN.php');
				require_once('include/PaypalLog.php');
				
				$pp = new PaypalIPN();
				$process = $pp->checkOrder();//This method returns either true in case the client actually paid for the products they asked for, or false in case the request didn't come from paypal OR the client didn't pay the right amount of money
				if ($process){//Store the order
					$_SESSION['cart_checkout']['payment']->process();
					$this->sendEmail(true);
				}
				else{
					$this->sendEmail(false);
					//Log a false IPN for security purposes
				}
				exit;
				break;
			case 'orderComplete':
				if (@$_SESSION['cart_checkout']['order']->getId()){
					$this->smarty->assign('order', $_SESSION['cart_checkout']['order']);
					$this->smarty->assign('address', $_SESSION['cart_checkout']['address']['shipping_address']);
					$this->smarty->assign('shippingCost', $this->getShipping());
					return $this->smarty->fetch('orderComplete.tpl');
				}
				else{
					$this->smarty->assign('reason', @$_SESSION['cart_checkout']['orderFailureReason']);
					return $this->smarty->fetch('orderNotComplete.tpl');
				}
				break;
			case 'suppliers':
				$items = CartManufacturer::getAllCartManufacturers();
				$this->smarty->assign('suppliers', $items);
				return $this->smarty->fetch('store.tpl');
				break;
			case 'myorders':
				//Only logged in users can view this page
				if (!isset($_SESSION['authenticated_user'])){
					header('Location: /user/');
					exit;
				}
				$this->addCSS('/modules/Cart/css/cart.css');
				$this->addCSS('/css/facebox.css');
				$this->addJS('/modules/Cart/js/cart.js');
				$this->addJS('/js/facebox.js');
				$myOrders = CartOrder::getAllCartOrders($_SESSION['authenticated_user']->getId());
				$this->smarty->assign('orders', $myOrders);
				return $this->smarty->fetch('my_orders.tpl');
				break;
			case 'orderDetails':
				//Only logged in users can view this page
				if (!isset($_SESSION['authenticated_user'])){
					header('Location: /user/');
					exit;
				}
				$order = new CartOrder(@$_REQUEST['cartorder_orders_id']);
				if ($order->getCustomer()->getId() == $_SESSION['authenticated_user']->getId()){
					$this->smarty->assign('order', $order);
					return $this->smarty->fetch('admin/order_details.tpl');
				}
				return "You have to login to see this order";
				break;
			case 'category':
			default:
				$this->addJS('/modules/Cart/js/cart.js');
				$this->smarty->assign('threecol', true);
				if (!isset($params['page'])) {
					$cat_id = 0;
				} else {
					$cat_id = $params['page'];
				}
				$cats = CartCategory::getCartCategorys(array('parent_id' => $cat_id));
				
				
				if (!isset($_REQUEST['subsection'])) {
//					require_once 'Pager.php';
//	
//					$pagerOptions = array(
//					    'mode'     => 'Sliding',
//					    'delta'    => 3,
//					    'perPage'  => 10,
//						'append'   => false,
//						'path'		=> '/store/category/',
//						'fileName'  => $cat_id . "/%d",
//						'totalItems' => CartProduct::getCountCartProductsByCat($cat_id)
//					);
//					$pager =& Pager::factory($pagerOptions);
//					list($from, $to) = $pager->getOffsetByPageId();
					$items = CartProduct::getCategoryProducts($cat_id);
					
//					$this->smarty->assign('pager_links', $pager->links);
//					$this->smarty->assign(
//					    'page_numbers', array(
//					        'current' => $pager->getCurrentPageID(),
//					        'total'   => $pager->numPages()
//					    )
//					);
				} else {
					if ($_REQUEST['subsection'] == 'manufacturer') {
						$items = CartProduct::getCategoryProducts($cat_id);
						$arr = array();
						foreach ($items as $item) {
							if ($item->getManufacturer()->getId() == $_REQUEST['subpage']) {
								$arr[] = $item;
							}
						}
						$items = $arr;
					}
					$this->smarty->assign('manufacturer', new CartManufacturer($_REQUEST['subpage']));
				}
				
				$arr = array();
					
				//foreach ($items as $itm) {
				//	if (count($itm->getAccessoryOf()) == 0) {
				//		$arr[] = $itm;
				//	}
				//}
				//$items = $arr;
				
				$this->smarty->assign('products', $items);
				
				// stuff
				//$products = CartProduct::getCategoryProducts($cat_id);
				
				$this->smarty->assign('categories', $cats);
				$this->smarty->assign('cur_cat', new CartCategory($cat_id));
				//$this->smarty->assign('products', $products);
				return $this->smarty->fetch('store.tpl');
		}
	}
	
	private function round($x) {
		$x = (double) $x;
		return sprintf("%01.2f", round($x, 2));
	}

	private function getCartItems() {
		if (isset($_SESSION['authenticated_user'])) {
			$cartitems = CartBasket::getUserCartBaskets($_SESSION['authenticated_user']->getId());
		} else {
			$cartitems = CartBasket::getUserCartBaskets();
		}
		if (!$cartitems)
			$cartitems = array();
		return $cartitems;
	}
	
	public function getSubtotal() {
		$total = 0.00;
		foreach ($this->getCartItems() as $item) {
			$total += $item->getPrice() * $item->getQuantity();
		}
		return $this->round($total);
	}

	public function getTax() {
		/*
		 * Changed by Anas on Thursday, the 13th of Nov
		 * The tax should be calculated individually
		 * Which means that the tax is equal to:
		 * ceil(t1)/100 + ceil(t2)/100 + ceil(t3)/100 ...
		 * Where t1 is the tax percentage for product 1, etc
		 * Calculating tax must happen this way instead of:
		 * ceil(t1 + t2 + t3) / 100
		 * because that's how Paypal calculates it
		 */
		$tax = 0.00;
		$taxAddress = @$_SESSION['cart_checkout']['address']['shipping_address'];
		foreach ($this->getCartItems() as $item) {
			$taxClass = $item->getProduct()->getTaxClass();
			$taxRate = CartTaxRate::getTaxRate($taxClass, $taxAddress);
			$rate = $taxRate->getRate();
			$tmpTax = $rate * ($item->getPrice() * $item->getQuantity());
			$tmpTax = ceil($tmpTax);
			$tmpTax = $tmpTax / 100;
			$tax += $tmpTax;
		}
		return $this->round($tax);		
	}
	
	public function getShipping() {
		$shipping = @$_SESSION['cart_checkout']['shipping'];
		if ($shipping)  return $this->round ($shipping->getCost());
		else return 0;
	}
	
	public function getTotal() {
		return $this->round($this->getSubtotal() + $this->getTax() + $this->getShipping());
	}
	
	private function setUpCartDetail() {
		$shipping = @$_SESSION['cart_checkout']['shipping'];
		$cartitems = $this->getCartItems();
		$this->smarty->assign('shipping', $shipping);
		$this->smarty->assign('cart', $cartitems);
	}
	

	
	private function setUpCartDetail1() {
		if (isset($_SESSION['authenticated_user'])) {
			$cartitems = CartBasket::getUserCartBaskets($_SESSION['authenticated_user']->getId());
		} else {
			$cartitems = CartBasket::getUserCartBaskets();
		}
		
		if (isset ($_SESSION['cart_checkout']['address']['shipping_address'])) {
			$tax = 0.00;
			$totalAmount = 0.00;
			foreach ($cartitems as $item) {
				$rate = CartTaxRate::getTaxRate($item->getProduct()->getTaxClass(), $_SESSION['cart_checkout']['address']['shipping_address'])->getRate();
				$tax += ($rate / 100) * ($item->getPrice() * $item->getQuantity());
				$totalAmount += $item->getPrice() * $item->getQuantity();
			}
			$totalAmount += $tax;
			$this->smarty->assign('tax', $tax);
		}
		$shipping = @$_SESSION['cart_checkout']['shipping'];

		if ($shipping){
			$totalAmount += $shipping->getCost();
		}
		
		$this->smarty->assign('shipping', $shipping);
		$this->smarty->assign('cart', $cartitems);
		//$this->smarty->assign('totalAmount', $totalAmount);
		
	}
	
	public static function canUserCheckout(){
		$canCheckout = array();
		if (isset($_SESSION['authenticated_user']) && $_SESSION['authenticated_user']->getId()) {
			$cartitems = CartBasket::getUserCartBaskets($_SESSION['authenticated_user']->getId());
		} else {
			$canCheckout['userNotLoggedIn'] = 1;
			$cartitems = CartBasket::getUserCartBaskets();
		}
		
		$minimumPayment = SiteConfig::get("Cart::minimumPayment");
		$totalAmount = 0.00;
		foreach ($cartitems as $item) {
			$totalAmount += $item->getPrice() * $item->getQuantity();
		}
		if ($totalAmount < $minimumPayment){
			$canCheckout['paymentLessThanMinimum'] = 1;
			$canCheckout['minimumPayment'] = $minimumPayment;
		}
		
		if (!isset ($_SESSION['cart_checkout']['address']['shipping_address']) ||
			!@$_SESSION['cart_checkout']['address']['shipping_address']->getCity() ||
			!@$_SESSION['cart_checkout']['address']['shipping_address']->getState() ||
			!@$_SESSION['cart_checkout']['address']['shipping_address']->getCountry()
		){
			$canCheckout['shippingAddressNotPresent'] = 1;
		}
		
		if (!isset ($_SESSION['cart_checkout']['address']['billing_address']) ||
			!@$_SESSION['cart_checkout']['address']['billing_address']->getCity() ||
			!@$_SESSION['cart_checkout']['address']['billing_address']->getState() ||
			!@$_SESSION['cart_checkout']['address']['billing_address']->getCountry()
		){	
			$canCheckout['billingAddressNotPresent'] = 1;
		}

		return $canCheckout;
	}
	
	public function getCatsPath() {
		switch (@$_REQUEST['section']) {
			case 'category':
				$cat = new CartCategory($_REQUEST['page']);
				break;
			case 'product':
				$p = new CartProduct($_REQUEST['page']);
				$cat = $p->getCategory();
				
				$array = array('conc' => array(), 'co' => array(), 'h2s' => array(), 'o2' => array(), 'bal' => array(), 'size' => array());
				
				if ($p->getVirtual() == '1') {
					foreach ($p->getAttributes() as $atts) {
						foreach ($atts as $option) {
							$vals = ($option->getValue()->getSplitName());
							
							if (!in_array($vals[0], $array['conc'])) {
								$array['conc'][] = $vals[0];
							}
							if (!in_array($vals[1], $array['conc'])) {
								$array['conc'][] = $vals[1];
							}
							if (!in_array($vals[2], $array['conc'])) {
								$array['conc'][] = $vals[2];
							}
							
							if (!in_array($vals[3], $array['co'])) {
								$array['co'][] = $vals[3];
							}
							
							if (!in_array($vals[4], $array['h2s'])) {
								$array['h2s'][] = $vals[4];
							}
							
							if (!in_array($vals[5], $array['o2'])) {
								$array['o2'][] = $vals[5];
							}
							
							if (!in_array($vals[6], $array['bal'])) {
								$array['bal'][] = $vals[6];
							}
							
							if (!in_array($vals[8], $array['size'])) {
								$array['size'][] = $vals[8];
							}
						}
					}
				}
				
				$this->smarty->assign('virtualatts', $array);
				
				$this->smarty->assign('product', $p);
				break;
			default:
				$cat = new CartCategory(0);
				$cat->setName('Categories');
				break;
		}
		$cur = clone $cat;
				
		$cats = array();
		while ($cat->getParent_id() != 0) {
			$cat = new CartCategory($cat->getParent_id());
			//$cats[] = $cat;
			array_unshift($cats, $cat);
		}
		$cats[] = $cur;
				
		return $cats;
	}
	
	public static function linkHandler($value) {
		if ($value == 0) {
			return '/store/';
		}
		
		@list($id, $type) = @split(':', $value);
		
		switch ($type) {
			case 'product':
				return '/store/product/' . $id;
			case 'catvend':
				list($cat, $man) = split('/',$id);
				return '/store/category/' . $cat . '/manufacturer/' . $man;
			case 'category':
				return '/store/category/' . $id;
			case 'vendor':
			default:
				return '/store/manufacturer/' . $id;
		}
	}

	public static function linkType() {
		return 'Cart';
	}

	public static function getValidLinks() {
		$sql = 'select CONCAT(`manufacturers_id`, ":vendor") as `key`, CONCAT("Vendor: ", `manufacturers_name`) as value from cart_manufacturers order by `manufacturers_name` asc';
		$mans = Database::singleton ()->query_fetch_all ( $sql );
		
		$sql = 'select CONCAT( `categories_id`, ":category") as `key`, CONCAT("Category: ", `categories_name`) as value from cart_categories_description order by `categories_name` asc';
		$cats = Database::singleton ()->query_fetch_all ( $sql );
		
		
		$sql = 'select CONCAT( `products_id`, ":product") as `key`, CONCAT("Product: ", `products_name`) as value from cart_products_description order by `products_name` asc';
		$prods = Database::singleton ()->query_fetch_all ( $sql );
		
		$pages = $cats;
		foreach ($mans as $man) {
			array_push($pages, $man);
		}
		
		include ('include/CartCategory.php');
		include ('include/CartManufacturer.php');
		include_once ('include/CartProduct.php');
		include_once ('include/CartProductType.php');
		include_once ('include/CartTaxClass.php');
		foreach ($cats as $cat) {
			$curcat = new CartCategory(rtrim($cat['key'], ':category'));
			foreach ($curcat->getCatManufacturers() as $man) {
				array_push($pages, array('key'=>$curcat->getId() . '/' . $man->getId()  . ':catvend', 'value'=> 'Category & Vendor: ' . $curcat->getName() . ' / ' . $man->getName()));
			}
		}
		foreach ($prods as $prod) {
			$curprod = new CartProduct(rtrim($prod['key'], ':product'));
			array_push($pages, array('key'=>$curprod->getId()  . ':product', 'value'=> 'Product: ' . $curprod->getName()));
		}
		
		array_unshift($pages, array('key'=>0, 'value'=>'Store (Top Level)'));
		
	
		return $pages;
	}

	public function getSuppliers(){ 	
		//Display the suppliers
		require_once('include/CartManufacturer.php');
		return CartManufacturer::getAllCartManufacturers();
	}

	public function getSearchMenu($param){
		//displaySearchForm means to display the search form at the right side of the website.
		switch ($param){
			case 'Suppliers':
				require_once('include/CartManufacturer.php');
				$this->smarty->assign('selSupplier', @$_REQUEST["selSupplier"]);
				return CartManufacturer::getAllCartManufacturers();
				break;
			case 'Categories':
				//Display the categories
				require_once('include/CartCategory.php');
				$this->smarty->assign('selCategory', @$_REQUEST["selCategory"]);
				return CartCategory::getCartCategorys();
				break;
			case 'ProductTypes':
				require_once('include/CartProductType.php');
				$this->smarty->assign('selProductType', @$_REQUEST["selProductType"]);
				return CartProductType::getAllCartProductTypes();
				break;
		}
	}
	
	public function sendEmail($result){
		$recipients = SiteConfig::get("Cart::AdminEmail"); 
		$headers = "From: $recipients";
		$smartyVar = new Smarty();
		$prefix = $_SERVER["DOCUMENT_ROOT"] . "/modules/Cart/templates/";
		if ($result == true){//The transaction is complete
			$subject = "A New Order #" . $_SESSION['cart_checkout']['order']->getId();
			$smartyVar->assign('order', $_SESSION['cart_checkout']['order']);
			$smartyVar->assign('address', $_SESSION['cart_checkout']['address']['shipping_address']);
			$body = $smartyVar->fetch($prefix . "order_success.tpl");
		}
		else{//Something went wrong with the payment
			$subject = "An Order Failed";
			$smartyVar->assign('reason', $_SESSION['cart_checkout']['orderFailureReason']);
			$body = $smartyVar->fetch($prefix . "order_failed.tpl");
		}
		$mailResult = mail($recipients, $subject, $body, $headers);
	}

	public static function initSessionVariables(){
		//This function initializes the values stored in the session IF THEY DON'T ALREADY EXIST
		//For example, the shipping object, payment, etc
		if (!isset($_SESSION['authenticated_user'])){
			$_SESSION['authenticated_user'] = new User();
		}
		
		if (!isset($_SESSION['cart_basket'])){
			$_SESSION['cart_basket'] = array();
		}

		if (!isset($_SESSION['cart_checkout']['shipping'])){
			$_SESSION['cart_checkout']['shipping'] = Shipping::factory('EAndA');//Always set the shipping to EAndA
		}
		
		if (!isset($_SESSION['cart_checkout']['payment'])){
			$_SESSION['cart_checkout']['payment'] = Payment::factory('Paypal');
		}
			
		if (!isset($_SESSION['cart_checkout']['address']['shipping_address'])){
			$_SESSION['cart_checkout']['address']['shipping_address'] = new Address();
		}
			
		if (!isset($_SESSION['cart_checkout']['address']['billing_address'])){
			$_SESSION['cart_checkout']['address']['billing_address'] = new Address();
		}
			
		if (!isset($_SESSION['cart_checkout']['order'])){
			$_SESSION['cart_checkout']['order'] = new CartOrder();
		}
		
		if (!isset($_SESSION['cart_checkout']['orderFailureReason'])){
			$_SESSION['cart_checkout']['orderFailureReason'] = "";
		}
	}
}
?>