<?PHP
	session_start(); 
	
	require_once("config.php");

	If ($_SESSION['site'] == "") {
		header ("Location: /index.php");
	}
	
	if (isset($_GET['id']) && $_GET['id']== "logout") {
		session_destroy();
		header ("Location: /index.php");
	}


	$con = mysqli_connect ("localhost:3306", "root", "") or die ('Error setting sql statement');
	mysqli_select_db ($con,"blottcom_dogmtro") or die ('Error setting dbname');
	
	$former = (isset($_POST['Submit']) ? $_POST['Submit'] : '');
	$bad_chars = array("'", "\"", "`", "(", ")", ".");
	
	if ($former == "Add") {

		$staff_id = $_POST["txtstaff_id"];
		$staff_id = strtolower($staff_id);
		$staff_id = str_replace($bad_chars, '', $staff_id);
		
		$staff_pw = $_POST["txtstaff_pw"];
		$staff_pw = strtolower($staff_pw);
		$staff_pw = str_replace($bad_chars, '', $staff_pw);
		$staff_pw = MD5($staff_pw);
	
		mysqli_query($con, "INSERT INTO users (username, password) VALUES('$staff_id', '$staff_pw')") or die(mysql_error());  
		header ("Location: /edit_admin.php");
	}

	require_once("inc/headers.php");
	require_once("inc/admin_css.php");
	require_once("inc/site_header.php");	
?>
		<div class="middle">
			<table cellspacing="0" class="buy_table" width="758px">
				<form method="post" action="">
					<thead>
						<tr> 
							<th><a href="/index.php">Admin Home</a></th>
							<th><a href="/edit_admin.php">Admin User Home</a></th>
						</tr>
					</thead>
					<tbody>
						<tr> 
							<td style="text-align:center">Username:</td>
							<td style="text-align:center">Password:</td>
						</tr>
						<tr> 
							<td style="text-align:center"><input type="text" name="txtstaff_id" size="30" maxlength="25" autocomplete="no" /></td>
							<td style="text-align:center"><input type="password" name="txtstaff_pw" size="30" maxlength="25" /></td>
						</tr>
						<tr> 
							<td></td>
							<td><input type="submit" name="Submit" value="Add" /></td>
						</tr>
					</tbody>
				</form>
			</table>
		</div>

<?PHP require_once("inc/footer.php") ?>
</div>
</body>
</html>