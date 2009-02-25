<?php

/*
 * Use this class only if you want a basic user that will have authentication abilities.
 * 
 * For users that require extended profile information, use the User_Profile class, which extends this class.
 */

include_once 'Auth/Auth.php';
include_once 'Auth/Container.php';

class User extends Auth_Container {

	protected $usr_id;
	protected $username;
	protected $name;
	protected $email;
	protected $phone;
	protected $status;
	protected $address;
	protected $join_newsletter;
	protected $shipping_address;
	
	
	protected $auth_group;
	protected $auth_group_name;
	protected $password;
	protected $salt;
	protected $permissions = array();

	public function __construct($usr_id = null) {
		if (!is_null($usr_id)) {
			if (!is_numeric($usr_id)) {
				$sql = 'select aut_id from auth where aut_username="' . e($usr_id) . '"';
				$res = Database::singleton()->query_fetch($sql);
				$usr_id = $res['aut_id'];
				if (!$usr_id)
					return;
			}
			
			$sql = 'SELECT * 
					FROM auth 
					LEFT JOIN auth_groups
					ON auth.aut_agp_id = auth_groups.agp_id
					WHERE auth.aut_id = "'. e($usr_id) .'"';
			$result = Database::singleton()->query_fetch($sql);
			$result = Database::singleton()->unescape($result);
			
			$this->usr_id = @$result['aut_id'];
			$this->username = @$result['aut_username'];
			$this->name = @$result['aut_name'];
			$this->email = @$result['aut_email'];
			$this->phone = @$result['aut_phone'];
			$this->password = @$result['aut_password'];
			$this->salt = @$result['aut_salt'];
			$this->auth_group = @$result['aut_agp_id'];
			$this->auth_group_name = @$result['agp_name'];
			$this->status = @$result['aut_status'];
			$this->permissions = $this->getPerms();
			$this->join_newsletter = @$result['auth_join_newsletter'];
			//echo $result['aut_address'] . "<br>" . $result['aut_shipping_address'] . "))<br>";
			$this->address = new Address(@$result['aut_address']);
			$this->shipping_address = new Address(@$result['aut_shipping_address']);
		}
	}
	
	public function getPerms() {
		$sql = 'SELECT p.key FROM groups_permissions g, permissions p WHERE g.perm_id=p.id AND g.group_id=' . $this->auth_group;
		$result = @Database::singleton()->query_fetch_all($sql);
		$permissions = array();
		foreach ($result as $perm) {
			$permissions[] = $perm['key'];
		}
		return $permissions;
	}
	
	public function hasPerm($key) {
		return in_array($key, $this->permissions);
	}
	
	public function save() {
		$result = false;
		$e_sql = "SELECT aut_id FROM auth WHERE aut_id = '". Database::singleton()->escape($this->usr_id) ."'";
		$e_result = Database::singleton()->query_fetch($e_sql);
		
		if ($e_result) {
			$sql = "UPDATE auth SET 
						aut_username = '". Database::singleton()->escape($this->username) ."',
						aut_password = '". Database::singleton()->escape($this->password) ."',
						aut_salt     = '". Database::singleton()->escape($this->salt) . "',
						aut_agp_id   = '". Database::singleton()->escape($this->auth_group) ."',
						aut_name     = '". Database::singleton()->escape($this->name) ."',						
						aut_email    = '". Database::singleton()->escape($this->email) ."',
						aut_phone    = '". Database::singleton()->escape($this->phone) ."',
						aut_status   = '". Database::singleton()->escape($this->status) ."',					
						auth_join_newsletter = '". Database::singleton()->escape($this->join_newsletter) ."',					
						aut_last_touched = NOW(),
						aut_address  = '". Database::singleton()->escape(@$this->getAddress()->getId()) ."',
						aut_shipping_address  = '". Database::singleton()->escape(@$this->getShippingAddress()->getId()) ."'
						where aut_id = '". Database::singleton()->escape($this->usr_id) ."'";
			$result = Database::singleton()->query($sql);
		}
		else {
			$uniqueUserNameSQL = "SELECT aut_id FROM auth WHERE aut_username like '". Database::singleton()->escape($this->username) ."'";
			$uniqueUserNameResult = Database::singleton()->query_fetch($uniqueUserNameSQL);
			if ($uniqueUserNameResult){//Username already exists
				return false;
			}
			$sql = "INSERT INTO auth SET 
						aut_username = '". Database::singleton()->escape($this->username) ."',
						aut_password = '". Database::singleton()->escape($this->password) ."',
						aut_salt     = '". Database::singleton()->escape($this->salt) ."',
						aut_name     = '". Database::singleton()->escape($this->name) ."',						
						aut_email    = '". Database::singleton()->escape($this->email) ."',
						aut_phone    = '". Database::singleton()->escape($this->phone) ."',
						aut_status   = '". Database::singleton()->escape($this->status) ."',				
						auth_join_newsletter = '". Database::singleton()->escape($this->join_newsletter) ."',					
						aut_last_touched = NOW(),
						aut_address  = '". Database::singleton()->escape(@$this->getAddress()->getId()) ."',
						aut_shipping_address  = '". Database::singleton()->escape(@$this->getShippingAddress()->getId()) ."',
						aut_agp_id   = '". Database::singleton()->escape($this->auth_group) . "'";
			
			$result = Database::singleton()->query($sql);
			//$e_result = Database::singleton()->query_fetch($e_sql);
			$this->setId(Database::singleton()->lastInsertedID());
		}
		
		include_once('modules/Mail/include/MailUser.php');
		$nUser = new MailUser($this->email);
		if ($this->join_newsletter){
			$name = explode(" ", trim($this->name));
			$nUser->setEmail($this->email);
			@$nUser->setFirstName($name[0]);
			@$nUser->setLastName($name[1]);
			$nUser->save();
		}
		else{
			$nUser->delete();
		}
		return $result;
	}
	
