<?php
/**
 * User Module
 * @author Christopher Troup <chris@norex.ca>
 * @package Modules
 * @version 2.0
 */


/**
 * User Module
 * 
 * Provide user management for the core CMS
 * @package Modules
 * @subpackage User
 */
class Module_User extends Module {
	
	/**
	 * Build and return admin interface
	 *
	 * Any module providing an admin interface is required to have this function, which
	 * returns a string containing the (x)html of it's admin interface.
	 * @return string
	 */
	function getAdminInterface() {

		$this->template = 'admin/user.tpl';
		
		$this->addJS('/modules/User/js/admin.js');

		if (!$this->user->hasPerm('viewusermodule')) {
			return false;
		}
		
		switch ( @$_REQUEST ['section']) {
			case 'deleteUser';
				$user = new User($_REQUEST['id']);
				$user->delete();
				$this->setupMainList();
				$this->template = 'admin/user.tpl';
				break;
			case 'deleteGroup':
				$group = new Group($_REQUEST['id']);
				$group->delete();
				$groups = Group::getGroups();
				$this->smarty->assign('groups', $groups);
				return $this->smarty->fetch('admin/groups.tpl');
				break;
			case 'groups':
				$this->template = 'admin/groups.tpl';
				$groups = Group::getGroups();
				$this->smarty->assign('groups', $groups);
				break;
			case 'groupsaddedit':
				
				$form = Group::getAddEditForm();
				
				if ($form->validate() && $form->isSubmitted() && (isset($_REQUEST['submit']))) {
					$groups = Group::getGroups();
					$this->smarty->assign('groups', $groups);
					return $this->smarty->fetch('admin/groups.tpl');
				} else {
					return $form->display();
				}
				
				break;

			case 'permissions':
				if (isset($_REQUEST['perm']) && isset($_REQUEST['group'])) {
					$group = new Group($_REQUEST['group']);
					$group->togglePerm($_REQUEST['perm']);
				}
				
				$this->template = 'admin/permissions.tpl';
				$groups = Group::getGroups();
				$permissions = Permission::getPermissions();
				$this->smarty->assign('permissions', $permissions);
				$this->smarty->assign('groups', $groups);
				
				break;
			case 'userTable':
				$this->setupMainList();
				$this->template = 'admin/user_table.tpl';
				break;
			case 'addedit':
				$form = $this->getUserAddEditForm('/admin/User', true);
				
				if ($form->validate() && $form->isSubmitted() && (isset($_REQUEST['a_submit']) || isset($_REQUEST['a_cancel']))) {
					$this->setupMainList();
					return $this->smarty->fetch( 'admin/user.tpl' );
				} else {
					return $form->display();
				}
				break;
			default:
				$this->setupMainList();
				break;
		}
		return $this->smarty->fetch( $this->template );
	}

	public function setupMainList() {
		$users = User::getUsers(false);
		$this->smarty->assign('users', $users);
	}

	public function getUserInterface($params = null) {
		switch (@$_REQUEST['section']) {
			/*
			 * 
			 * Publicly Accesscable Pages
			 *
			 */
			case 'signup':

				//$_REQUEST['id'] = @$_SESSION["authenticated_user"]->getId();
				$usr = new User();
				$form = $usr->getUserAddEditForm("/user/signup/",false,false);
				if (@$_REQUEST["user_created"]){//The user has been added
					return "You have create a new user";
				}
				return $form->display();
				$this->template = 'account_signup.tpl';

				$this->addJS('/modules/User/js/profile.js');
				if (! $form = $this->getUserAddEditForm('/user/signup'))
					break;

				$form->setConstants( array ( 'section' => 'signup' ) );
				
				if (isset( $_POST['a_submit'] ) && $form->validate()) {
					$this->template = 'account_confirmed.tpl';

					$_POST['username'] = $_POST['a_username'];
					$_POST['password'] = $_POST['a_password'];
					$_POST['doLogin'] = "Login";

					$auth_container = new User();
					$auth = new Auth($auth_container, null, 'authInlineHTML');
					$auth->start();
					$auth->checkAuth();

					header ('Location: /user/');
				}
				
				$this->smarty->assign( 'form', $form );
				return $this->smarty->fetch($this->template);
				break;
			
			case 'logout':
				unset($_SESSION['authenticated_user']);
				$auth_container = new User();
				$auth = new Auth($auth_container, null, 'authInlineHTML');
				$auth->logout();
				
				header('Location: /');
				exit;
				break;
			
			case 'forgotpass':
				$form = new Form( 'frm_forgotpass', 'POST', "/user/forgotpass");
				
				$form->addElement('header','via_username','Retrieve your password via email');
				$form->addElement( 'text', 'username', 'Username' );
				$form->addElement( 'submit', 'submit', 'GO >>' );
				
				if ($form->validate() && isset($_REQUEST['submit'])) {
					$usr = new User(@$_REQUEST["username"]);
					if (!$usr->getId()){
						$form->addElement('static', 'error_msg', '&nbsp;', 'This username could not be found in our database');
						return $form->display();
					}
					srand(time());
					$randomPass = (rand());
					$this->smarty->assign('randomPass', $randomPass);
					$body = $this->smarty->fetch('resetPasswordEmail.tpl');
					$headers = "From: info@feedstore.ca";
					$mailResult = mail($usr->getEmail(), "Your password has been reset", $body, $headers);
					if ($mailResult){
						$usr->setPassword($randomPass);
						$usr->save();
						return "Your password has been changed and sent to your email address: " . $usr->getEmail();
					}
					else{
						return "Could not reset the password. Please contact the administrator of the site.";
					}
				}
				
				return $form->display();
				break;
			case 'profile':
				if (!@isset($_SESSION["authenticated_user"]) || !@$_SESSION["authenticated_user"]->getId()){
					header('location: /user/');
					exit;
				}
				$_REQUEST['id'] = @$_SESSION["authenticated_user"]->getId();
				$usr = new User();
				$form = $usr->getUserAddEditForm("/user/profile",false,false);
				if (@$_REQUEST["user_created"]){
					$_SESSION["authenticated_user"] = new User($_SESSION["authenticated_user"]->getId());//Refresh the user in the session
				}
				return $form->display();
				break;
			default:
				if(isset($_SESSION['authenticated_user']) && $_SESSION['authenticated_user']){
					$this->smarty->assign('username', $_SESSION['authenticated_user']->getUserName());
					return $this->smarty->fetch('my_account.tpl');
				}
				return authInlineHTML();
		}
	}

