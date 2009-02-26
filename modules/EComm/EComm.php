<?php

/**
 * EComm Module
 * This module must work with DBRow version: xx. where there is a hook before save
 * @author Anas Trabulsi <anas@norex.ca>
 * @package Modules
 * @version 1.0
 */

/**
 * E-Commerce module for the CMS. 
 * 
 * @package Modules
 * @subpackage Content
 */
class Module_EComm extends Module {
	
	/**
	 * Return a string containing the admin interface for the EComm Module
	 *
	 * @return string
	 */
	public function getAdminInterface() {
		$this->smarty->assign('CurrencySign', SiteConfig::get("EComm::CurrencySign"));
		$section = @$_REQUEST['section'];
		switch ($section) {
			case 'ProductType':
			case 'Supplier':
			case 'Category':
			case 'TaxClass':
			case 'TaxRate':
				//$section will be the name of the class, the name of the PHP file, and the name of the .tpl file as well
				require_once "include/$section.php";
				$obj = new $section(@$_REQUEST[call_user_func(array($section, 'getQuickFormPrefix')) . 'id']);
				switch (@$_REQUEST['action']) {
					case 'addedit':
						$form = $obj->getAddEditForm("/admin/EComm");
						if (!$form->isProcessed()){
							return $form->display();
						}
						break;
					case 'delete':
						$obj->delete();
						return 1;
						break;
				}
				$results = call_user_func(array($section, 'getAll'),false);//Get all the records
				$this->smarty->assign('results', $results);
				return $this->smarty->fetch("admin/$section.tpl");
				break;
			case 'Plugins':
				require_once 'plugins/products/ECommProduct.php';
				$ECommPlugins = new ECommProduct();
				$page = @$_REQUEST["page"];
				if ($page && $ECommPlugins->getPlugin($page) && $ECommPlugins->getPlugin($page)->hasAdminInterface()){
					$this->smarty->assign('ECommPlugins', $ECommPlugins);
					$this->smarty->assign('plugin', $_REQUEST["page"]);
					return $this->smarty->fetch("admin/ProductPluginAdminArea.tpl");
				}
				else{
					$this->smarty->assign('ECommPlugins', $ECommPlugins);
					$this->smarty->assign('plugins', $ECommPlugins->getActivePluginIDs());
					return $this->smarty->fetch("admin/ProductPlugin.tpl");
				}
				break;
			case 'Product':
				require_once "include/Product.php";
				require_once 'plugins/products/ECommProduct.php';
				$this->addJS("/modules/EComm/js/ecomm.js");
				$this->addCSS("/modules/EComm/css/ecomm.css");
				$obj = new Product(@$_REQUEST['product_id']);
				switch (@$_REQUEST['action']) {
					case 'addedit':
						$form = $obj->getAddEditForm("/admin/EComm");
						if (!$form->isProcessed()){
							return $form->display();
						}
						$hookResults = ECommProduct::adminPluginHooks("AfterSave", $obj, $form);
						break;
					case 'delete':
						$hookResults = ECommProduct::adminPluginHooks("BeforeDelete", $obj);
						$obj->delete();
						$hookResults = ECommProduct::adminPluginHooks("AfterDelete", $obj);
						break;
					case 'autoComplete':
						$array = Product::searchProducts(array('Name'=> @$_REQUEST['productName']), false);
						$str = '<ul>';
						foreach ($array as $key => $product) {
							$str .= '<li id="' . $product->getId() . '">' . $product->getName() . '</li>';
						}
						$str .= '</ul>';
						return $str;
				}
				require_once 'Pager.php';
				
				$productsPerPage = 10;
				$ecommStatus = $this->getECommStatus();
				$pagerOptions = array(
					'mode'		=> 'Sliding',
					'delta'		=> 1,
					'perPage'	=> $productsPerPage,
					'append'	=> false,
					'path'	   => '/',
					'fileName'	=> "EComm&section=Product&pageID=%d",
					'totalItems'=> $ecommStatus['products']
				);
				$pager = &Pager::factory($pagerOptions);
				list($from, $to) = $pager->getOffsetByPageId();
				$this->smarty->assign('pager_links', $pager->links);
				$this->smarty->assign(
					'page_numbers', array(
					'current'	=> $pager->getCurrentPageID(),
					'total'		=> $pager->numPages()
					)
				);
				
				$results = Product::getAll(false, $from, $productsPerPage);
				$this->smarty->assign('msg', @$_REQUEST["msg"]);
				$this->smarty->assign('results', $results);
				return $this->smarty->fetch("admin/Product.tpl");
				break;
			case 'Shipping':
				require_once 'plugins/shipping/ECommShipping.php';
				$ECommShipping = new ECommShipping();
				if (@$_REQUEST["plugin"]){
					$plugin = $ECommShipping->getPlugin($_REQUEST["plugin"]);
					if (!$plugin)
						return "Plugin not found";
					return $this->smarty->fetch('admin/subnavi.tpl') . $plugin->getAdminInterface($this);
				}
				else{
					$this->smarty->assign('ECommShipping', $ECommShipping);
					$this->smarty->assign('plugins', $ECommShipping->getActivePluginIDs());
					return $this->smarty->fetch("admin/ShippingNavi.tpl");
				}
				break; 
			case 'Order':
				require_once "include/Order.php";
				$obj = new Order(@$_REQUEST['order_id']);
				switch (@$_REQUEST['action']){
					case 'View':
						$orderItems = OrderDetail::getAll($obj->getId());
						$orderComments = OrderComment::getAll($obj->getId());
						$this->smarty->assign('order', $obj);
						$this->smarty->assign('orderItems', $orderItems);
						$this->smarty->assign('orderComments', $orderComments);
						return $this->smarty->fetch("admin/OrderDetail.tpl");
						break;
					case 'Comment':
						$orderComment = new OrderComment();
						$orderComment->setStatus($obj->getStatus());
						$orderComment->setOrderNb($obj->getId());
						$form = $orderComment->getAddEditForm("/admin/EComm");
						if (!$form->isProcessed()){
							return $form->display();
						}
						$obj->setStatus(@$_REQUEST["ordercomment_status"]);
						$obj->save();
						break;
				}
				$results = Order::getAll(@$_REQUEST["allOrders"]);
				$this->smarty->assign('results', $results);
				return $this->smarty->fetch("admin/Order.tpl");
			case 'Transaction':
				require_once "include/Transaction.php";
				$results = Transaction::getAll();
				$this->smarty->assign('results', $results);
				return $this->smarty->fetch("admin/Transaction.tpl");
				break; 
			default:
				$this->smarty->assign('status', $this->getECommStatus());
				return $this->smarty->fetch('admin/dashBoard.tpl');
		}
	}
	
