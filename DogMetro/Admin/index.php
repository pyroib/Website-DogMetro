<?php
	session_start(); 
	require_once("config.php");
	
	if (isset($_GET['id']) && $_GET['id'] == "logout") {
		session_destroy();
		header ("Location: /index.php");
	}
	

	$con = mysqli_connect ("localhost:3306", "root", "") or die ('Error setting sql statement');
	mysqli_select_db ($con,"blottcom_dogmtro") or die ('Error setting dbname');
	
	
	require_once("inc/headers.php");
	require_once("inc/admin_css.php");
	require_once("inc/site_header.php");	

	$former = (isset( $_POST['Submit']) ? $_POST['Submit'] : '' );
	$bad_chars = array("'", "\"", "`", "(", ")", ".");
	
	if ($former == "Login") {

		$staff_id = $_POST["txtstaff_id"];
		$staff_id = strtolower($staff_id);
		$staff_id = str_replace($bad_chars, '', $staff_id);
		
		$staff_pw = $_POST["txtstaff_pw"];
		$staff_pw = strtolower($staff_pw);
		$staff_pw = str_replace($bad_chars, '', $staff_pw);
		$staff_pw = MD5($staff_pw);


		$query1  = "SELECT * FROM users WHERE username = '$staff_id' AND password = '$staff_pw'";
		$result1 = mysqli_query($con, $query1) or die ('Error setting result1');
		
		while($row1 = mysqli_fetch_array($result1)) {
			if ($row1['username']) {
				$_SESSION['site'] = "access";	
				$_SESSION['log'] = $row1['username'];
			}
		}
	}	
?>
		<div class="middle">
<?php
	if (isset($_SESSION['site']) && $_SESSION['site'] == "access") {
?>		
		<table cellspacing="0" class="buy_table" width="758px">
			<thead>
				<tr> 
					<th>Products</th>
					<th>Photo Gallery</th>
					<th>Community Directory</th>
					<th>Site Admin</th>
				</tr>
			</thead>
			<tbody>
				<tr> 
					<td style="text-align:center">&nbsp;</td>
					<td style="text-align:center">&nbsp;</td>
					<td style="text-align:center">&nbsp;</td>
					<td style="text-align:center">&nbsp;</td>
				</tr>
				<tr> 
					<td style="text-align:center"><a href="/add_product.php">Add Product</a></td>
					<td style="text-align:center"><a href="/pub_photo.php">Approve Photo's</a></td>
					<td style="text-align:center">&nbsp;</td>
					<td style="text-align:center"><a href="/add_admin.php">Add Admin Users</a></td>
				</tr>
				<tr> 
					<td style="text-align:center"><a href="/edit_prod.php">Edit Product</a></td>
					<td style="text-align:center"><a href="/del_pub_photo.php">Delete Photo's</a></td>
					<td style="text-align:center">&nbsp;</td>
					<td style="text-align:center"><a href="/edit_admin.php">Edit Admin Users</a></td>
				</tr>
				<tr> 
					<td style="text-align:center">&nbsp;</td>
					<td style="text-align:center">&nbsp;</td>
					<td style="text-align:center">&nbsp;</td>
					<td style="text-align:center">&nbsp;</td>
				</tr>
				<tr> 
					<td style="text-align:center">&nbsp;</td>
					<td style="text-align:center">&nbsp;</td>
					<td style="text-align:center">&nbsp;</td>
					<td style="text-align:center"><a href="/ws_admin.php?func=all">Wholesale Administration</a></td>
				</tr>
				<tr> 
					<td style="text-align:center">&nbsp;</td>
					<td style="text-align:center">&nbsp;</td>
					<td style="text-align:center">&nbsp;</td>
					<td style="text-align:center">&nbsp;</td>
				</tr>
				<tr> 
					<td colspan="4" style="text-align:center"><a href="/index.php?id=logout">click to log out</a></td>
				</tr>
			</tbody>
		</table>
<?php
	} else {
?>
		<table cellspacing="0" class="buy_table" width="758px">
			<form method="post" action="">
				<tr> 
					<td width="40%">&nbsp;</td>
					<td width="60%"></td>
				</tr>
				<tr> 
					<td style="text-align:right">Staff ID: &nbsp;&nbsp;</td>
					<td style="text-align:left"><input type="text" name="txtstaff_id" size="30" maxlength="25" autocomplete="no" /></td>
				</tr>
				<tr> 
					<td style="text-align:right">Password: &nbsp;&nbsp;</td>
					<td style="text-align:left"><input type="password" name="txtstaff_pw" size="30" maxlength="25" /></td>
				</tr>
				<tr> 
					<td></td>
					<td><input type="submit" name="Submit" value="Login" /></td>
				</tr>
			</form>
		</table>
<?php		
	}
?>	
		</div>
<?PHP require_once("inc/footer.php") ?>
</div>
</body>
</html>