<?PHP
	session_start(); 
	
	require_once("config.php");

	If ($_SESSION['site'] == "") {
		header ("Location: /index.php");
	}

	if(isset($_POST['delx']) && $_POST['delx']) {
		$myFile = "galleries/public". $_POST['delx'];
		unlink($myFile);
		header ("Location: /del_pub_photo.php?y=".date('Y'));
	}
		

require_once("inc/headers.php");
require_once("inc/admin_css.php");
require_once("inc/site_header.php");


?>
			<table cellspacing="0" width="758px" class="buy_table">
				<thead>
						<tr> 
							<th colspan="4"><a href="/index.php">Admin Home</a></th>
						</tr>
				</thead>
				<tbody>
					<tr>
						<td colspan="4"><p style="text-align:center;">
						<?PHP 
							$Y = 2000;
							while( $Y <= date('Y') ){
								echo '<a href="?y='.$Y.'">'.$Y.'</a>&nbsp;||&nbsp;';
								$Y = $Y + 1;
							} 
						if(isset($_GET['y']) && $_GET['y'] != ''){ 
							echo '<br /><a href=\"?m=jan&y='.$_GET['y'].'">Jan</a>&nbsp;|&nbsp;
							<a href="?m=feb&y='.$_GET['y'].'">Feb</a>&nbsp;|&nbsp;
							<a href="?m=mar&y='.$_GET['y'].'">Mar</a>&nbsp;|&nbsp;
							<a href="?m=apr&y='.$_GET['y'].'">Apr</a>&nbsp;|&nbsp;
							<a href="?m=may&y='.$_GET['y'].'">May</a>&nbsp;|&nbsp;
							<a href="?m=jun&y='.$_GET['y'].'">Jun</a>&nbsp;|&nbsp;
							<a href="?m=jul&y='.$_GET['y'].'">Jul</a>&nbsp;|&nbsp;
							<a href="?m=aug&y='.$_GET['y'].'">Aug</a>&nbsp;|&nbsp;
							<a href="?m=sep&y='.$_GET['y'].'">Sep</a>&nbsp;|&nbsp;
							<a href="?m=oct&y='.$_GET['y'].'">Oct</a>&nbsp;|&nbsp;
							<a href="?m=nov&y='.$_GET['y'].'">Nov</a>&nbsp;|&nbsp;
							<a href="?m=dec&y='.$_GET['y'].'">Dec</a>'; 
						} ?>
							
						</td>
					</tr>

<?PHP
		$year = ((isset($_GET['y']) && $_GET['y'] != '' ) ? $_GET['y'] : '');
		
		$month =((isset($_GET['m']) && $_GET['m'] != '' ) ? $_GET['m'] : "all" );
		
		
		$dir1 = "galleries/public/$year/$month";


		if (is_dir($dir1)) {
			if ($dh = opendir($dir1)) {
			
				$x = 1;
				$y = 5;
				
				while (($file = readdir($dh)) !== false) {
				
					$file_name = $file;

					if ($x == $y) { echo "</tr><tr>"; $y = $y + 4;}
						if ($file_name <> "" && $file_name <> "Thumbs.db" && $file_name <> "." && $file_name<> "..") {
							echo "<td><img src=\"/galleries/public/$year/$month/$file\" alt=\"$file_name\" height=\"125\" width=\"97\" class=\"no_border\"/><form method=\"post\" action=\"/del_pub_photo.php\"><input type=\"hidden\" value=\"/$year/$month/$file\" name=\"delx\" /><input name=\"Delete\" type=\"Submit\" value=\"Delete\" /></form></td>";
							$x = $x + 1;
						}
					}
				closedir($dh);
			}
		}

?>
					</tr>
				</tbody>
			</table>


<?PHP require_once("inc/footer.php") ?>
</body>
</html>