	//This function returns the status of the ecomm module. It returns the number of categories, products and orders in the database
	public function getECommStatus(){
		$sql = "(select 'categories' as status_key, count(*) as status_val from ecomm_category) union
				(select 'products' as status_key, count(*) as status_val from ecomm_product) union
				(select 'orders' as status_key, count(*) as status_val from ecomm_order)";
		$records = Database::singleton()->query_fetch_all($sql);
		$status = array();
		foreach ($records as $record) {
			$status[$record['status_key']] = $record['status_val'];
		}
		return $status;
	}
		
	public static function getIndexes($tableName, $idField, $indexField, $status = 1){
		$sql = "select `$idField`, `$indexField` from $tableName";
		if ($status)
			$sql .= " where status = 1";
		$records = Database::singleton()->query_fetch_all($sql);
		$results = array();
		foreach ($records as $record) {
			$results[$record[$idField]] = $record[$indexField];
		}
		return $results;
	}
	
	public function getUserInterface($params = null) {
		$this->smarty->assign('CurrencySign', SiteConfig::get("EComm::CurrencySign"));
		$this->addCSS('/modules/EComm/css/ecomm.css');
		$this->addJS('/modules/EComm/js/ecomm.js');
		$section = e(@$params['section']);
		$action = e(@$params['action']);
		$page = (int)@$params['page'];//Keep the (int) for SQL injection threats
		$this->smarty->assign('section', $section);
		if (@$_REQUEST["msg"])
			$this->smarty->assign('msg', $_REQUEST["msg"]);
		
		switch ($section) {
			case 'IPN':
				return $this->handleIPN($action);
			case 'Cart':
				return $this->handleCart($action);
			case 'Search':
				return $this->handleSearch($action);
			case 'Tree':
				return $this->handleTree($action, $page);
			case 'Product'://Display a product from the DB
				return $this->handleProduct($action, $page);
			case 'Category':
			case 'Supplier':
			case 'ProductType':
				return $this->handleGroup($section, $action, $page);
			case 'MyAccount':
				return $this->handleMyAccount($action);
		}
		return $this->smarty->fetch("Error.tpl");
	}
	
	/**
	 * Handle Paypal IPN
	 * 
	 * It verifies that the IPN actually came from Paypal, makes sure that the user has paid for what they purchase, and completes the order
	 */
	public function handleIPN($action){
		if ($action == 'OrderComplete'){//When Paypal redirects the user back to the site after the payment is processed
			$tid = @$_REQUEST["tid"];
			$this->smarty->assign('tid', $tid);
			return $this->smarty->fetch("CompleteOrder.tpl");
		}
		require_once 'plugins/payment/ECommPayment.php';
		if (ECommPayment::getPlugin('Paypal')->doPayment()){
			$tid = @$_REQUEST["custom"];
			$this->completeOrder($tid);
		}
		exit;
	}
	
