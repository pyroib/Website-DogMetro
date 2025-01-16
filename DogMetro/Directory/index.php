<?PHP
	session_start(); 
	require_once("config.php");
	

	$con = mysqli_connect ("localhost:3306", "root", "") or die ('Error setting sql statement');
	mysqli_select_db ($con,"blottcom_dogmtro") or die ('Error setting dbname');
	
	
	require_once("inc/headers.php");
	require_once("inc/css.php");
	require_once("inc/site_header.php");	
	require_once("inc/menu.php");

?>
    <div id="main">
	
		<div  class="shop_small_img">

			<p align="center"><strong>DogMetro&trade; Dog Community Directory</strong></p>
			<p align="justify">Please browse through our community directory for dog services and associations.<br /><br />DogMetro aims to help bring the dog community together by listing responsible organisations and groups that benefit the life of both you and your dog.<br /><br />If you interested in a link to your business, service or association, please feel free to Email Us with your listing information and details!</p>
		</div>
		
		

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

	
		<div align="center">
			
			<table border="0" width="459" class="buy_table">
				<thead>
					<tr>
						<th colspan="2"><strong><a name="breeder">DogMetro&trade; Prefered Breeders</a></strong></th>
					</tr>
				</thead>
				<tbody>
					<tr><td colspan="2">&nbsp;</td></tr>
					
					<tr align="left" valign="top">
						<td width="200"><strong>NSW &amp; ACT</strong></td>
						<td align="left">
						
<?PHP	

				
		$query1  = "SELECT * FROM directory WHERE type = 'breeder' AND state = 'nsw'";
		$result1 = mysqli_query($con, $query1) or die ('failed to get product info');
		$x = 1;
		while($row1 = mysqli_fetch_array($result1))
		{
			$x = $x + 1;
			echo $row1['breed'] ." - ". $row1['contact'] ."<br /><a onmouseover=\"ShowContent('uniquename". $x ."'); return true;\" onmouseout=\"HideContent('uniquename". $x ."'); return true;\" href=\"". $row1['link'] ."\" target=\"_blank\">". $row1['link'] ."</a><br /><br /><br /><div id=\"uniquename". $x ."\" style=\"display:none; position:absolute; border-style: solid; background-color: white; padding: 5px;\">". $row1['location'] ."<br />". $row1['number'] ."<br />";
			if ($row1['logo']) { echo "<img src=\"". $row1['logo'] ."\" alt=\"". $row1['logo'] ."\" />";}
			echo "</div>";
		}
?>
						</td>
					</tr>
					
					<tr><td colspan="2">&nbsp;</td></tr>
					
					<tr align="left" valign="top">
						<td width="200"><strong>QLD</strong></td>
						<td>
<?PHP	

		$query1  = "SELECT * FROM directory WHERE type = 'breeder' AND state = 'qld'";
		$result1 = mysqli_query($con,$query1) or die ('failed to get product info');
		
		while($row1 = mysqli_fetch_array($result1))
		{
			$x = $x + 1;
			echo $row1['breed'] ." - ". $row1['contact'] ."<br /><a onmouseover=\"ShowContent('uniquename". $x ."'); return true;\" onmouseout=\"HideContent('uniquename". $x ."'); return true;\" href=\"". $row1['link'] ."\" target=\"_blank\">". $row1['link'] ."</a><br /><br /><br /><div id=\"uniquename". $x ."\" style=\"display:none; position:absolute; border-style: solid; background-color: white; padding: 5px;\">". $row1['location'] ."<br />". $row1['number'] ."<br />";
			if ($row1['logo']) { echo "<img src=\"". $row1['logo'] ."\" alt=\"". $row1['logo'] ."\" />";}
			echo "</div>";
		}
?>				
						</td>
					</tr>
					
					<tr><td colspan="2">&nbsp;</td></tr>
					
					<tr align="left" valign="top">
						<td width="200"><strong>WA</strong></td>
						<td width="219">