	public function getUserAddEditForm($target = '/admin/User', $admin = false) {
		
		$form = new Form( 'user_addedit', 'POST', $target, '',
		array ( 'class' => 'admin' ) );

		$form->setConstants( array ( 'section' => 'addedit' ) );
		$form->addElement( 'hidden', 'section' );

		if (@$_REQUEST ['id']) {
			$user = new User($_REQUEST['id']);
			$form->setConstants( array ( 'id' => $_REQUEST ['id'] ) );
			$form->addElement( 'hidden', 'id' );
		}
		else {
			$user = new User();
		}

		$statuses = array (1 => 'Active', 0 => 'Disabled');		
		
		$form->addElement( 'text', 'a_username', 'Email address(Username)');
		$form->addElement( 'password', 'a_password', 'Password');
		$form->addElement( 'password', 'a_password_confirm', 'Confirm Password');
		$form->addElement( 'text',  'a_name', 'Full Name');
		//$form->addElement( 'text',  'a_email', 'Email Address');
		
		if ($admin)
			$form->addElement( 'select', 'a_status', 'Active Status', $statuses);

		if (isset($this->user) && $this->user->hasPerm('assigngroups')) {
			$sql = 'SELECT agp_id, agp_name from auth_groups';
			$groups = Database::singleton()->query_fetch_all($sql);
			$assignableGroup = array ( );
			foreach ( $groups as $group ) {
				$assignableGroup [$group ['agp_id']] = $group ['agp_name'];
			}
			if (@$user) {
				$defaultValues['a_group'] = $user->getAuthGroup();
			}
			$form->addElement( 'select',  'a_group', 'Member Group', $assignableGroup);
		}
		$form->addElement( 'advcheckbox',  'a_join_newsletter', 'Sign me up for your E-Newsletter');
		
		$form->addElement( 'submit', 'a_submit', 'Save' );


		
		$defaultValues ['a_username'] = $user->getUsername();
		$defaultValues ['a_name'] = $user->getName();
		$defaultValues ['a_email'] = $user->getEmail();
		$defaultValues ['a_password'] = null;
		$defaultValues ['a_password_confirm'] = null;
		$defaultValues ['a_join_newsletter'] = $user->getJoinNewsletter();
		if ($admin)
			$defaultValues ['a_status'] = $user->getActiveStatus();
		
		$form->setDefaults( $defaultValues );
				

		$form->addRule( 'a_username', 'Please enter a username', 'required', null ,'client');
		$form->addRule( 'a_username', 'Please enter an email address', 'required', null  ,'client');
		$form->addRule( 'a_username', 'Please enter a valid email address for the username', 'email', null  ,'client');
		$form->addRule( 'a_name', 'Please enter your name', 'required', null  ,'client');
		//$form->addRule( 'a_email', 'Please enter an email address', 'required', null );
		//$form->addRule( 'a_email', 'Please enter a valid email address', 'email', null );
		if (!isset($_REQUEST ['id'])) {
			$form->addRule( 'a_password', 'Please enter a password', 'required', null  ,'client');
			$form->addRule( 'a_password_confirm', 'Please confirm the passwords match', 'required', null  ,'client');
		}
		$form->addRule(array('a_password', 'a_password_confirm'), 'The passwords do not match', 'compare', null ,'client');

		if (isset( $_REQUEST ['a_submit'] ) && $form->validate()) {
			$this->template = 'admin/user.tpl';
			$this->doUserSubmit();
		}
		return $form;
	}
	
	public function doUserSubmit() {
		//Deciding whether this is an update or a new user.
		if (@isset( $_REQUEST ['id'] )) {
			$user = new User($_REQUEST['id']);
			if ($_REQUEST['a_password'] != '') {
				$user->setPassword($_REQUEST['a_password']);
			}
		} else {
			$user = new User();
			$user->setPassword($_REQUEST['a_password']);
				
		}
		$user->setUsername($_REQUEST['a_username']);
		$user->setName($_REQUEST['a_name']);
		$user->setEmail($_REQUEST['a_username']);
		$user->setJoinNewsletter(@$_REQUEST['a_join_newsletter']);
		if (isset($_REQUEST['a_group'])) {
			$user->setAuthGroup($_REQUEST['a_group']);
		} else {
			$user->setAuthGroup(2);
		}
		if (isset($_REQUEST['a_status'])) {
			$user->setActiveStatus($_REQUEST['a_status']);
		} else {
			$user->setActiveStatus(1);
		}
		$user->save();

		$this->setupMainList();
		$this->template = 'admin/user_table.tpl';
	}
}

?>