	/**
	 * All the cart functionalities are handled here
	 * 
	 * Add a product to the cart, remove a product from the cart, checkout, etc
	 * @return string
	 */
	public function handleCart($action){
		switch ($action){
			case 'Add'://Add a new product to the cart
				$productId = e(@$_REQUEST["productId"]);
				$product = new Product($productId);
				if (!$product->getId()){
					return $this->smarty->fetch("Error.tpl");
				}
				require_once 'plugins/products/ECommProduct.php';
				$hookResults = ECommProduct::clientPluginHooks("BeforeAddToCart", $product, $this);
				
				//Add the product to cart
				$session = Session::getActiveSession();
				$cartItem = new CartItem();
				$cartItem->setSession($session->getId());
				$cartItem->setProduct($productId);
				$cartItem->setQuantity(@$_REQUEST["quantity"]);
				$cartItem->setTransaction(0);
				$cartItem->save();
				
				$hookResults = ECommProduct::clientPluginHooks("AfterAddToCart", $cartItem, $this);
				
				$returnURL = @$_REQUEST["returnURL"];
				if (!$returnURL)
					$returnURL = "/Store/";
				$this->smarty->assign('returnURL', $returnURL);
				return $this->smarty->fetch("ProductAddedToCart.tpl");
			case 'Details'://Get the details of the cart for an ajax call, it will have the format: "subTotal tax shipping total"
				$cartDetails = Module_EComm::getCartDetails();
				return $cartDetails["subTotal"] . " " . $cartDetails["tax"] . " " . 
						$cartDetails["shipping"] . " " . $cartDetails["total"];
				break;
			case 'Delete'://Delete an item from the cart
				$cartItem = new CartItem(@$_REQUEST["id"]);
				if ($cartItem->getId())
					if ($cartItem->getSession() == @$_SESSION["ECommSessionId"]){
						$cartItem->delete();
						return "True";
					}
				return "Could not be deleted";
				break;
			case 'Display'://Display the cart (before the checkout page)
				$session = Session::getActiveSession();
				$sessionId = $session->getId();
				$cartProducts = CartItem::getAll($sessionId);
				$cartDetails = Module_EComm::getCartDetails($sessionId, $cartProducts);
				$this->smarty->assign('cartProducts', $cartProducts);
				$this->smarty->assign('cartDetails', $cartDetails);
				
				$auth_container = new User();
				$auth = new Auth($auth_container, null, 'authInlineHTML');
				$auth->start();
				if ($auth->checkAuth())
					$this->smarty->assign('loggedIn', 1);
				$user = Module::factory("User");
				$form = $user->getUserAddEditForm('/Store/Cart/&action=Checkout&createAccount=1');
				$form->removeElement('a_group');//In case the administrator is logged in, remove this element because it is not needed
				$form->removeElement('a_status');//In case the administrator is logged in, remove this element because it is not needed
				$form->removeElement('section');//Remove the section hidden variable from here
				$form->removeElement('action');//Remove the action hidden variable from here
				$this->smarty->assign('user_form', $form);
				$this->smarty->assign('userExist', @$_REQUEST["userExist"]);
				$this->smarty->assign('loginFail', @$_REQUEST["loginFail"]);
				return $this->smarty->fetch("DisplayCart.tpl");
				break;
			case 'displayCartProduct'://Display a product in a cart (similar to display a product from the database but without the option of adding to cart and with some other differences)
				$cartItem = new CartItem(@$_REQUEST["cartItemId"]);
				if ($cartItem->getId())
					if ($cartItem->getSession() == @$_SESSION["ECommSessionId"]){//Make sure the owner of this item is viewing it
						$product = $cartItem->getCartItemProduct();
						$this->smarty->assign('cartItem', $cartItem);
						require_once 'plugins/products/ECommProduct.php';
						$hookResults = ECommProduct::clientPluginHooks("BeforeDisplayCartItem", $cartItem, $this);
						$html = "";
						foreach ($hookResults as $key => $val){
							$html .= @$val['HTML'];
						}
						$this->smarty->assign('html', $html);
						$this->smarty->assign('returnURL', '/Store/Cart/&action=' . @$_REQUEST["returnURL"]);
						return $this->smarty->fetch("DisplayCartItem.tpl");
					}
				return "Item could not be displayed";
				break;
			case 'Checkout'://Display the checkout page
				if (@$_REQUEST["createAccount"] == 1) {
					//Create a new user
					$user = Module::factory("User");
					$form = $user->getUserAddEditForm();
					//Then try to log the user in using their username and password
					$auth_container = new CMSAuthContainer();
					$auth = new Auth($auth_container, null, 'authInlineHTML');
					//First, log the current user out (if exists)
					unset($_SESSION['authenticated_user']);
					$auth->logout();
					//And then, log the new user in using the new username and password
					$_POST["username"] = @$_REQUEST["a_username"]; 
					$_POST["password"] = @$_REQUEST["a_password"];
					$_POST["doLogin"] = "Login";
					$auth->start();
					if (!$auth->checkAuth()){//The login did not happen successfully, which means creating a new user was not successful
						header('Location: /Store/Cart/&action=Display&userExist=1');
						exit;
					}
					$this->sendEmailAccountCreated();
				}
				$auth_container = new User();
				$auth = new Auth($auth_container, null, 'authInlineHTML');
				$auth->start();
				if (!$auth->checkAuth()){//You need to login to access this page
					header( 'Location: /Store/Cart/&action=Display&loginFail=1' );//Invalid username or password
					exit;
				}
				//From this point on, the user is actually logged in
				$userId = $_SESSION['authenticated_user']->getId();
				
				require_once 'plugins/shipping/ECommShipping.php';
				require_once 'plugins/payment/ECommPayment.php';
				
				$this->smarty->assign('username', $_SESSION['authenticated_user']->getUsername());
				$session = Session::getActiveSession();
				$session->setUser($userId);
				
				//Set the default shipping class and payment option, if empty
				if (!$session->getShippingClass())
					$session->setShippingClass(ECommShipping::getDefaultPlugIn());
				if (!$session->getPaymentClass())
					$session->setPaymentClass(ECommPayment::getDefaultPlugIn());
				
				$session->save();
				
				$sessionId = $session->getId();
				$cartProducts = CartItem::getAll($sessionId);
				$cartDetails = Module_EComm::getCartDetails($sessionId, $cartProducts);
				$this->smarty->assign('cartProducts', $cartProducts);
				$this->smarty->assign('cartDetails', $cartDetails);
				
				$userDetails = UserDetails::getUserDetailsBasedOnUserId($userId);
				$this->smarty->assign('userDetails', $userDetails);
				
				$ECommShipping = new ECommShipping();
				$this->smarty->assign('shippingClass', $ECommShipping);
				$this->smarty->assign('selectedShipping', $session->getShippingClass());
				$this->smarty->assign('shippingClassDetails', $ECommShipping->getPlugin($session->getShippingClass())->getShippingDetails());
				
				$ECommPayment = new ECommPayment();
				$this->smarty->assign('paymentClass', $ECommPayment);
				$this->smarty->assign('selectedPayment', $session->getPaymentClass());
				$this->smarty->assign('paymentClassDetails', $ECommPayment->getPlugin($session->getPaymentClass())->getPaymentDetails());
				$this->smarty->assign('paymentForm', $ECommPayment->getPlugin($session->getPaymentClass())->getPaymentForm());
				
				return $this->smarty->fetch("Checkout.tpl");
				break;
			case 'ShippingChange'://Change the shipping class through an ajax call. It returns the details of the new shipping class so it is displayed for the end user
				if (@$_REQUEST["shippingClass"]){
					$session = Session::getActiveSession();
					$session->setShippingClass($_REQUEST["shippingClass"]);
					$session->save();
				}
				require_once 'plugins/shipping/ECommShipping.php';
				$ECommShipping = new ECommShipping();
				return $ECommShipping->getPlugin(@$_REQUEST["shippingClass"])->getShippingDetails();
				break;
			case 'PaymentChange'://Change the payment class as an ajax call. Returns the details of the new payment method to be displayed to the end user
				if (@$_REQUEST["paymentClass"]){
					$session = Session::getActiveSession();
					$session->setPaymentClass($_REQUEST["paymentClass"]);
					$session->save();
				}
				require_once 'plugins/payment/ECommPayment.php';
				$ECommPayment = new ECommPayment();
				$details = $ECommPayment->getPlugin(@$_REQUEST["paymentClass"])->getPaymentDetails();
				$form = $ECommPayment->getPlugin(@$_REQUEST["paymentClass"])->getPaymentForm();
				//This will return the details and the form separated by a new line.
				//The details must not contain any new line and neither must the form
				//The ajax call will split the result by \n. The first will will be the details and the second line will be the form
				return str_replace("\n"," ",$details) . "\n" . str_replace("\n"," ",$form);
				break;
			case 'Address'://Change the address or the phone number of the end user in an ajax call
				$userId = $_SESSION['authenticated_user']->getId();
				if (!$userId)//If the user is not logged in, don't do anything
					return "";
				$userDetails = UserDetails::getUserDetailsBasedOnUserId($userId);
				$adr_type = @$_REQUEST['adr_type'];
				if ($adr_type == "phone_number"){//Change the phone number
					$form = new Form('phone_addedit', 'post', '/Store/Cart/&action=Address');
					$form->addElement('text', 'number', 'Phone Number', array('value' => $userDetails->getPhoneNumber()));
					$form->setConstants( array ( 'adr_type' => $adr_type ) );
					$form->addElement('hidden', 'adr_type');
					$form->addElement('submit', 'submit', 'Submit');
					if (isset($_REQUEST['submit'])) {
						$userDetails->setPhoneNumber(trim($_REQUEST['number']));
						$userDetails->save();
						$this->smarty->assign('phoneNumber', $userDetails->getPhoneNumber());
						return $this->smarty->fetch('PhoneNumber.tpl');	
					}
					else{
						return $form->display();
					}
				}
				else{//Change the shipping address or billing address
					$address = $userDetails->getAddress($adr_type);
					$form = $address->getAddEditForm();
					$form->addElement('submit', 'submit', 'Submit');
					$form->updateAttributes(array('action' => '/Store/Cart/&action=Address'));
					
					$form->setConstants( array ( 'adr_type' => $adr_type ) );
					$form->addElement('hidden', 'adr_type');
					
					if (isset($_REQUEST['submit'])) {
						$userDetails->setAddress($adr_type, $address);
						$userDetails->save();
						$this->smarty->assign('address', $address);
						$this->smarty->assign('adr_type', $adr_type);
						return $this->smarty->fetch('Address.tpl');	
					}
					else{
						return $form->display();
					}
				}
				break;
			case 'CheckBeforePayment':
				//This action is called when the user clicks on the "Buy now" button
				//Mmake sure that they can checkout in an ajax call before redirecting the user to the payment
				//For example, the shipping address must be present, the billing address, etc
				//If the user can checkout, return "0" to the ajax call. Right after doing that, there will be another ajax call to refresh the payment form and then submitting the form
				$session = Session::getActiveSession();
				$cartDetails = Module_EComm::getCartDetails();
				$canPurchase = Module_EComm::canUserCheckOut($session, $cartDetails);
				if ($canPurchase == "0"){
					//The user can checkout
					//Create a new transaction and fill it with all the details that the user has enetered
					$userDetails = UserDetails::getUserDetailsBasedOnUserId($session->getUser());
					$shippingAddress = $userDetails->getAddress('shipping_address');
					$billingAddress = $userDetails->getAddress('billing_address');
					//Proceed to payment:
					//Create a transaction entity
					//and change the session so the user won't mess up with it
					
					//First, create a random transaction number (30 digits)
					$tid = Transaction::generateNewTID();
					$transaction = new Transaction();
					$transaction->setTid($tid);
					$transaction->setSession($session->getId());
					$transaction->setUser($session->getUser());
					$transaction->setPhone($userDetails->getPhoneNumber());
					$transaction->setShippingStreet($shippingAddress->getStreetAddress());
					$transaction->setShippingCity($shippingAddress->getCity());
					$transaction->setShippingPostal($shippingAddress->getPostalCode());
					$transaction->setShippingProvince($shippingAddress->getStateName());
					$transaction->setShippingCountry($shippingAddress->getCountryName());
					$transaction->setBillingStreet($billingAddress->getStreetAddress());
					$transaction->setBillingCity($billingAddress->getCity());
					$transaction->setBillingPostal($billingAddress->getPostalCode());
					$transaction->setBillingProvince($billingAddress->getStateName());
					$transaction->setBillingCountry($billingAddress->getCountryName());
					$transaction->setCostSubtotal((float)$cartDetails["subTotal"]);
					$transaction->setCostTax((float)$cartDetails["tax"]);
					$transaction->setCostShipping((float)$cartDetails["shipping"]);
					$transaction->setCostTotal((float)$cartDetails["total"]);
					$transaction->setIp($session->getIpAddress());
					$transaction->setShippingClass($session->getShippingClass());
					$transaction->setPaymentClass($session->getPaymentClass());
					$transaction->setDeliveryInstructions(@$_REQUEST["deliveryInstructions"]);
					$transaction->save();
					
					$_SESSION['ECommTID'] = $tid;
					//Store $tid in PHP session so when the payment form is generated, we can include it there.
					
					//After creating the transaction, regenerate the session ID to prevent users from messing up with the session after proceeding to payment
					//The user will be assigned a new session. So, their cart will be empty. They can add new items to the cart if they want, and that will not affect their transaction
					$session->reGenerateSession();
				}
				return $canPurchase;
				break;
		}
	}
	