<?PHP	

		$query1  = "SELECT * FROM directory WHERE type = 'breeder' AND state = 'wa'";
		$result1 = mysqli_query($con,$query1) or die ('failed to get product info');
		
		while($row1 = mysqli_fetch_array($result1))
		{
			$x = $x + 1;
			echo $row1['breed'] ." - ". $row1['contact'] ."<br /><a onmouseover=\"ShowContent('uniquename". $x ."'); return true;\" onmouseout=\"HideContent('uniquename". $x ."'); return true;\" href=\"". $row1['link'] ."\" target=\"_blank\">". $row1['link'] ."</a><br /><br /><br /><div id=\"uniquename". $x ."\" style=\"display:none; position:absolute; border-style: solid; background-color: white; padding: 5px;\">". $row1['location'] ."<br />". $row1['number'] ."<br />";
			if ($row1['logo']) { echo "<img src=\"". $row1['logo'] ."\" alt=\"". $row1['logo'] ."\" />";}
			echo "</div>";
		}
?>				
						</td>
					</tr>
					
					<tr><td colspan="2">&nbsp;</td></tr>
					
					<tr align="left" valign="top">
						<td width="200"><strong>VIC</strong></td>
						<td>
<?PHP	

		$query1  = "SELECT * FROM directory WHERE type = 'breeder' AND state = 'vic'";
		$result1 = mysqli_query($con,$query1) or die ('failed to get product info');
		
		while($row1 = mysqli_fetch_array($result1))
		{
			$x = $x + 1;
			echo $row1['breed'] ." - ". $row1['contact'] ."<br /><a onmouseover=\"ShowContent('uniquename". $x ."'); return true;\" onmouseout=\"HideContent('uniquename". $x ."'); return true;\" href=\"". $row1['link'] ."\" target=\"_blank\">". $row1['link'] ."</a><br /><br /><br /><div id=\"uniquename". $x ."\" style=\"display:none; position:absolute; border-style: solid; background-color: white; padding: 5px;\">". $row1['location'] ."<br />". $row1['number'] ."<br />";
			if ($row1['logo']) { echo "<img src=\"". $row1['logo'] ."\" alt=\"". $row1['logo'] ."\" />";}
			echo "</div>";
		}
?>
						</td>
					</tr>
					
					<tr><td colspan="2">&nbsp;</td></tr>
					
					<tr align="left" valign="top">
						<td width="200"><strong>SA &amp; NT</strong></td>
						<td>
<?PHP	

		$query1  = "SELECT * FROM directory WHERE type = 'breeder' AND state = 'sa'";
		$result1 = mysqli_query($con,$query1) or die ('failed to get product info');
		
		while($row1 = mysqli_fetch_array($result1))
		{
			$x = $x + 1;
			echo $row1['breed'] ." - ". $row1['contact'] ."<br /><a onmouseover=\"ShowContent('uniquename". $x ."'); return true;\" onmouseout=\"HideContent('uniquename". $x ."'); return true;\" href=\"". $row1['link'] ."\" target=\"_blank\">". $row1['link'] ."</a><br /><br /><br /><div id=\"uniquename". $x ."\" style=\"display:none; position:absolute; border-style: solid; background-color: white; padding: 5px;\">". $row1['location'] ."<br />". $row1['number'] ."<br />";
			if ($row1['logo']) { echo "<img src=\"". $row1['logo'] ."\" alt=\"". $row1['logo'] ."\" />";}
			echo "</div>";
		}
?>
						</td>
					</tr>
				
					<tr><td colspan="2">&nbsp;</td></tr>
					
					
					<tr align="left" valign="top">
						<td width="200"><strong>TAS</strong></td>
						<td>
