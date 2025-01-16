<?php
	session_start(); 
	
	if ($_GET[id] == "logout") {
		session_destroy();
	}

	mysql_connect ("localhost:3306", "daniel_metrotest", "123456") or die ('Error setting sql statement');
	mysql_select_db ("daniel_metroshop") or die ('Error setting dbname');
	
	$former = $_POST[Submit];
	$bad_chars = array("'", "\"", "`", "(", ")", ".");
	
	if ($former == "Login") {

		$wholesale_id = $_POST["ws_id"];
		$wholesale_id = strtolower($wholesale_id);
		$wholesale_id = str_replace($bad_chars, '', $wholesale_id);
		
		$wholesale_pw = $_POST["ws_pw"];
		$wholesale_pw = strtolower($wholesale_pw);
		$wholesale_pw = str_replace($bad_chars, '', $wholesale_pw);
		$wholesale_pw = MD5($wholesale_pw);


		$query1  = "SELECT * FROM ws_user WHERE id_tag = '$wholesale_id' AND p_word = '$wholesale_pw' AND site_app = 'yes'";
		$result1 = mysql_query($query1) or die ('Error setting result1');
		
		while($row1 = mysql_fetch_array($result1)) {
			if ($row1['id_tag']) {
				$_SESSION['wholesale'] = $row1['id_tag'];
				$_SESSION['price'] = $row1['price_app'];
				header ("Location: /index.php");
			}
		}
	}	
	
	include("headers.php");
	include("css.php");
	include("site_header.php");	
?>
		<div class="middle">
<?php
		include("ws_front.php");
?>	
		</div>
<? include("footer.php") ?>
</div>
</body>
</html>