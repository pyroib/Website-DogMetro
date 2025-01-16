<?php
	session_start(); 
	
	require_once("config.php");

	If ($_SESSION['site'] == "") {
		header ("Location: /index.php");
	}
	
	if (isset($_GET['id']) && $_GET['id']== "logout") {
		session_destroy();
		header ("Location: /index.php");
	}

	$app_1  ='';

	if (isset($_POST['Submit']) && $_POST['Submit']) {

		$app_1 = (isset($_POST['approve1']) ? $_POST['approve1'] : '' );
	}

	if($app_1 != '')
	{

			$source = "galleries/tba/$app_1";
			
			if(!is_dir("galleries/public/".date('y')."/") ) mkdir("galleries/public/".date('y')."", 0777);
			if(!is_dir("galleries/public/".date('y')."/all/") ) mkdir("galleries/public/".date('y')."/all/", 0777);
			
			$destination = "galleries/public/".date('y')."/all/$app_1";
					
			if(copy($source, $destination)) {
				$myFile = "galleries/tba/$app_1";
				unlink($myFile);
				header ("Location: /pub_photo.php");
			} else {
				echo "The specified file could not be copied. Please try again.", "\n";
			}
	
			
	} else {
	
	require_once("inc/headers.php");
	require_once("inc/admin_css.php");
	require_once("inc/site_header.php");	
?>

	<div align="center">
		<table cellspacing="0" class="buy_table" width="758px">
			<thead><tr><th><a href="/index.php">Admin Home</a></th></tr></thead>
		</table>
		<table cellspacing="0" class="buy_table" width="758px">
			<tbody>
				<form action="/pub_photo.php" method="POST">
					<tr>
<?PHP	
			
		$dir = "galleries/tba";
		$x = 1;
		$y = 5;
		if (is_dir($dir)) {
		
			if ($dh = opendir($dir)) {
			

				
				while (($file = readdir($dh)) !== false) {
							
					$file_name = $file;
					$file_name = strtolower($file_name);

					if ($x == $y) { echo "</tr><tr>"; $y = $y + 4;}
					
					if ($file_name <> "" && $file_name <> "." && $file_name <> ".." && $file_name <> "Thumbs.db") {
						echo "<td style=\"text-align:center; padding-top:10px; \"><img src=\"/galleries/tba/$file\" alt=\"$file_name\" width=\"150\" /><br />
						Approve<input name=\"approve$x\" type=\"radio\" value=\"$file\"></td>";
						$x = $x + 1;
					}
				}
				closedir($dh);
			}
		}

?>
					</tr>
					<tr>
						<td align="center" colspan="4"><input type="hidden" value="<?PHP $x = $x -1; echo $x; ?>" name="maxout"><input type="Submit" name="Submit" value="Submit" /></td>
					</tr>
				</form>
			</tbody>
		</table>
	</div>
<?PHP
	require_once("inc/footer.php");
	}
?>
</div>
</body>
</html>