	/**
	 * Handle the simple search and advanced search
	 * 
	 * @return string
	 */
	public function handleSearch($action){
		switch ($action){
			case 'Advanced'://Advanced search
				if (@$_REQUEST["btnSubmit"]){
					$this->smarty->assign('Name', @$_REQUEST["Name"]);
					$this->smarty->assign('Category', @$_REQUEST["Category"]);
					$this->smarty->assign('Supplier', @$_REQUEST["Supplier"]);
					$this->smarty->assign('ProductType', @$_REQUEST["ProductType"]);
					$this->smarty->assign('PriceOp', @$_REQUEST["PriceOp"]);
					$this->smarty->assign('Price1', @$_REQUEST["Price1"]);
					$this->smarty->assign('Price2', @$_REQUEST["Price2"]);
					
					$returnURL = "/Store/Search/&action=Advanced&btnSubmit=Search&Name=" . @$_REQUEST["Name"] .
								 "&Category=" . @$_REQUEST["Category"] ."&Supplier=" . @$_REQUEST["Supplier"] . 
								 "&ProductType=" . @$_REQUEST["ProductType"]."&PriceOp=" . @$_REQUEST["PriceOp"] .
								 "&Price1=" . @$_REQUEST["Price1"] . "&Price2=" . @$_REQUEST["Price2"];
					$returnURL = urlencode($returnURL);
					$returnURL = str_replace("%","%25",$returnURL);//The % sign should be replaced with %25 so Apache rewrite rules will work properly
					$this->smarty->assign('returnURL', $returnURL);
					$products = Product::searchProducts($_REQUEST);
					$this->smarty->assign('products', $products);
					$this->smarty->assign('btnSubmit', "1");
					return $this->smarty->fetch("SearchResults.tpl");
				}
				return $this->smarty->fetch("SearchFormAdvanced.tpl");
			case 'Simple'://Simple search
			default:
				if (@$_REQUEST["btnSubmit"]){
					$this->smarty->assign('searchPhrase', @$_REQUEST["searchPhrase"]);
					$returnURL = "/Store/Search/&action=Simple&btnSubmit=Search&searchPhrase=" . @$_REQUEST["searchPhrase"];
					$returnURL = urlencode($returnURL);
					$returnURL = str_replace("%","%25",$returnURL);//The % sign should be replaced with %25 so Apache rewrite rules will work properly
					$this->smarty->assign('returnURL', $returnURL);
					$products = Product::searchProductsSimple(@$_REQUEST["searchPhrase"]);
					$this->smarty->assign('products', $products);
					$this->smarty->assign('btnSubmit', "1");
				}
				return $this->smarty->fetch("SearchFormSimple.tpl");
		}
		break;
	}
	
