    <div id="sidebar">
              <table width="100%" border="0" height="25" cellpadding="0" cellspacing="0" class="menu" style=" border: 0px;">
<?php	

	mysql_connect ("localhost:3306", "blottcom_dogmtro", "pass1word") or die ('Error setting sql statement');
	mysql_select_db ("blottcom_dogmetro") or die ('Error setting dbname');

		$prod_select = $_GET['prod'];
		$menu_cat = $_GET['menuid'];
		
		
		$query1  = "SELECT * FROM menu ORDER BY men_order";
		$result1 = mysql_query($query1) or die ('Error setting result1');
		while($row1 = mysql_fetch_array($result1))
		{
			echo "<tr><td height=\"25\"><a href=\"/index.php?menuid=".$row1['menu_id']."&prod=".$prod_select."&loc=".$location."\">".$row1['menu_name']."</a></td></tr>";
			
			$query2  = "SELECT * FROM products ORDER BY id";
			$result2 = mysql_query($query2) or die ('product data retrieval failed');
		
			while($row2 = mysql_fetch_array($result2)) {

				if ($row2['prod_cat'] == $row1['menu_id'] AND $row2['prod_cat'] == $menu_cat) {
					if ($row2['wholesale_price'] <> "" AND $row2['wholesale_price'] <> "00.00") {
						echo "<tr><td height=\"25\" style=\"background: #bbbbbb;\"><a href=\"/index.php?menuid=".$row1['menu_id']."&prod=".$row2['id']."&loc=".$location."\">".$row2['name']."</a></td></tr>";
					}
				}
			}
		}
?>
              </table>
    </div>