<?PHP	


		$query1  = "SELECT * FROM directory WHERE type = 'breeder' AND state = 'tas'";
		$result1 = mysqli_query($con,$query1) or die ('failed to get product info');
		
		while($row1 = mysqli_fetch_array($result1))
		{
			$x = $x + 1;
			echo $row1['breed'] ." - ". $row1['contact'] ."<br /><a onmouseover=\"ShowContent('uniquename". $x ."'); return true;\" onmouseout=\"HideContent('uniquename". $x ."'); return true;\" href=\"". $row1['link'] ."\" target=\"_blank\">". $row1['link'] ."</a><br /><br /><br /><div id=\"uniquename". $x ."\" style=\"display:none; position:absolute; border-style: solid; background-color: white; padding: 5px;\">". $row1['location'] ."<br />". $row1['number'] ."<br />";
			if ($row1['logo']) { echo "<img src=\"". $row1['logo'] ."\" alt=\"". $row1['logo'] ."\" />";}
			echo "</div>";
		}
?>
						</td>
					</tr>
				
					<tr><td colspan="2">&nbsp;</td></tr>
				</tbody>
			</table>
		<br /><br />
			<table border="0" width="459" class="buy_table">
				<thead>
					<tr>
						<th colspan="2"><strong><a name="clubs">DogMetro&trade; Recomended Clubs</a></strong></th>
					</tr>
				</thead>
				<tbody>
					<tr><td colspan="2">&nbsp;</td></tr>
					
					<tr align="left" valign="top">
						<td width="200"><strong>NSW &amp; ACT</strong></td>
						<td align="left">
						
<?PHP	

		$query1  = "SELECT * FROM directory WHERE type = 'clubs' AND state = 'nsw'";
		$result1 = mysqli_query($con,$query1) or die ('failed to get product info');
		
		while($row1 = mysqli_fetch_array($result1))
		{
			$x = $x + 1;
			echo $row1['breed'] ." - ". $row1['contact'] ."<br /><a onmouseover=\"ShowContent('uniquename". $x ."'); return true;\" onmouseout=\"HideContent('uniquename". $x ."'); return true;\" href=\"". $row1['link'] ."\" target=\"_blank\">". $row1['link'] ."</a><br /><br /><br /><div id=\"uniquename". $x ."\" style=\"display:none; position:absolute; border-style: solid; background-color: white; padding: 5px;\">". $row1['location'] ."<br />". $row1['number'] ."<br />";
			if ($row1['logo']) { echo "<img src=\"". $row1['logo'] ."\" alt=\"". $row1['logo'] ."\" />";}
			echo "</div>";
		}
?>
						</td>
					</tr>
					
					<tr><td colspan="2">&nbsp;</td></tr>
					
					<tr align="left" valign="top">
						<td width="200"><strong>QLD</strong></td>
						<td>
<?PHP	

		$query1  = "SELECT * FROM directory WHERE type = 'clubs' AND state = 'qld'";
		$result1 = mysqli_query($con,$query1) or die ('failed to get product info');
		
		while($row1 = mysqli_fetch_array($result1))
		{
			$x = $x + 1;
			echo $row1['breed'] ." - ". $row1['contact'] ."<br /><a onmouseover=\"ShowContent('uniquename". $x ."'); return true;\" onmouseout=\"HideContent('uniquename". $x ."'); return true;\" href=\"". $row1['link'] ."\" target=\"_blank\">". $row1['link'] ."</a><br /><br /><br /><div id=\"uniquename". $x ."\" style=\"display:none; position:absolute; border-style: solid; background-color: white; padding: 5px;\">". $row1['location'] ."<br />". $row1['number'] ."<br />";
			if ($row1['logo']) { echo "<img src=\"". $row1['logo'] ."\" alt=\"". $row1['logo'] ."\" />";}
			echo "</div>";
		}
?>				
						</td>
					</tr>
					
					<tr><td colspan="2">&nbsp;</td></tr>
					
					<tr align="left" valign="top">
						<td width="200"><strong>WA</strong></td>
						<td width="219">
