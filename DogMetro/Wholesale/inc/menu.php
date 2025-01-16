    <div id="sidebar">
              <table width="100%" border="0" height="25" cellpadding="0" cellspacing="0" class="menu" style=" border: 0px;">
<?php	

	$con = mysqli_connect ("localhost:3306", "root", "") or die ('Error setting sql statement');
	mysqli_select_db ($con,"blottcom_dogmtro") or die ('Error setting dbname');
	
		
	$prod_select = (isset($_GET['prod']) ? $_GET['prod'] : '' );
	$menu_cat = (isset($_GET['menuid']) ? $_GET['menuid'] : '' );

	$location = (isset($_GET['loc']) ? $_GET['loc'] : 'aAUu');
	
		
		$query1  = "SELECT * FROM menu ORDER BY men_order";
		$result1 = mysqli_query($con, $query1) or die ('Error setting result1');
		while($row1 = mysqli_fetch_array($result1))
		{
			echo "<tr><td height=\"25\"><a href=\"/index.php?menuid=".$row1['menu_id']."&prod=".$prod_select."&loc=".$location."\">".$row1['menu_name']."</a></td></tr>";
			
			$query2  = "SELECT * FROM products ORDER BY id";
			$result2 = mysqli_query($con, $query2) or die ('product data retrieval failed');
		
			while($row2 = mysqli_fetch_array($result2)) {
			
				$all_specials =  $row2['special'];
				list($au_spec, $uk_spec, $us_spec) = explode(',', $all_specials);

				if ($location == "AU") {$spec_id = $au_spec;} else
				if ($location == "GB") {$spec_id = $uk_spec;} else
				if ($location == "US") {$spec_id = $us_spec;} else
				{
					$spec_id = $au_spec;
					$location = "AU";
				}

				if ($row2['prod_cat'] == $row1['menu_id'] AND $row2['prod_cat'] == $menu_cat) {
					if ($location =="AU" AND $row2['au_price'] <> "") {
						echo "<tr><td height=\"25\" style=\"background: #bbbbbb;\"><a href=\"/index.php?menuid=".$row1['menu_id']."&prod=".$row2['id']."&loc=".$location."\">".$row2['name']."</a></td></tr>";
					} else if ($location =="GB" AND $row2['uk_price'] <> "") {
						echo "<tr><td height=\"25\" style=\"background: #bbbbbb;\"><a href=\"/index.php?menuid=".$row1['menu_id']."&prod=".$row2['id']."&loc=".$location."\">".$row2['name']."</a></td></tr>";
					} else if ($location =="US" AND $row2['us_price'] <> "") {
						echo "<tr><td height=\"25\" style=\"background: #bbbbbb;\"><a href=\"/index.php?menuid=".$row1['menu_id']."&prod=".$row2['id']."&loc=".$location."\">".$row2['name']."</a></td></tr>";
					}
				} else if ($row1['menu_id'] == "specials" AND $spec_id <> "" AND $menu_cat == "specials") {
					echo "<tr><td height=\"25\" style=\"background: #bbbbbb;\"><a href=\"/index.php?menuid=".$row1['menu_id']."&prod=".$row2['id']."&loc=".$location."\">".$row2['name']."</a></td></tr>";
				} else if ($row1['menu_id'] == "gifts" AND $row2['gift_idea'] == "yes" AND $menu_cat == "gifts") {
					echo "<tr><td height=\"25\" style=\"background: #bbbbbb;\"><a href=\"/index.php?menuid=".$row1['menu_id']."&prod=".$row2['id']."&loc=".$location."\">".$row2['name']."</a></td></tr>";
				}
			}
		}
?>
              </table>
    </div>