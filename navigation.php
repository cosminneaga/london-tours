<!--navigation bar file for index pages-->
<div class="index-nav">
	<ul>
		<li><i>London Tours</i></li>
		<li><button onclick="document.location.href = 'index.php'">Home</button></li>
		<li><button onclick="document.location.href = 'about.php'">About</button></li>
		<li><button onclick="document.location.href = 'contact.php'">Contact</button></li>
		<li><button onclick="document.location.href = 'register.php'">Register</button></li>
		<li><button onclick="document.location.href = 'login.php'">Login</button></li>
		<li><button onclick="document.location.href = 'admin_login.php'">Admin</button></li>
		<div class="search-container">
			<form method="post" action="search-results.php">
				<input type="text" name="searchName" placeholder="Search By Name...">
				<input type="submit" name="submitSearch" class="searchBtn" value="Search">
			</form>
		</div>
	</ul>
</div>
<div class="clearFix"></div>
<!--navigation bar ends-->