<?PHP	


		$query1  = "SELECT * FROM directory WHERE type = 'clubs' AND state = 'wa'";
		$result1 = mysqli_query($con,$query1) or die ('failed to get product info');
		
		while($row1 = mysqli_fetch_array($result1))
		{
			$x = $x + 1;
			echo $row1['breed'] ." - ". $row1['contact'] ."<br /><a onmouseover=\"ShowContent('uniquename". $x ."'); return true;\" onmouseout=\"HideContent('uniquename". $x ."'); return true;\" href=\"". $row1['link'] ."\" target=\"_blank\">". $row1['link'] ."</a><br /><br /><br /><div id=\"uniquename". $x ."\" style=\"display:none; position:absolute; border-style: solid; background-color: white; padding: 5px;\">". $row1['location'] ."<br />". $row1['number'] ."<br />";
			if ($row1['logo']) { echo "<img src=\"". $row1['logo'] ."\" alt=\"". $row1['logo'] ."\" />";}
			echo "</div>";
		}
?>				
						</td>
					</tr>
					
					<tr><td colspan="2">&nbsp;</td></tr>
					
					<tr align="left" valign="top">
						<td width="200"><strong>VIC</strong></td>
						<td>
<?PHP	
	
		$query1  = "SELECT * FROM directory WHERE type = 'clubs' AND state = 'vic'";
		$result1 = mysqli_query($con,$query1) or die ('failed to get product info');
		
		while($row1 = mysqli_fetch_array($result1))
		{
			$x = $x + 1;
			echo $row1['breed'] ." - ". $row1['contact'] ."<br /><a onmouseover=\"ShowContent('uniquename". $x ."'); return true;\" onmouseout=\"HideContent('uniquename". $x ."'); return true;\" href=\"". $row1['link'] ."\" target=\"_blank\">". $row1['link'] ."</a><br /><br /><br /><div id=\"uniquename". $x ."\" style=\"display:none; position:absolute; border-style: solid; background-color: white; padding: 5px;\">". $row1['location'] ."<br />". $row1['number'] ."<br />";
			if ($row1['logo']) { echo "<img src=\"". $row1['logo'] ."\" alt=\"". $row1['logo'] ."\" />";}
			echo "</div>";
		}
?>
						</td>
					</tr>
					
					<tr><td colspan="2">&nbsp;</td></tr>
					
					<tr align="left" valign="top">
						<td width="200"><strong>SA &amp; NT</strong></td>
						<td>
<?PHP	


		$query1  = "SELECT * FROM directory WHERE type = 'clubs' AND state = 'sa'";
		$result1 = mysqli_query($con,$query1) or die ('failed to get product info');
		
		while($row1 = mysqli_fetch_array($result1))
		{
			$x = $x + 1;
			echo $row1['breed'] ." - ". $row1['contact'] ."<br /><a onmouseover=\"ShowContent('uniquename". $x ."'); return true;\" onmouseout=\"HideContent('uniquename". $x ."'); return true;\" href=\"". $row1['link'] ."\" target=\"_blank\">". $row1['link'] ."</a><br /><br /><br /><div id=\"uniquename". $x ."\" style=\"display:none; position:absolute; border-style: solid; background-color: white; padding: 5px;\">". $row1['location'] ."<br />". $row1['number'] ."<br />";
			if ($row1['logo']) { echo "<img src=\"". $row1['logo'] ."\" alt=\"". $row1['logo'] ."\" />";}
			echo "</div>";
		}
?>
						</td>
					</tr>
				
					<tr><td colspan="2">&nbsp;</td></tr>
					
					
					<tr align="left" valign="top">
						<td width="200"><strong>TAS</strong></td>
						<td>
<?PHP	
	
		$query1  = "SELECT * FROM directory WHERE type = 'clubs' AND state = 'tas'";
		$result1 = mysqli_query($con,$query1) or die ('failed to get product info');
		
		while($row1 = mysqli_fetch_array($result1))
		{
			$x = $x + 1;
			echo $row1['breed'] ." - ". $row1['contact'] ."<br /><a onmouseover=\"ShowContent('uniquename". $x ."'); return true;\" onmouseout=\"HideContent('uniquename". $x ."'); return true;\" href=\"". $row1['link'] ."\" target=\"_blank\">". $row1['link'] ."</a><br /><br /><br /><div id=\"uniquename". $x ."\" style=\"display:none; position:absolute; border-style: solid; background-color: white; padding: 5px;\">". $row1['location'] ."<br />". $row1['number'] ."<br />";
			if ($row1['logo']) { echo "<img src=\"". $row1['logo'] ."\" alt=\"". $row1['logo'] ."\" />";}
			echo "</div>";
		}