	/**
	 * Display a tree to the user
	 * 
	 * This function is called when the user is viewing the categories tree, the product types tree, or the suppliers tree
	 * Only the categories tree has a hierarchy in it
	 * This function is called the first time as a regular call and then it is called as an ajax call everytime the user clicks on a category (or product type or supplier)
	 * 
	 * @return string
	 */
	public function handleTree($action, $page){
		if ($action != "Category" && $action != "Supplier" && $action != "ProductType")
			$action = "Category";
		
		$ajaxHelper = new HTML_AJAX_Helper ( );
		if ( $ajaxHelper->isAJAX ())
			$this->smarty->assign('ajax', 1);
		
		$groups = call_user_func(array($action, 'getAll'), true, $page);//Get all the records
		$this->smarty->assign('groups', $groups);
		$this->smarty->assign('action', $action);
		return $this->smarty->fetch("GroupTree.tpl");
	}
	
	/**
	 * Display a product
	 * 
	 * This function is called when a user is displaying a product
	 *  
	 * @return string
	 */
	public function handleProduct($action, $page){
		//$page, if exists, will be the product ID
		$product = new Product($page);
		if ($product->getId()){//Display a product from the database
			$this->smarty->assign('product', $product);
			
			//After displaying the "standard" product, display all the plugin accessories
			require_once 'plugins/products/ECommProduct.php';
			$hookResults = ECommProduct::clientPluginHooks("BeforeDisplayProduct", $product, $this);
			$html = "";
			foreach ($hookResults as $key => $val){
				$html .= @$val['HTML'];
			}
			$this->smarty->assign('html', $html);
			
			//And then display the "Go back" link
			$returnURL = @$_REQUEST["returnURL"];
			if (!$returnURL)
				$returnURL = "/Store/";
			$this->smarty->assign('returnURL', $returnURL);
		}
		return $this->smarty->fetch("Product.tpl");
	}
	
