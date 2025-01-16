<?PHP
	session_start(); 
	require_once("config.php");
	

	$con = mysqli_connect ("localhost:3306", "root", "") or die ('Error setting sql statement');
	mysqli_select_db ($con,"blottcom_dogmtro") or die ('Error setting dbname');
	
	
	require_once("inc/headers.php");
	require_once("inc/css.php");
	require_once("inc/site_header.php");	
	require_once("inc/menu.php");

	
	$prod_select = (isset($_GET['prod']) ? $_GET['prod'] : '' );
	$location = (isset($_GET['loc']) ? $_GET['loc'] : 'aAUu');
	
?>
    <div id="main">
<?php
	if ($prod_select){
	
		$query3  = "SELECT * FROM products WHERE id = $prod_select";
		$result3 = mysqli_query($con, $query3) or die ('failed to get product info');
		
		while($row3 = mysqli_fetch_array($result3))
		{
			$layout_num = $row3['layout'];
			
			$stock_query = $row3['instock'];
			list($xs_stock, $s_stock, $m_stock, $l_stock, $xl_stock, $xxl_stock) = explode(',', $stock_query);

			$stock_xs =  $row3['xsmall'];
			list($xs_neck, $xs_chest, $xs_n2t) = explode(',', $stock_xs);

			$stock_s =  $row3['small'];
			list($s_neck, $s_chest, $s_n2t) = explode(',', $stock_s);
			
			$stock_m =  $row3['med'];
			list($m_neck, $m_chest, $m_n2t) = explode(',', $stock_m);
			
			$stock_l =  $row3['large'];
			list($l_neck, $l_chest, $l_n2t) = explode(',', $stock_l);
			
			$stock_xl =  $row3['xlarge'];
			list($xl_neck, $xl_chest, $xl_n2t) = explode(',', $stock_xl);
			
			$stock_xxl =  $row3['xxlarge'];
			list($xxl_neck, $xxl_chest, $xxl_n2t) = explode(',', $stock_xxl);
			

			if( isset($row3['colour']) && $row3['colour']!= '' && str_contains($row3['colour'], "/") ){
				
				$colour_aval = explode("/", $row3['colour']);

			} else {
				$colour_aval = $row3['colour'];
			}
	
			if ($layout_num == "1") {
//*************************************************** layout 1 start ************************************************************
				
				echo "<span class=\"item_title\"> ".$row3['name']."</span><br /><br />";
				echo "<span><img src=\"".$row3['img1']."\" alt=\"\" class=\"item_img1\" /></span><br />";
				echo "<span><img src=\"".$row3['img2']."\" alt=\"\" class=\"item_img2\" /></span><br />";
				echo "<span class=\"item_colour_title\">Colours Available</span> - <span class=\"item_colour_text\">".$row3['colour']."</span><br />";
				echo "<span><img src=\"".$row3['img3']."\" alt=\"\" class=\"item_img3\" /></span><br />";
				echo "<div class=\"item_descrip\">".$row3['descrip']."</div><br /><br />";
?>
		<div class="middle">
		<br /><br /><br /><br /><br />
<?php
require_once("inc/price_box.php");
?>
		<br /><br />
			<table cellspacing="0" class="buy_table" width="350px" align="center" >
				<thead>
					<tr>
						<th class="Corner" colspan="4">
<?php
				if ($location == "GB") {
					echo "You are shoping with "; ?>&pound;<?php echo "UK Pounds";
					} else if ($location == "AU") {
					echo "You are shoping with \$AU";
					} else if ($location == "US") {
					echo "You are shoping with \$US ";
					} else {
					echo "";
				}
?>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
							<input type="hidden" name="add" value="1">
							<input type="hidden" name="cmd" value="_cart">
							<input type="hidden" name="business" value="sales@dogmetro.com">
							<input type="hidden" name="item_name" value="<?php echo $row3['name'] ?>">
<?php
require_once("inc/price_check.php");
?>       
							<input type="hidden" name="no_shipping" value="2">
							<input type="hidden" name="return" value="http://shop.dogmetro.com.au">
							<input type="hidden" name="currency_code" value="<?php if ($location == "GB") { echo "GBP"; } else if ($location == "AU") { echo "AUD"; } else { echo "USD"; } ?>">
							<input type="hidden" name="lc" value="<?php if ($location == "GB") { echo "GB"; } else if ($location == "AU") { echo "AU"; } else { echo "US"; } ?>">
							<input type="hidden" name="bn" value="PP-ShopCartBF">
							<input type="hidden" name="on0" value="Size">
							<th>Size<img alt="" border="0" src="https://www.paypal.com/en_AU/i/scr/pixel.gif" width="1" height="1"></th>
							<td>
								<input type="hidden" name="on0" value="Size">		
								<select name="os0">
									<?php if($xs_stock == "Y") { echo  "<option value=\"Extra Small\">Extra Small</option>"; }?>
									<?php if($s_stock == "Y") { echo  "<option value=\"Small\">Small</option>"; }?>
									<?php if($m_stock == "Y") { echo  "<option value=\"Medium\">Medium</option>"; }?>
									<?php if($l_stock == "Y") { echo  "<option value=\"Large\">Large</option>"; }?>
									<?php if($xl_stock == "Y") { echo  "<option value=\"Extra Large\">Extra Large</option>"; }?>
									<?php if($xxl_stock == "Y") { echo  "<option value=\"Extra Extra Large\">Extra Extra Large</option>"; }?>
								</select>
							</td>
							<th>Colour</th>
							<td>
								<input type="hidden" name="on1" value="Colour">
								<select name="os1">
									<?php 
										if( is_array($colour_aval) ){
											foreach($colour_aval as $c) {
												echo  '<option value="'.$c.'">'.$c.'</option>';
											}
										} else {
											echo  '<option value="'.$colour_aval.'">'.$colour_aval.'</option>';
										}
									?>
								</select>	
							</td>
					</tr>
					<tr>
							<td colspan="2">
								<input type="image" src="/images/site/add_2_basket.jpg" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!" />
							</form>
							</td>
							<td colspan="2">
							<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
								<input type="hidden" name="cmd" value="_cart">
								<input type="hidden" name="business" value="sales@dogmetro.com">
								<input type="hidden" name="display" value="1">
								<input type="image" src="/images/site/view_basket.jpg" border="0" name="submit" alt="Click Here to View Your Shopping Basket" />
							</form>
							</td>
					</tr>
				</tbody>
			</table>
		
			<br /><br /><br />
		
			<table cellspacing='0' class="size_table" width="350px" align="center">
				<thead>
					<tr>
						<th class="Corner">Measurements</th>
						<th>XS</th>
						<th>S</th>
						<th>M</th>
						<th>L</th>
						<th>XL</th>
						<th>XXL</th>
<?php
				if ($row3['img4']){
					echo "<th></th>";
				}
?>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th>Neck</th>
						<td><?php if($xs_neck) { echo  "$xs_neck cm"; }?></td>
						<td><?php if($s_neck) { echo  "$s_neck cm"; }?></td>
						<td><?php if($m_neck) { echo  "$m_neck cm"; }?></td>
						<td><?php if($l_neck) { echo  "$l_neck cm"; }?></td>
						<td><?php if($xl_neck) { echo  "$xl_neck cm"; }?></td>
						<td><?php if($xxl_neck) { echo  "$xxl_neck cm"; }?></td>		
<?php
				if ($row3['img4']){
					echo "<td rowspan=\"4\"><img src=\"/".$row3['img4']."\" alt=\"\" class=\"Size Guide\" /></td>";
				} else {;}
?>
					</tr>
					<tr>
						<th>Chest</th>
						<td><?php if($xs_chest) { echo  "$xs_chest cm"; }?></td>
						<td><?php if($s_chest) { echo  "$s_chest cm"; }?></td>
						<td><?php if($m_chest) { echo  "$m_chest cm"; }?></td>
						<td><?php if($l_chest) { echo  "$l_chest cm"; }?></td>
						<td><?php if($xl_chest) { echo  "$xl_chest cm"; }?></td>
						<td><?php if($xxl_chest) { echo  "$xxl_chest cm"; }?></td>
					</tr>
					<tr>
						<th>Neck to tail</th>
						<td><?php if($xs_n2t) { echo  "$xs_n2t cm"; }?></td>
						<td><?php if($s_n2t) { echo  "$s_n2t cm"; }?></td>
						<td><?php if($m_n2t) { echo  "$m_n2t cm"; }?></td>
						<td><?php if($l_n2t) { echo  "$l_n2t cm"; }?></td>
						<td><?php if($xl_n2t) { echo  "$xl_n2t cm"; }?></td>
						<td><?php if($xxl_n2t) { echo  "$xxl_n2t cm"; }?></td>
					</tr>
					<tr>
						<th>In Stock</th>
						<td><?php echo  $xs_stock; ?></td>
						<td><?php echo  $s_stock; ?></td>
						<td><?php echo  $m_stock; ?></td>
						<td><?php echo  $l_stock; ?></td>
						<td><?php echo  $xl_stock; ?></td>
						<td><?php echo  $xxl_stock; ?></td>
					</tr>
				</tbody>
			</table>
		</div>
<?php
//*************************************************** layout 1 finish************************************************************
			} else if ($layout_num == "2") {
//*************************************************** layout 2 start ************************************************************

				
				echo "<span class=\"item_title\"> ".$row3['name']."</span><br /><br />";
				echo "<span><img src=\"".$row3['img1']."\" alt=\"\" class=\"layout2_item_img1\" /></span>";
				echo "<span class=\"item_colour_title\">Colours Available</span> - <span class=\"item_colour_text\">".$row3['colour']."</span><br /><br />";
				echo "<div class=\"item_descrip\">".$row3['descrip']."</div><br /><br />";
?>
		<div class="middle">
		
<?php
require_once("inc/price_box.php");
?>
			<br /><br /><br />
			<table cellspacing="0" class="buy_table" align="center" width="350px">
				<thead>
					<tr>
						<th class="Corner" colspan="4">
<?php
				if ($location == "GB") {
					echo "You are shoping with "; ?>&pound;<?php echo "UK Pounds";
					} else if ($location == "AU") {
					echo "You are shoping with \$AU";
					} else if ($location == "US") {
					echo "You are shoping with \$US ";
					} else {
					echo "";
				}
?>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
							<input type="hidden" name="add" value="1">
							<input type="hidden" name="cmd" value="_cart">
							<input type="hidden" name="business" value="sales@dogmetro.com">
							<input type="hidden" name="item_name" value="<?php echo $row3['name'] ?>">
<?php
require_once("inc/price_check.php");
?>     
							<input type="hidden" name="no_shipping" value="2">
							<input type="hidden" name="return" value="http://shop.dogmetro.com.au">
							<input type="hidden" name="currency_code" value="<?php if ($location == "GB") { echo "GBP"; } else if ($location == "AU") { echo "AUD"; } else { echo "USD"; } ?>">
							<input type="hidden" name="lc" value="<?php if ($location == "GB") { echo "GB"; } else if ($location == "AU") { echo "AU"; } else { echo "US"; } ?>">
							<input type="hidden" name="bn" value="PP-ShopCartBF">
							<input type="hidden" name="on0" value="Size">
							<th>Size<img alt="" border="0" src="https://www.paypal.com/en_AU/i/scr/pixel.gif" width="1" height="1"></th>
							<td>
								<input type="hidden" name="on0" value="Size">		
								<select name="os0">
									<?php if($xs_stock == "Y") { echo  "<option value=\"Extra Small\">Extra Small</option>"; }?>
									<?php if($s_stock == "Y") { echo  "<option value=\"Small\">Small</option>"; }?>
									<?php if($m_stock == "Y") { echo  "<option value=\"Medium\">Medium</option>"; }?>
									<?php if($l_stock == "Y") { echo  "<option value=\"Large\">Large</option>"; }?>
									<?php if($xl_stock == "Y") { echo  "<option value=\"Extra Large\">Extra Large</option>"; }?>
									<?php if($xxl_stock == "Y") { echo  "<option value=\"Extra Extra Large\">Extra Extra Large</option>"; }?>
								</select>
							</td>
							<th>Colour</th>
							<td>
								<input type="hidden" name="on1" value="Colour">
								<select name="os1">
									<?php if($col_1) { echo  "<option value=\"$col_1\">$col_1</option>"; }?>
									<?php if($col_2) { echo  "<option value=\"$col_2\">$col_2</option>"; }?>
									<?php if($col_3) { echo  "<option value=\"$col_3\">$col_3</option>"; }?>
									<?php if($col_4) { echo  "<option value=\"$col_4\">$col_4</option>"; }?>
									<?php if($col_5) { echo  "<option value=\"$col_5\">$col_5</option>"; }?>
								</select>	
							</td>
					</tr>
					<tr>
							<td colspan="2">
								<input type="image" src="/images/site/add_2_basket.jpg" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!" />
							</form>
							</td>
							<td colspan="2">
								<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
									<input type="hidden" name="cmd" value="_cart">
									<input type="hidden" name="business" value="sales@dogmetro.com">
									<input type="hidden" name="display" value="1">
									<input type="image" src="/images/site/view_basket.jpg" border="0" name="submit" alt="Click Here to View Your Shopping Basket" />
								</form>
							</td>
					</tr>
				</tbody>
			</table>
		</div>
<?php
//*************************************************** layout 2 finish ************************************************************
			} else if ($layout_num == "3") {
//*************************************************** layout 3 Start *************************************************************
				
				echo "<span class=\"item_title\"> ".$row3['name']."</span><br /><br />";
				echo "<span><img src=\"".$row3['img1']."\" alt=\"\" class=\"layout2_item_img1\" /></span>";
				echo "<span class=\"item_colour_title\">Colours Available</span> - <span class=\"item_colour_text\">".$row3['colour']."</span><br /><br />";
				echo "<div class=\"item_descrip\">".$row3['descrip']."</div><br /><br />";
?>
		<div class="middle">
		
<?php
require_once("inc/price_box.php");
?>
			<br /><br /><br />
			<table cellspacing="0" class="buy_table" align="center" width="350px">
				<thead>
					<tr>
						<th class="Corner" colspan="4">
<?php
				if ($location == "GB") {
					echo "You are shoping with "; ?>&pound;<?php echo "UK Pounds";
					} else if ($location == "AU") {
					echo "You are shoping with \$AU";
					} else if ($location == "US") {
					echo "You are shoping with \$US ";
					} else {
					echo "";
				}
?>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
							<input type="hidden" name="add" value="1">
							<input type="hidden" name="cmd" value="_cart">
							<input type="hidden" name="business" value="sales@dogmetro.com">
							<input type="hidden" name="item_name" value="<?php echo $row3['name'] ?>">
<?php
require_once("inc/price_check.php");
?>      
							<input type="hidden" name="no_shipping" value="2">
							<input type="hidden" name="return" value="http://shop.dogmetro.com.au">
							<input type="hidden" name="currency_code" value="<?php if ($location == "GB") { echo "GBP"; } else if ($location == "AU") { echo "AUD"; } else { echo "USD"; } ?>">
							<input type="hidden" name="lc" value="<?php if ($location == "GB") { echo "GB"; } else if ($location == "AU") { echo "AU"; } else { echo "US"; } ?>">
							<input type="hidden" name="bn" value="PP-ShopCartBF">
							<input type="hidden" name="on0" value="Size">
							<td colspan="2">
								<input type="image" src="/images/site/add_2_basket.jpg" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!" />
							</form>
							</td>
							<td colspan="2">
								<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
									<input type="hidden" name="cmd" value="_cart">
									<input type="hidden" name="business" value="sales@dogmetro.com">
									<input type="hidden" name="display" value="1">
									<input type="image" src="/images/site/view_basket.jpg" border="0" name="submit" alt="Click Here to View Your Shopping Basket" />
								</form>
							</td>
					</tr>
				</tbody>
			</table>
		</div>
<?php
//*************************************************** layout 3 finish ************************************************************
			} else if ($layout_num == "4") {
//*************************************************** layout 4 start *************************************************************
				
					
				echo "<span class=\"item_title\"> ".$row3['name']."</span><br /><br />";
				echo "<span><img src=\"".$row3['img1']."\" alt=\"\" class=\"item_img1\" /></span><br />";
				echo "<span class=\"item_colour_title\">Colours Available</span> - <span class=\"item_colour_text\">".$row3['colour']."</span><br /><br />";
				echo "<div class=\"item_descrip\" style=\"{text-align: center; }\">".$row3['descrip']."</div><br /><br />";
?>
		<div class="middle">
		
<?php
require_once("inc/price_box.php");
?>
			<br /><br /><br />
			<table cellspacing="0" class="buy_table" align="center" width="350px">
				<thead>
					<tr>
						<th class="Corner" colspan="2">
<?php
				if ($location == "GB") {
					echo "You are shoping with "; ?>&pound;<?php echo "UK Pounds";
					} else if ($location == "AU") {
					echo "You are shoping with \$AU";
					} else if ($location == "US") {
					echo "You are shoping with \$US ";
					} else {
					echo "";
				}
?>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
							<input type="hidden" name="add" value="1">
							<input type="hidden" name="cmd" value="_cart">
							<input type="hidden" name="business" value="sales@dogmetro.com">
							<input type="hidden" name="item_name" value="<?php echo $row3['name'] ?>">
<?php
require_once("inc/price_check.php");
?>
							<input type="hidden" name="no_shipping" value="2">
							<input type="hidden" name="return" value="http://shop.dogmetro.com.au">
							<input type="hidden" name="currency_code" value="<?php if ($location == "GB") { echo "GBP"; } else if ($location == "AU") { echo "AUD"; } else { echo "USD"; } ?>">
							<input type="hidden" name="lc" value="<?php if ($location == "GB") { echo "GB"; } else if ($location == "AU") { echo "AU"; } else { echo "US"; } ?>">
							<input type="hidden" name="bn" value="PP-ShopCartBF">
							<td colspan="2">
								<input type="hidden" name="on0" value="Colour">
								<select name="os0">
									<?php 
									if( is_array($colour_aval) ){
										foreach($colour_aval as $c) {
											echo  '<option value="'.$c.'">'.$c.'</option>';
										}
									} else {
										echo  '<option value="'.$colour_aval.'">'.$colour_aval.'</option>';
									}
									?>
								</select>	
							</td>
						</tr>
						<tr>
							<td>
								<input type="image" src="/images/site/add_2_basket.jpg" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!" />
							</form>
							</td>
							<td>
								<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
									<input type="hidden" name="cmd" value="_cart">
									<input type="hidden" name="business" value="sales@dogmetro.com">
									<input type="hidden" name="display" value="1">
									<input type="image" src="/images/site/view_basket.jpg" border="0" name="submit" alt="Click Here to View Your Shopping Basket" />
								</form>
							</td>
					</tr>
				</tbody>
			</table>
		</div>
<?php	
//*************************************************** layout 4 finish ************************************************************
			}
		}
	} else {
		require_once("inc/shop_front.php");
	}
?>	
    </div>
<?PHP require_once("inc/footer.php") ?>

</body>
</html>