	public function delete() {
		
		$result = false;
		
		$sql = "UPDATE auth SET aut_status = '0' WHERE aut_id = '". Database::singleton()->escape($this->usr_id) ."'";
		$result = Database::singleton()->query($sql);			
		
		return $result;
	}
	
	public function permDelete() {
		$result = false;
		
		$sql = "delete from auth WHERE aut_id = '". e($this->usr_id) ."'";
		$result = Database::singleton()->query($sql);			
		
		return $result;
	}

	public function getId() {
		return $this->usr_id;
	}
	
	public function getUsername () {
		return $this->username;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function getEmail() {
		return $this->email;
	}
	
	public function getPhone() {
		return $this->phone;
	}
	
	public function getActiveStatus() {
		return $this->status;
	}
	
	public function getJoinNewsletter() {
		return $this->join_newsletter;
	}
	
	public function getAuthGroup() {
		return $this->auth_group;
	}
	
	public function getAuthGroupName() {
		return $this->auth_group_name;
	}
	
	public function getPassword() {
		return $this->password;
	}

	public function getAddress(){
		return $this->address;
	}
	
	public function getShippingAddress(){
		return $this->shipping_address;
	}
	
	public function setId ($id) {
		$this->usr_id = $id;
	}
	
	public function setUsername($username) {
		$this->username = $username;
	}
	
	public function setName($name) {
		$this->name = $name;
	}
	
	public function setEmail($email) {
		$this->email = $email;
	}
	
	public function setPhone($phone) {
		$this->phone = $phone;
	}
	
	public function setPassword($password) {
		$salt = uniqid('norexcms', true);
		$this->salt = $salt;
		$this->password = (md5($password . md5($salt)));
		
	}

	public function setActiveStatus($status) {
		$this->status = $status;
	}

	public function setJoinNewsletter($join_newsletter) {
		$this->join_newsletter = $join_newsletter;
	}
	
	public function setAuthGroup($group) {
		$this->auth_group = $group;	
	}

	public function setAuthGroupName($group_name) {
		$this->auth_group_name = $group_name;
	}
	
	public function setAddress($address) {
		//Caution***** $address is an object. So, when assigning it, we are actually assigning a pointer to the same object NOT creating a new object
		$this->address = $address;
	}
	
	public function setShippingAddress($address) {
		//Caution***** $address is an object. So, when assigning it, we are actually assigning a pointer to the same object NOT creating a new object
		$this->shipping_address = $address;
	}
	
	public static function getUsers($filter=true) {
		$sql = "SELECT * 
				FROM auth 
				LEFT JOIN auth_groups
				ON aut_agp_id = agp_id ";
		if ($filter)
			$sql .= "WHERE aut_status > 0 ";
		$sql .= "ORDER BY aut_username";
		$sql_result = Database::singleton()->query_fetch_all($sql);
		$sql_result = Database::singleton()->unescape($sql_result);
		
		$users = array();
		foreach ($sql_result as $user) {
			$users[$user['aut_id']] = new User();
			$users[$user['aut_id']]->setId($user['aut_id']);
			$users[$user['aut_id']]->setUsername($user['aut_username']);
			$users[$user['aut_id']]->setName($user['aut_name']);
			$users[$user['aut_id']]->setEmail($user['aut_email']);
			$users[$user['aut_id']]->setPhone($user['aut_phone']);
			$users[$user['aut_id']]->setAuthGroup($user['agp_id']);
			$users[$user['aut_id']]->setAuthGroupName($user['agp_name']);
			$users[$user['aut_id']]->setActiveStatus($user['aut_status']);
			$users[$user['aut_id']]->setJoinNewsletter($user['auth_join_newsletter']);
		}
		
		return $users;
	}	

	public function __toString() {
		return 'User class object';
	}
	
	public function fetchData($username, $password) {
    	$sql = "SELECT * FROM auth WHERE aut_username = '". e($username) ."' AND aut_status = 1";
        $token = Database::singleton()->query_fetch($sql);
        if ((md5($password . md5($token['aut_salt']))) == $token['aut_password']) {
        	$_SESSION['authenticated_user'] = new User($token['aut_id']);        	
        	return true;
        } else {
        	unset($_SESSION['authenticated_user']);
        	return false;
        }
    	
    }
	
	public function isMe($usr_id = null) {
		if (is_null($usr_id)) {
			$usr_id = $this->usr_id;
		}
		if ($usr_id == $_SESSION['authenticated_user']->getId()) {
			return true;
		}
		return false;
	}
    
	public function getUserAddEditForm($target = '/admin/User', $admin = false, $addSection = true) {
		$form = new Form( 'user_addedit', 'POST', $target);
		
		if ($addSection) {
			$form->setConstants( array ( 'section' => 'addedit' ) );
			$form->addElement( 'hidden', 'section' );
		}

		if (@$_REQUEST ['id']) {
			$this->__construct($_REQUEST['id']);
			$form->setConstants( array ( 'id' => $_REQUEST ['id'] ) );
			$form->addElement( 'hidden', 'id' );
		}
		elseif (!@$this->getId()) {
			$this->__construct();
		}
		
		$statuses = array (1 => 'Active', 0 => 'Disabled');		
		
		$form->addElement('header','general','General Info');
		if (!$admin && @$_REQUEST['id']) {//The user is editing their profile, Do not edit the username
			$form->addElement( 'static', 'a_username_label', 'Username (Email address)', $this->getUsername());
			$form->setConstants( array ( 'a_username' => $this->getUsername() ) );
			$form->addElement( 'hidden', 'a_username' );
		}
		else{
			$form->addElement( 'text', 'a_username', 'Username (Email address)');
			$form->addRule( 'a_username', 'Please enter a username', 'required', null, 'client' );
			$form->addRule( 'a_username', 'Please enter a valid email address for the username', 'email', null, 'client' );
		}
		$form->addElement( 'password', 'a_password', 'Password');
		$form->addElement( 'password', 'a_password_confirm', 'Confirm Password');
		$form->addElement( 'text',  'a_name', 'Full Name');
		//$form->addElement( 'text',  'a_email', 'Email Address');
		$form->addElement( 'text',  'a_phone', 'Phone number');
		$form->addElement( 'checkbox',  'a_join_newsletter', 'Sign me up for your E-Newsletter');
		
		$form->addElement('header','billing_address_header','Billing Address');
		
		$form->addElement('text', 'a_address', 'Address');
		$form->addElement('text', 'a_city', 'City');
		$form->addElement('text', 'a_postalcode', 'Postal Code');
		
		$form->setConstants( array ( 'a_state' => '1' ) );//31 is the ID of Alberta. It should be a SiteConfig variable
		$form->addElement( 'hidden', 'a_state' );
		$form->addElement('static', 'a_state1', 'State / Province','Alberta');
		
		$form->setConstants( array ( 'a_country' => '31' ) );//31 is the ID of Canada. It should be a SiteConfig variable
		$form->addElement( 'hidden', 'a_country' );
		$form->addElement('static', 'a_country1', 'Country','Canada');
		
		
		
		$form->addElement('header','shipping_address_header','Shipping Address');
		$form->addElement('text', 'shipping_address', 'Address');
		$form->addElement('text', 'shipping_city', 'City');
		$form->addElement('text', 'shipping_postalcode', 'Postal Code');
		
		$form->setConstants( array ( 'shipping_state' => '1' ) );//31 is the ID of Alberta. It should be a SiteConfig variable
		$form->addElement( 'hidden', 'shipping_state' );
		$form->addElement('static', 'shipping_state1', 'State / Province','Alberta');
		
		$form->setConstants( array ( 'shipping_country' => '31' ) );//31 is the ID of Canada. It should be a SiteConfig variable
		$form->addElement( 'hidden', 'shipping_country' );
		$form->addElement('static', 'shipping_country1', 'Country','Canada');
		
		
		$form->addElement('header','save','Save');
		if ($admin)
			$form->addElement( 'select', 'a_status', 'Active Status', $statuses);
		
		$form->addElement( 'submit', 'a_submit', 'Save' );
		$form->addElement( 'reset', 'a_cancel', 'Cancel' );

		if (isset($this->user) && $this->user->hasPerm('assigngroups')) {
			$sql = 'SELECT agp_id, agp_name from auth_groups';
			$groups = Database::singleton()->query_fetch_all($sql);
			$assignableGroup = array ( );
			foreach ( $groups as $group ) {
				$assignableGroup [$group ['agp_id']] = $group ['agp_name'];
			}
			if (@$this) {
				$defaultValues['a_group'] = $this->getAuthGroup();
			}
			$form->addElement( 'select',  'a_group', 'Member Group', $assignableGroup);
		}


		
		$defaultValues ['a_username'] = $this->getUsername();
		
		$defaultValues ['a_name'] = $this->getName();
		//$defaultValues ['a_email'] = $this->getEmail();
		$defaultValues ['a_phone'] = $this->getPhone();
		$defaultValues ['a_join_newsletter'] = $this->getJoinNewsletter();
		$defaultValues ['a_password'] = null;
		$defaultValues ['a_password_confirm'] = null;
		if (@$this->getAddress()){
			$defaultValues ['a_address'] = @$this->getAddress()->getStreetAddress();
			$defaultValues ['a_city'] = @$this->getAddress()->getCity();
			$defaultValues ['a_postalcode'] = @$this->getAddress()->getPostalCode();
		}
		
		if (@$this->getShippingAddress()){
			$defaultValues ['shipping_address'] = @$this->getShippingAddress()->getStreetAddress();
			$defaultValues ['shipping_city'] = @$this->getShippingAddress()->getCity();
			$defaultValues ['shipping_postalcode'] = @$this->getShippingAddress()->getPostalCode();
		}
		
		if ($admin)
			$defaultValues ['a_status'] = $this->getActiveStatus();
		
		$form->setDefaults( $defaultValues );
				

		$form->addRule( 'a_name', 'Please enter the user\'s name', 'required', null, 'client' );
		//$form->addRule( 'a_email', 'Please enter an email address', 'required', null, 'client' );
		//$form->addRule( 'a_email', 'Please enter a valid email address', 'email', null, 'client' );
		$form->addRule( 'a_phone', 'Please enter a phone number', 'required', null, 'client' );
		$form->addRule( 'a_address', 'Please enter a billing address', 'required', null, 'client' );
		$form->addRule( 'a_city', 'Please enter a billing address city', 'required', null, 'client' );
		$form->addRule( 'a_postalcode', 'Please enter a billing address postal code', 'required', null, 'client' );
		$form->addRule( 'shipping_address', 'Please enter a shipping address', 'required', null, 'client' );
		$form->addRule( 'shipping_city', 'Please enter a shipping address city', 'required', null, 'client' );
		$form->addRule( 'shipping_postalcode', 'Please enter a shipping address postal code', 'required', null, 'client' );
		if (!isset($_REQUEST ['id'])) {
			$form->addRule( 'a_password', 'Please enter a password', 'required', null, 'client' );
			$form->addRule( 'a_password_confirm', 'Please confirm the passwords match', 'required', null, 'client' );
		}
		$form->addRule(array('a_password', 'a_password_confirm'), 'The passwords do not match', 'compare', null, 'client' );
		
		if (isset( $_REQUEST ['a_submit'] ) && $form->validate()) {
			$this->setPassword($_REQUEST['a_password']);
			if ($admin || @!$_REQUEST['id']){
				$this->setUsername($_REQUEST['a_username']);
				$this->setEmail($_REQUEST['a_username']);
			}
			$this->setActiveStatus(1);
			$this->setPhone($_REQUEST['a_phone']);
			$this->setName($_REQUEST['a_name']);
			$this->setJoinNewsletter(@$_REQUEST['a_join_newsletter']);
			if (@$this->getAddress()){
				$billingTemp = new Address(@$this->getAddress()->getId());
			}
			else{
				$billingTemp = new Address();
			}
			$billingTemp->setStreetAddress($_REQUEST['a_address']);
			$billingTemp->setCity($_REQUEST['a_city']);
			$billingTemp->setPostalCode($_REQUEST['a_postalcode']);
			$billingTemp->setState($_REQUEST['a_state']);
			$billingTemp->setCountry($_REQUEST['a_country']);
			$billingTemp->save();
			$this->setAddress($billingTemp);
			
			if (@$this->getShippingAddress()){
				$shippingTemp = new Address(@$this->getShippingAddress()->getId());
			}
			else{
				$shippingTemp = new Address();
			}
			$shippingTemp->setStreetAddress($_REQUEST['shipping_address']);
			$shippingTemp->setCity($_REQUEST['shipping_city']);
			$shippingTemp->setPostalCode($_REQUEST['shipping_postalcode']);
			$shippingTemp->setState($_REQUEST['shipping_state']);
			$shippingTemp->setCountry($_REQUEST['shipping_country']);
			$shippingTemp->save();
			$this->setShippingAddress($shippingTemp);
			
			if ($this->save()){
				$_REQUEST["user_created"] = 1;
			}
			else{
				$form->addElement( 'static', 'Message', 'Username already exists');
				$_REQUEST["username_already_exists"] = 1;
			}
		}
		return $form;
	}
}

?>