	/**
	 * Display a particular group with all its products
	 * 
	 * For example, display the "Electronics" category with all the products that belong to it
	 *  
	 * @return string
	 */
	public function handleGroup($section, $action, $page){
		//The $section variable is the class name and group name
		//It might be: Category, ProductType, or Supplier
		$group = new $section($page);
		if ($group->getId()){
			$this->smarty->assign('group', $group);
			$products = Product::searchProducts(array($section=>$page));
			$this->smarty->assign('products', $products);
		}
		else{
			$page = 0;
		}
		if ($page == 0 || $section == "Category"){//Display the groups in case there is no particular group selected, or we're viewing the sub categories of a category
			$results = call_user_func(array($section, 'getAll'), true,$page);//Get all the records
			$this->smarty->assign('results', $results);
		}
		return $this->smarty->fetch("DisplayGroupWithProduct.tpl");
	}
	
	/**
	 * Manage the accounts of the shoppers
	 * 
	 * This function allows the shoppers to manage their account
	 * They can change their profile (address, email, phone number, etc), or view all the orders that they made
	 *  
	 * @return string
	 */
	public function handleMyAccount($action){
		$auth_container = new User();
		$auth = new Auth($auth_container, null, 'authInlineHTML');
		$auth->start();
		if (!$auth->checkAuth())
			return authInlineHTML();
		
		$userId = $_SESSION['authenticated_user']->getId();
		switch ($action){
			case 'MyProfile'://Display my profile
				//It is easier to re-generate the profile form rather than using the original one
				
				$form = new Form( 'user_profile', 'POST', '/Store/MyAccount/&action=MyProfile');
				$form->addElement( 'static', 'a_username', 'Username');
				$form->addElement( 'password', 'a_password', 'Password');
				$form->addElement( 'password', 'a_password_confirm', 'Confirm Password');
				$form->addElement( 'text',  'a_name', 'Full Name');
				//$form->addElement( 'text',  'a_email', 'Email Address');
				$form->addElement( 'checkbox',  'a_join_newsletter', 'Sign me up for your E-Newsletter');
				$form->addElement( 'submit', 'a_submit', 'Save' );
				
				$user = new User($userId);
				$defaultValues ['a_username'] = $user->getUsername();
				$defaultValues ['a_name'] = $user->getName();
				//$defaultValues ['a_email'] = $user->getEmail();
				$defaultValues ['a_password'] = null;
				$defaultValues ['a_password_confirm'] = null;
				$defaultValues ['a_join_newsletter'] = $user->getJoinNewsletter();
				$form->setDefaults( $defaultValues );
				
				$form->addRule( 'a_name', 'Please enter the user\'s name', 'required', null );
				//$form->addRule( 'a_email', 'Please enter an email address', 'required', null );
				//$form->addRule( 'a_email', 'Please enter a valid email address', 'email', null );
				$form->addRule(array('a_password', 'a_password_confirm'), 'The passwords do not match', 'compare', null);
				
				if (isset( $_REQUEST ['a_submit'] ) && $form->validate()) {
					if ($_REQUEST['a_password'] != '') {
						$user->setPassword($_REQUEST['a_password']);
					}
					$user->setName($_REQUEST['a_name']);
					if (!@$_REQUEST['a_join_newsletter'])
						$_REQUEST['a_join_newsletter'] = 0;
					$user->setJoinNewsletter($_REQUEST['a_join_newsletter']);
					
					//$user->setEmail($_REQUEST['a_email']);
					$user->save();
					$this->smarty->assign('profileHasBeenChanged', 1);
				}
				$this->smarty->assign('form', $form);
				
				//After displaying the "standard" user profile, display all the extra fields such as shipping address, billing address, and phone number
				$userDetails = UserDetails::getUserDetailsBasedOnUserId($userId);
				$this->smarty->assign('userDetails', $userDetails);
				
				return $this->smarty->fetch("MyProfile.tpl");
				break;
			case 'MyOrders'://Display all the orders that this user has made, and display the details of a particular order through an ajax call
				if (@$_REQUEST["order_id"]){
					$order = new Order($_REQUEST["order_id"]);
					if ($order->getUser() != $userId)//Make sure users cannot view orders that do not belong to them
						return 'Order does not belong to you';
					$orderItems = OrderDetail::getAll($_REQUEST["order_id"]);
					$orderComments = OrderComment::getAll($order->getId());
					$this->smarty->assign('order', $order);
					$this->smarty->assign('orderItems', $orderItems);
					$this->smarty->assign('orderComments', $orderComments);
					return $this->smarty->fetch("admin/OrderDetail.tpl");
				}
				$this->addJS('/js/facebox.js');
				$this->addCSS('/css/facebox.css');
				$results = Order::getAll(true, $userId);
				$this->smarty->assign('results', $results);
				return $this->smarty->fetch("MyOrders.tpl");
				break;
		}
		return $this->smarty->fetch("MyAccount.tpl");
	}
	
