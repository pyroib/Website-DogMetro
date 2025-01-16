<?PHP
	session_start(); 
	require_once("config.php");
	

	$con = mysqli_connect ("localhost:3306", "root", "") or die ('Error setting sql statement');
	mysqli_select_db ($con,"blottcom_dogmtro") or die ('Error setting dbname');
	
	
	require_once("inc/headers.php");
	require_once("inc/css.php");
	require_once("inc/ws_header.php");	
	require_once("inc/menu.php");

	if (isset($_GET['id']) && $_GET['id'] == "logout") {
		session_destroy();
		header ("Location: /index.php");
	}
		
	if (isset($_SESSION['wholesale']) && $_SESSION['wholesale'] == "") {
		echo $_SESSION['wholesale'];
		header ("Location: /login.php");
	}

?>
    <div id="main">
<?php
	if ($prod_select){
		
		$query3  = "SELECT * FROM products WHERE id = $prod_select";
		$result3 = mysqli_query($con, $query3) or die ('failed to get product info');
		while($row3 = mysqli_fetch_array($result3)) {	
			
			$stock_query = $row3['instock'];
			list($xs_stock, $s_stock, $m_stock, $l_stock, $xl_stock, $xxl_stock) = explode(',', $stock_query);

				echo "<span class=\"item_title\"> ".$row3['name']."</span><br /><br />";
				echo "<span><img src=\"".SITE_DOMAIN . $row3['img1']."\" alt=\"\" class=\"item_img1\" /></span><br />";
				echo "<span class=\"item_colour_title\">Colours Available</span> - <span class=\"item_colour_text\">".$row3['colour']."</span><br /><br />";
				if ($row3['img3'] <> "/images/products/blank_colours.jpg") {
					echo "<span><img src=\"".SITE_DOMAIN . $row3['img3']."\" alt=\"\" class=\"item_img3\" /></span><br />";
				}
				echo "<div class=\"item_descrip\">".$row3['descrip']."</div><br /><br />";

				if (isset($row3['wholesale_code']) && $row3['wholesale_code'] != '' && $row3['wholesale_code']){
					echo "<h1>Wholesale Code - ". $row3['wholesale_code'] ."</h1>";
					if (isset($row3['price_app']) && $row3['price_app'] != '' && $row3['price_app']){
						echo "<h1>Wholesale Price - AUD \$". $row3['wholesale_price'] ."</h1>";
					}
				}
		}
	} else {
		require_once("inc/ws_open.php");
	}
?>	
    </div>
<?PHP require_once("inc/footer.php") ?>

</body>
</html>