?>
						</td>
					</tr>
				
					<tr><td colspan="2">&nbsp;</td></tr>
				</tbody>
			</table>
		<br /><br />
			<table border="0" width="459" class="buy_table">
				<thead>
					<tr>
						<th colspan="2"><strong><a name="services">DogMetro&trade; Approved Services</a></strong></th>
					</tr>
				</thead>
				<tbody>
					<tr><td colspan="2">&nbsp;</td></tr>
					
					<tr align="left" valign="top">
						<td width="200"><strong>NSW &amp; ACT</strong></td>
						<td align="left">
						
<?PHP	
	
		$query1  = "SELECT * FROM directory WHERE type = 'services' AND state = 'nsw'";
		$result1 = mysqli_query($con,$query1) or die ('failed to get product info');
		
		while($row1 = mysqli_fetch_array($result1))
		{
			$x = $x + 1;
			echo $row1['breed'] ." - ". $row1['contact'] ."<br /><a onmouseover=\"ShowContent('uniquename". $x ."'); return true;\" onmouseout=\"HideContent('uniquename". $x ."'); return true;\" href=\"". $row1['link'] ."\" target=\"_blank\">". $row1['link'] ."</a><br /><br /><br /><div id=\"uniquename". $x ."\" style=\"display:none; position:absolute; border-style: solid; background-color: white; padding: 5px;\">". $row1['location'] ."<br />". $row1['number'] ."<br />";
			if ($row1['logo']) { echo "<img src=\"". $row1['logo'] ."\" alt=\"". $row1['logo'] ."\" />";}
			echo "</div>";
		}
?>
						</td>
					</tr>
					
					<tr><td colspan="2">&nbsp;</td></tr>
					
					<tr align="left" valign="top">
						<td width="200"><strong>QLD</strong></td>
						<td>
<?PHP	

		$query1  = "SELECT * FROM directory WHERE type = 'services' AND state = 'qld'";
		$result1 = mysqli_query($con,$query1) or die ('failed to get product info');
		
		while($row1 = mysqli_fetch_array($result1))
		{
			$x = $x + 1;
			echo $row1['breed'] ." - ". $row1['contact'] ."<br /><a onmouseover=\"ShowContent('uniquename". $x ."'); return true;\" onmouseout=\"HideContent('uniquename". $x ."'); return true;\" href=\"". $row1['link'] ."\" target=\"_blank\">". $row1['link'] ."</a><br /><br /><br /><div id=\"uniquename". $x ."\" style=\"display:none; position:absolute; border-style: solid; background-color: white; padding: 5px;\">". $row1['location'] ."<br />". $row1['number'] ."<br />";
			if ($row1['logo']) { echo "<img src=\"". $row1['logo'] ."\" alt=\"". $row1['logo'] ."\" />";}
			echo "</div>";
		}
?>				
						</td>
					</tr>
					
					<tr><td colspan="2">&nbsp;</td></tr>
					
					<tr align="left" valign="top">
						<td width="200"><strong>WA</strong></td>
						<td width="219">
<?PHP	


		$query1  = "SELECT * FROM directory WHERE type = 'services' AND state = 'wa'";
		$result1 = mysqli_query($con,$query1) or die ('failed to get product info');
		
		while($row1 = mysqli_fetch_array($result1))
		{
			$x = $x + 1;
			echo $row1['breed'] ." - ". $row1['contact'] ."<br /><a onmouseover=\"ShowContent('uniquename". $x ."'); return true;\" onmouseout=\"HideContent('uniquename". $x ."'); return true;\" href=\"". $row1['link'] ."\" target=\"_blank\">". $row1['link'] ."</a><br /><br /><br /><div id=\"uniquename". $x ."\" style=\"display:none; position:absolute; border-style: solid; background-color: white; padding: 5px;\">". $row1['location'] ."<br />". $row1['number'] ."<br />";
			if ($row1['logo']) { echo "<img src=\"". $row1['logo'] ."\" alt=\"". $row1['logo'] ."\" />";}
			echo "</div>";
		}
