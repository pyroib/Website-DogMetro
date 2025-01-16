<?PHP
	session_start(); 
	require_once("config.php");
	

	$con = mysqli_connect ("localhost:3306", "root", "") or die ('Error setting sql statement');
	mysqli_select_db ($con,"blottcom_dogmtro") or die ('Error setting dbname');
	
	
	require_once("inc/headers.php");
	require_once("inc/css.php");
	require_once("inc/site_header.php");	


?>
<div align="center" style="padding-bottom:20px;"><img src="/images/site/bw_dm.jpg" ></div>

<div align="center">

<script type="text/javascript" language="JavaScript">
<!-- Copyright 2006,2007 Bontrager Connection, LLC
// http://bontragerconnection.com/ and http://willmaster.com/
// Version: July 28, 2007

// Modified for Dogmetro by Ian Blott of http://iblott.com
// August 22, 2007

var cX = 0; var cY = 0; var rX = 0; var rY = 0;
function UpdateCursorPosition(e){ cX = e.pageX; cY = e.pageY;}
function UpdateCursorPositionDocAll(e){ cX = event.clientX; cY = event.clientY;}
if(document.all) { document.onmousemove = UpdateCursorPositionDocAll; }
else { document.onmousemove = UpdateCursorPosition; }
function AssignPosition(d) {
if(self.pageYOffset) {
	rX = self.pageXOffset;
	rY = self.pageYOffset;
	}
else if(document.documentElement && document.documentElement.scrollTop) {
	rX = document.documentElement.scrollLeft;
	rY = document.documentElement.scrollTop;
	}
else if(document.body) {
	rX = document.body.scrollLeft;
	rY = document.body.scrollTop;
	}
if(document.all) {
	cX += rX; 
	cY += rY;
	}
d.style.left = (cX+10) + "px";
d.style.top = (cY+10) + "px";
}
function HideContent(d) {
if(d.length < 1) { return; }
document.getElementById(d).style.display = "none";
}
function ShowContent(d) {
if(d.length < 1) { return; }
var dd = document.getElementById(d);
AssignPosition(dd);
dd.style.display = "block";
}
function ReverseContentDisplay(d) {
if(d.length < 1) { return; }
var dd = document.getElementById(d);
AssignPosition(dd);
if(dd.style.display == "none") { dd.style.display = "block"; }
else { dd.style.display = "none"; }
}
//-->
</script>


	<table width="459px">
		<tr>
<?PHP
		
		$gal_year = (isset($_GET['y']) ? $_GET['y'] : date('Y'));
		$gal_month = (isset($_GET['m']) ? $_GET['m'] : date('M'));

			
		$dir = "images/public/" .$gal_year ."/". $gal_month;

		if (is_dir($dir)) {
			if ($dh = opendir($dir)) {
			
				$x = 1;
				$y = 5;
				
				while (($file = readdir($dh)) !== false) {
				
					$bad_chars = array(".jpg",".gif", "best", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "january", "february", "march", "april", "may", "jun", "july", "august", "september", "october", "november", "december", ".", "..", "_");
				
					$file_name = $file;
					$file_name = strtolower($file_name);
					$file_name = str_replace($bad_chars, '', $file_name);
					$file_name = str_replace("&", ' & ', $file_name);

					if ($x == $y) { echo "</tr><tr>"; $y = $y + 4;}
						if ($file_name <> "" && $file_name <> "Thumbs.db") {
							$x = $x + 1;
							echo "<td align=\"center\"><a onmouseover=\"ShowContent('uniquename$x'); return true;\" 
							onmouseout=\"HideContent('uniquename". $x ."'); return true;\" 
							href=\"javascript:ShowContent('uniquename". $x ."')\">
							<img src=\"$dir/$file\" alt=\"$file_name\" class=\"no_border\" />
							</a>
							<div id=\"uniquename". $x ."\" style=\"display:none; position:absolute; border-style: solid; background-color: white; padding: 5px;\">
							<img src=\"$dir/$file\" alt=\"$file_name\" /><br />". $file_name ."</div><br />$file_name</td>";
						}
					}
				closedir($dh);
			}
		}

?>
		</tr>
	</table>
</div>

<?PHP require_once("inc/footer.php") ?>

</body>
</html>