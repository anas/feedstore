		<div class="block">
		
		{if !$user}
		{if $smarty.post.username || $smarty.post.password}
		<p class="error">Invalid username/password</p>
		{/if}
			<form method="post" action="/Content/MembersOnly" name="loginBlock">
        	<h2 class="rcTitle">Member Login</h2>
	          <br />
	          <h3>Username</h3>
	
	          <input name="username" type="text" class="inputField" />
	          <h3>Password</h3>
	          <input name="password" type="password" class="inputField" />
	          <br />
	          <input type="image" src="images/login.jpg" id="doLogin" />
	         </form>
	    {else}
		<p>You are logged in as {$user->getUsername()}</p>
		<p><a href="/Content/MembersOnly">Members Area</a></p>
		<p><a href="/user/logout" onclick="return !logoutSubmit();">Logout</a></p>
		
		{if $user->hasPerm('admin')}
		<p><a href="/admin/Content">Administration</a></p>
		{/if}
		{/if}
   		</div>