?>				
						</td>
					</tr>
					
					<tr><td colspan="2">&nbsp;</td></tr>
					
					<tr align="left" valign="top">
						<td width="200"><strong>VIC</strong></td>
						<td>
<?PHP	

		$query1  = "SELECT * FROM directory WHERE type = 'services' AND state = 'vic'";
		$result1 = mysqli_query($con,$query1) or die ('failed to get product info');
		
		while($row1 = mysqli_fetch_array($result1))
		{
			$x = $x + 1;
			echo $row1['breed'] ." - ". $row1['contact'] ."<br /><a onmouseover=\"ShowContent('uniquename". $x ."'); return true;\" onmouseout=\"HideContent('uniquename". $x ."'); return true;\" href=\"". $row1['link'] ."\" target=\"_blank\">". $row1['link'] ."</a><br /><br /><br /><div id=\"uniquename". $x ."\" style=\"display:none; position:absolute; border-style: solid; background-color: white; padding: 5px;\">". $row1['location'] ."<br />". $row1['number'] ."<br />";
			if ($row1['logo']) { echo "<img src=\"". $row1['logo'] ."\" alt=\"". $row1['logo'] ."\" />";}
			echo "</div>";
		}
?>
						</td>
					</tr>
					
					<tr><td colspan="2">&nbsp;</td></tr>
					
					<tr align="left" valign="top">
						<td width="200"><strong>SA &amp; NT</strong></td>
						<td>
<?PHP	

		$query1  = "SELECT * FROM directory WHERE type = 'services' AND state = 'sa'";
		$result1 = mysqli_query($con,$query1) or die ('failed to get product info');
		
		while($row1 = mysqli_fetch_array($result1))
		{
			$x = $x + 1;
			echo $row1['breed'] ." - ". $row1['contact'] ."<br /><a onmouseover=\"ShowContent('uniquename". $x ."'); return true;\" onmouseout=\"HideContent('uniquename". $x ."'); return true;\" href=\"". $row1['link'] ."\" target=\"_blank\">". $row1['link'] ."</a><br /><br /><br /><div id=\"uniquename". $x ."\" style=\"display:none; position:absolute; border-style: solid; background-color: white; padding: 5px;\">". $row1['location'] ."<br />". $row1['number'] ."<br />";
			if ($row1['logo']) { echo "<img src=\"". $row1['logo'] ."\" alt=\"". $row1['logo'] ."\" />";}
			echo "</div>";
		}
?>
						</td>
					</tr>
				
					<tr><td colspan="2">&nbsp;</td></tr>
					
					
					<tr align="left" valign="top">
						<td width="200"><strong>TAS</strong></td>
						<td>
<?PHP	
	
		$query1  = "SELECT * FROM directory WHERE type = 'services' AND state = 'tas'";
		$result1 = mysqli_query($con,$query1) or die ('failed to get product info');
		
		while($row1 = mysqli_fetch_array($result1))
		{
			$x = $x + 1;
			echo $row1['breed'] ." - ". $row1['contact'] ."<br /><a onmouseover=\"ShowContent('uniquename". $x ."'); return true;\" onmouseout=\"HideContent('uniquename". $x ."'); return true;\" href=\"". $row1['link'] ."\" target=\"_blank\">". $row1['link'] ."</a><br /><br /><br /><div id=\"uniquename". $x ."\" style=\"display:none; position:absolute; border-style: solid; background-color: white; padding: 5px;\">". $row1['location'] ."<br />". $row1['number'] ."<br />";
			if ($row1['logo']) { echo "<img src=\"". $row1['logo'] ."\" alt=\"". $row1['logo'] ."\" />";}
			echo "</div>";
		}
