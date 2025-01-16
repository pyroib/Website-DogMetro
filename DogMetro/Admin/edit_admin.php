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
	

	$del = (isset($_GET['deladmin']) && $_GET['deladmin']!='');

	if ($del != ''){
		mysqli_query($con, "DELETE FROM users WHERE username = '$del'");
		header ("Location: /edit_admin.php");
	}


	$query1  = "SELECT * FROM users";
	$result1 = mysqli_query($con, $query1) or die ('Error setting result1');

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
							<td>Select which account you would like to edit</td>
							<td>NOTE: Deleting an account will remove it <strong>permanently</strong></td>
						</tr>
	
	<?php
			while($row1 = mysqli_fetch_array( $result1)) {
					// echo "<tr><td><form method=\"post\" action=\"/edit_admin.php?deladmin=".$row1['username']."\">".$row1['username']."</td><td><input name=\"Delete\" type=\"Submit\" value=\"Delete\" /></form></td></tr>";
					echo "<tr>
							<td><form method=\"post\" action=\"\">".$row1['username']."</td>
							<td><input name=\"Delete\" type=\"Submit\" value=\"Delete\" onclick=\"alert('Function Disabled');\" /></form></td>
						</tr>";
			}
	?>


					</tbody>
				</form>
			</table>
		</div>

<?PHP require_once("inc/footer.php") ?>
</div>
</body>
</html>