	public static function getCartDetails($sessionId=null, $cartItems=null){
		//This function returns an array that contains the sub total, shipping cost, tax cost, and total cost
		//If $cartItems is an array we will use it as the cart items
		//Otherwise, we'll get the cart items from the database based on the session ID
		//If $cartItems is known before calling this method, it is a good idea to pass it to this method for performance purposes
		//If $sessionId is null, it means we want the current session
		$session = Session::getActiveSession($sessionId);
		$sessionId = $session->getId();
		if (!is_array($cartItems))
			$cartItems = CartItem::getAll($sessionId);
		
		$userId = $session->getUser();
		$userDetails = UserDetails::getUserDetailsBasedOnUserId($userId);
		$shippingAddress = $userDetails->getAddress('shipping_address');
		
		$cartDetails = array("subTotal"=>0, "tax"=>0, "shipping"=>0, "total"=>0);
		foreach ($cartItems as $cartItem){
			$product = new Product($cartItem->getProduct());
			$productPrice = $cartItem->calculatePrice() * $cartItem->getQuantity();
			$cartDetails["subTotal"] += $productPrice;
			$cartDetails["tax"] += TaxRate::calculateTax($product->getTaxClass(), $productPrice, $shippingAddress);
		}
		
		require_once 'plugins/shipping/ECommShipping.php';
		$ECommShipping = new ECommShipping();
		$shippingObj = $ECommShipping->getPlugin($session->getShippingClass());
		$cartDetails["shipping"] = (float)$shippingObj->getShippingCost($sessionId, $cartItems);
		
		$cartDetails["total"] = (float)$cartDetails["subTotal"] + (float)$cartDetails["tax"] + (float)$cartDetails["shipping"];
		foreach ($cartDetails as &$cartDetailsItem){
			$cartDetailsItem = number_format($cartDetailsItem, 2);
		}
		return $cartDetails;
	}
	
	//This method checks to see if the user can actually buy products.
	//It will check to see if the shipping and billing addresses are present, for example, in addition to some other criteria
	public static function canUserCheckOut($session=null, $cartDetails=null){
		/*
		 * The criteria are:
		 * 1. The user is logged in
		 * 2. The user has shipping address
		 * 3. The user has billing address
		 * 4. The user has a phone number
		 * 5. The order amount is more than a particular limit
		 * 6. The shipping class is defined
		 * 7. The payment class is defined
		 */
		if (!$session)
			$session = Session::getActiveSession();
		$sessionId = $session->getId();
		if (!$session->getUser())//1. The user is logged in
			return "User is not logged in";
		$userDetails = UserDetails::getUserDetailsBasedOnUserId($session->getUser());
		$shippingAddress = $userDetails->getAddress('shipping_address');
		if (!$shippingAddress||//2. The user has shipping address
			!$shippingAddress->getStreetAddress()||
			!$shippingAddress->getCity()||
			!$shippingAddress->getPostalCode()||
			!$shippingAddress->getState()||
			!$shippingAddress->getCountry()
			)
				return "Shipping address cannot be empty";
		$billingAddress = $userDetails->getAddress('billing_address');
		if (!$billingAddress||//3. The user has billing address
			!$billingAddress->getStreetAddress()||
			!$billingAddress->getCity()||
			!$billingAddress->getPostalCode()||
			!$billingAddress->getState()||
			!$billingAddress->getCountry()
			)
				return "Billing address cannot be empty";
		if (!$userDetails->getPhoneNumber())//4.The user has a phone number
			return "Phone number cannot be empty";
		
		if (!$cartDetails)
			$cartDetails = Module_EComm::getCartDetails();
		if ($cartDetails["subTotal"] < SiteConfig::get("EComm::MinimumOrderValue"))//5. The order amount is more than a particular limit
			return "You must buy at least " . SiteConfig::get("EComm::MinimumOrderValue");
		if (!$session->getShippingClass())//6. The shipping class is defined
			return "You did not select your shipping option";
		if (!$session->getPaymentClass())//7. The payment class is defined
			return "You did not select your payment option";
		return 0;
	}
	
	//This function will make sure that the user has paid the excat number they're supposed to pay with the same currency
	public static function verifyPayment($amountPaid, $currencyPaid, $tid){
		$transaction = Transaction::getTransactionBasedOnTID($tid);
		$currency = SiteConfig::get("EComm::Currency");
		if ($amountPaid == $transaction->getCostTotal() && $currencyPaid == $currency)
			return array(true, $amountPaid, $currencyPaid, $transaction->getCostTotal(), $currency);
		return array(false, $amountPaid, $currencyPaid, $transaction->getCostTotal(), $currency);
	}
	