?>
						</td>
					</tr>
				
					<tr><td colspan="2">&nbsp;</td></tr>
				</tbody>
			</table>
		<br /><br />
			<table border="0" width="459" class="buy_table">
				<thead>
					<tr>
						<th colspan="2"><strong><a name="hol_centre">DogMetro&trade; Associated Holiday Centres</a></strong></th>
					</tr>
				</thead>
				<tbody>
					<tr><td colspan="2">&nbsp;</td></tr>
					
					<tr align="left" valign="top">
						<td width="200"><strong>NSW &amp; ACT</strong></td>
						<td align="left">
						
<?PHP	

		$query1  = "SELECT * FROM directory WHERE type = 'hol_centre' AND state = 'nsw'";
		$result1 = mysqli_query($con,$query1) or die ('failed to get product info');
		
		while($row1 = mysqli_fetch_array($result1))
		{
			$x = $x + 1;
			echo $row1['breed'] ." - ". $row1['contact'] ."<br /><a onmouseover=\"ShowContent('uniquename". $x ."'); return true;\" onmouseout=\"HideContent('uniquename". $x ."'); return true;\" href=\"". $row1['link'] ."\" target=\"_blank\">". $row1['link'] ."</a><br /><br /><br /><div id=\"uniquename". $x ."\" style=\"display:none; position:absolute; border-style: solid; background-color: white; padding: 5px;\">". $row1['location'] ."<br />". $row1['number'] ."<br />";
			if ($row1['logo']) { echo "<img src=\"". $row1['logo'] ."\" alt=\"". $row1['logo'] ."\" />";}
			echo "</div>";
		}
?>
						</td>
					</tr>
					
					<tr><td colspan="2">&nbsp;</td></tr>
					
					<tr align="left" valign="top">
						<td width="200"><strong>QLD</strong></td>
						<td>
<?PHP	

		$query1  = "SELECT * FROM directory WHERE type = 'hol_centre' AND state = 'qld'";
		$result1 = mysqli_query($con,$query1) or die ('failed to get product info');
		
		while($row1 = mysqli_fetch_array($result1))
		{
			$x = $x + 1;
			echo $row1['breed'] ." - ". $row1['contact'] ."<br /><a onmouseover=\"ShowContent('uniquename". $x ."'); return true;\" onmouseout=\"HideContent('uniquename". $x ."'); return true;\" href=\"". $row1['link'] ."\" target=\"_blank\">". $row1['link'] ."</a><br /><br /><br /><div id=\"uniquename". $x ."\" style=\"display:none; position:absolute; border-style: solid; background-color: white; padding: 5px;\">". $row1['location'] ."<br />". $row1['number'] ."<br />";
			if ($row1['logo']) { echo "<img src=\"". $row1['logo'] ."\" alt=\"". $row1['logo'] ."\" />";}
			echo "</div>";
		}
?>				
						</td>
					</tr>
					
					<tr><td colspan="2">&nbsp;</td></tr>
					
					<tr align="left" valign="top">
						<td width="200"><strong>WA</strong></td>
						<td width="219">
<?PHP	

		$query1  = "SELECT * FROM directory WHERE type = 'hol_centre' AND state = 'wa'";
		$result1 = mysqli_query($con,$query1) or die ('failed to get product info');
		
		while($row1 = mysqli_fetch_array($result1))
		{
			$x = $x + 1;
			echo $row1['breed'] ." - ". $row1['contact'] ."<br /><a onmouseover=\"ShowContent('uniquename". $x ."'); return true;\" onmouseout=\"HideContent('uniquename". $x ."'); return true;\" href=\"". $row1['link'] ."\" target=\"_blank\">". $row1['link'] ."</a><br /><br /><br /><div id=\"uniquename". $x ."\" style=\"display:none; position:absolute; border-style: solid; background-color: white; padding: 5px;\">". $row1['location'] ."<br />". $row1['number'] ."<br />";
			if ($row1['logo']) { echo "<img src=\"". $row1['logo'] ."\" alt=\"". $row1['logo'] ."\" />";}
			echo "</div>";
		}
?>				
						</td>
					</tr>
					
					<tr><td colspan="2">&nbsp;</td></tr>
					
					<tr align="left" valign="top">
						<td width="200"><strong>VIC</strong></td>
						<td>
<?PHP	
	
		$query1  = "SELECT * FROM directory WHERE type = 'hol_centre' AND state = 'vic'";
		$result1 = mysqli_query($con,$query1) or die ('failed to get product info');
		
		while($row1 = mysqli_fetch_array($result1))
		{
			$x = $x + 1;
			echo $row1['breed'] ." - ". $row1['contact'] ."<br /><a onmouseover=\"ShowContent('uniquename". $x ."'); return true;\" onmouseout=\"HideContent('uniquename". $x ."'); return true;\" href=\"". $row1['link'] ."\" target=\"_blank\">". $row1['link'] ."</a><br /><br /><br /><div id=\"uniquename". $x ."\" style=\"display:none; position:absolute; border-style: solid; background-color: white; padding: 5px;\">". $row1['location'] ."<br />". $row1['number'] ."<br />";
			if ($row1['logo']) { echo "<img src=\"". $row1['logo'] ."\" alt=\"". $row1['logo'] ."\" />";}
			echo "</div>";
		}
?>
						</td>
					</tr>
					
					<tr><td colspan="2">&nbsp;</td></tr>
					
					<tr align="left" valign="top">
						<td width="200"><strong>SA &amp; NT</strong></td>
						<td>
<?PHP	

		$query1  = "SELECT * FROM directory WHERE type = 'hol_centre' AND state = 'sa'";
		$result1 = mysqli_query($con,$query1) or die ('failed to get product info');
		
		while($row1 = mysqli_fetch_array($result1))
		{
			$x = $x + 1;
			echo $row1['breed'] ." - ". $row1['contact'] ."<br /><a onmouseover=\"ShowContent('uniquename". $x ."'); return true;\" onmouseout=\"HideContent('uniquename". $x ."'); return true;\" href=\"". $row1['link'] ."\" target=\"_blank\">". $row1['link'] ."</a><br /><br /><br /><div id=\"uniquename". $x ."\" style=\"display:none; position:absolute; border-style: solid; background-color: white; padding: 5px;\">". $row1['location'] ."<br />". $row1['number'] ."<br />";
			if ($row1['logo']) { echo "<img src=\"". $row1['logo'] ."\" alt=\"". $row1['logo'] ."\" />";}
			echo "</div>";
		}
?>
						</td>
					</tr>
				
					<tr><td colspan="2">&nbsp;</td></tr>
					
					
					<tr align="left" valign="top">
						<td width="200"><strong>TAS</strong></td>
						<td>
<?PHP	
	
		$query1  = "SELECT * FROM directory WHERE type = 'hol_centre' AND state = 'tas'";
		$result1 = mysqli_query($con,$query1) or die ('failed to get product info');
		
		while($row1 = mysqli_fetch_array($result1))
		{
			$x = $x + 1;
			echo $row1['breed'] ." - ". $row1['contact'] ."<br /><a onmouseover=\"ShowContent('uniquename". $x ."'); return true;\" onmouseout=\"HideContent('uniquename". $x ."'); return true;\" href=\"". $row1['link'] ."\" target=\"_blank\">". $row1['link'] ."</a><br /><br /><br /><div id=\"uniquename". $x ."\" style=\"display:none; position:absolute; border-style: solid; background-color: white; padding: 5px;\">". $row1['location'] ."<br />". $row1['number'] ."<br />";
			if ($row1['logo']) { echo "<img src=\"". $row1['logo'] ."\" alt=\"". $row1['logo'] ."\" />";}
			echo "</div>";
		}
?>
						</td>
					</tr>
				
					<tr><td colspan="2">&nbsp;</td></tr>
				</tbody>
			</table>
		</div>
    </div>
<?PHP require_once("inc/footer.php") ?>

</body>
</html>