	//This method is called when the payment is done and we want to create a new order
	public function completeOrder($tid){
		$transaction = Transaction::getTransactionBasedOnTID($tid);
		$user = new User($transaction->getUser());
		$order = new Order();
		$order->setTid($transaction->getTid());
		$order->setUser($transaction->getUser());
		$order->setCustomerName($user->getName());
		$order->setUserEmail($user->getEmail());
		$order->setPhone($transaction->getPhone());
		$order->setShippingStreet($transaction->getShippingStreet());
		$order->setShippingCity($transaction->getShippingCity());
		$order->setShippingPostal($transaction->getShippingPostal());
		$order->setShippingProvince($transaction->getShippingProvince());
		$order->setShippingCountry($transaction->getShippingCountry());
		$order->setBillingStreet($transaction->getBillingStreet());
		$order->setBillingCity($transaction->getBillingCity());
		$order->setBillingPostal($transaction->getBillingPostal());
		$order->setBillingProvince($transaction->getBillingProvince());
		$order->setBillingCountry($transaction->getBillingCountry());
		$order->setCostSubtotal($transaction->getCostSubtotal());
		$order->setCostTax($transaction->getCostTax());
		$order->setCostShipping($transaction->getCostShipping());
		$order->setCostTotal($transaction->getCostTotal());
		$order->setIp($transaction->getIp());
		$order->setShippingClass($transaction->getShippingClass());
		$order->setPaymentClass($transaction->getPaymentClass());
		$order->setDeliveryInstructions($transaction->getDeliveryInstructions());
		$order->setStatus('Pending');
		$order->save();
		$cartItems = CartItem::getAll($transaction->getSession());
		foreach ($cartItems as $cartItem){
			$product = new Product($cartItem->getProduct());
			$orderDetail = new OrderDetail();
			$orderDetail->setOrderNb($order->getId());
			$orderDetail->setProduct($product->getId());
			$orderDetail->setProductName($product->getName());
			$orderDetail->setQuantity($cartItem->getQuantity());
			$orderDetail->save();
			$cartItem->delete();
		}
		$transaction->delete();
		
		//Send an email to the user
		$this->sendEmailOrderComplete($order->getId());
		return true;
	}
	
	//This method is called when the order is complete. It sends an email to the shopper to confirm the order
	public function sendEmailOrderComplete($orderId){
		//Instead of passing the order as a parameter, we have to pass the order ID and fetch the order again from the database
		//Becase the order creation time will be null otherwise
		$order = new Order($orderId);
		$this->smarty->assign('order', $order);
		$orderItems = OrderDetail::getAll($order->getId());
		$this->smarty->assign('orderItems', $orderItems);
		$body = $this->smarty->fetch("EmailOrderComplete.tpl");
		$subject = "Order confirmation";
		
		$adminEmail = SiteConfig::get("EComm::AdminEmail");
		$userEmail = $order->getUserEmail();
		$headers = "From: $adminEmail";
		
		$mailResult1 = mail($adminEmail, $subject, $body, $headers);
		$mailResult2 = mail($userEmail,  $subject, $body, $headers);
		
		return ($mailResult1 && $mailResult2);
	}
	
	public function sendEmailAccountCreated(){
		$this->smarty->assign('userName', @$_REQUEST["a_username"]);
		$this->smarty->assign('password', @$_REQUEST["a_password"]);
		$this->smarty->assign('customerName', @$_REQUEST["a_name"]);
		$body = $this->smarty->fetch("EmailCreateAccount.tpl");
		$subject = "Account created";
		
		$adminEmail = SiteConfig::get("EComm::AdminEmail");
		$userEmail = @$_REQUEST["a_email"];
		$headers = "From: $adminEmail";
		
		return mail($userEmail, $subject, $body, $headers);
	}
	
	public static function linkHandler($value) {
		@list($id, $type) = @split(':', $value);
		switch ($type) {
			case 'MyAccount':
			case 'Cart':
			case 'Search':
			case 'Tree':
				return "/Store/$type/&action=" . $id;
			case 'ProductType':
			case 'Supplier':
			case 'Category':
				return "/Store/$type/" . $id;
			case 'Top':
			default:
				return '/Store/';
		}
	}

	public static function linkType() {
		return 'E-Commerce';
	}

	public static function getValidLinks() {
		$sql = 'select CONCAT(`id`, ":Category") as `key`, CONCAT(" - Category: ", `name`) as value from ecomm_category order by `name` asc';
		$categories = Database::singleton ()->query_fetch_all ( $sql );
		
		$sql = 'select CONCAT(`id`, ":Supplier") as `key`, CONCAT(" - Supplier: ", `name`) as value from ecomm_supplier order by `name` asc';
		$suppliers = Database::singleton ()->query_fetch_all ( $sql );
		
		$sql = 'select CONCAT(`id`, ":ProductType") as `key`, CONCAT(" - ProductType: ", `name`) as value from ecomm_product_type order by `name` asc';
		$productTypes = Database::singleton ()->query_fetch_all ( $sql );
		
		$pages = $categories;
		foreach ($suppliers as $supplier) {
			array_push($pages, $supplier);
		}
		foreach ($productTypes as $productType) {
			array_push($pages, $productType);
		}
		array_unshift($pages, array('key' => ':MyAccount', 'value' => 'My Account'));
		array_unshift($pages, array('key' => 'Display:Cart', 'value' => 'Shopping Cart'));
		array_unshift($pages, array('key' => 'Advanced:Search', 'value' => 'Search Engine (Advanced)'));
		array_unshift($pages, array('key' => 'Simple:Search', 'value' => 'Search Engine (Simple)'));
		array_unshift($pages, array('key' => 'ProductType:Tree', 'value' => 'Tree - Product Types'));
		array_unshift($pages, array('key' => 'Supplier:Tree', 'value' => 'Tree - Suppliers'));
		array_unshift($pages, array('key' => 'Category:Tree', 'value' => 'Tree - Categories'));
		array_unshift($pages, array('key' => ':ProductType', 'value' => 'Product Types'));
		array_unshift($pages, array('key' => ':Supplier', 'value' => 'Suppliers'));
		array_unshift($pages, array('key' => ':Category', 'value' => 'Categories'));
		array_unshift($pages, array('key' => ':Top', 'value' => 'Store (Top Level)'));
		
		return $pages;
	}
}
?>