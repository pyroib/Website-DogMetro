<?php
	session_start(); 
	
	require_once("config.php");

	If ($_SESSION['site'] == "") {
		header ("Location: /index.php");
	}
	
	if (isset($_GET['id']) && $_GET['id'] == "logout") {
		session_destroy();
		header ("Location: /index.php");
	}	

	$con = mysqli_connect ("localhost:3306", "root", "") or die ('Error setting sql statement');
	mysqli_select_db ($con,"blottcom_dogmtro") or die ('Error setting dbname');
	
	
	$prod_id = (isset($_GET['prodid']) ? $_GET["prodid"] : '');
	$delprod = (isset($_GET['delprod']) ? $_GET["delprod"]: '');
	$edprod = (isset($_GET['editprod']) ? $_GET['editprod']: '');
	$imgnow1 = (isset($_POST['img1']) ? $_POST['img1']: '');
	$imgnow2 = (isset($_POST['img2']) ? $_POST['img2']: '');
	$imgnow3 = (isset($_POST['img3']) ? $_POST['img3']: '');
	$blanklarge = "/images/site/blank_large.jpg";
	$blankcolour = "/images/site/blank_colours.jpg";
	$blankwearing = "/images/site/blank_wearing.jpg";
	
	
	if ($edprod != '') {
		$target = "../shop/images/products/";
		$dbloc = "/images/products/";
		$target1 = $target . basename( $_FILES['uploaded1']['name']) ;
		$target2 = $target . basename( $_FILES['uploaded2']['name']) ;
		$target3 = $target . basename( $_FILES['uploaded3']['name']) ;
	
		$ok=1;
	
		if ($_FILES['uploaded1']['size'] > 350000) { echo "Your file 1 is too large.<br>"; $ok=0; }
		if ($_FILES['uploaded2']['size'] > 350000) { echo "Your file 2 is too large.<br>"; $ok=0; }
		if ($_FILES['uploaded3']['size'] > 350000) { echo "Your file 2 is too large.<br>"; $ok=0; }
	
	
		if ($_FILES['uploaded1']['type'] =="text/php") { echo "No PHP files 1<br>"; $ok=0; }
		if ($_FILES['uploaded2']['type'] =="text/php") { echo "No PHP files 2<br>"; $ok=0; }
		if ($_FILES['uploaded3']['type'] =="text/php") { echo "No PHP files 3<br>"; $ok=0; }
	
		if ($ok==0) { 
			echo "Sorry your file was not uploaded";
			
		} else { 
			
			if(move_uploaded_file($_FILES['uploaded1']['tmp_name'], $target1)) {
				$img1 = $dbloc . basename( $_FILES['uploaded1']['name']) ;
			} else {
				if ($imgnow1 == $blanklarge) {
					$img1 = "/images/site/blank_large.jpg";
				} else {
					$img1 = $imgnow1;
				}
			}
	
			if(move_uploaded_file($_FILES['uploaded2']['tmp_name'], $target2)) {
				$img2 = $dbloc . basename( $_FILES['uploaded2']['name']) ;
			} else {
				if ($imgnow2 == $blankwearing) {
					$img2 = "/images/site/blank_wearing.jpg";
				} else {
					$img2 = $imgnow2;
				}


			}
			
			if(move_uploaded_file($_FILES['uploaded3']['tmp_name'], $target3)) {
				$img3 =$dbloc . basename( $_FILES['uploaded3']['name']) ;
			} else {
				if ($imgnow3 == $blankcolour) {
					$img3 = "/images/site/blank_colours.jpg";
				} else {
					$img3 = $imgnow3;
				}
			}
		}
		
		$img4 = '';
		if (isset($_POST['image_4']) && $_POST['image_4'] != '') {
			$img4 = "/images/site/size_guide.jpg";
		}
		
		$id = $_POST["id"];
		$prod_name = $_POST['prod_name'];
		$au_price = $_POST['au_price'];
		$uk_price = $_POST['uk_price'];
		$us_price = $_POST['us_price'];
		$all_specials = $_POST['au_spec_price'].",".$_POST['uk_spec_price'].",".$_POST['us_spec_price'];
		$wholesale_price = $_POST['wholesale_price'];
		$descrip = $_POST['descrip'];
		$weight = $_POST['weight'];
		$colour = $_POST['colour'];
		$size = (isset($_POST['size'])?$_POST['size']:'');
		$instock = $_POST['xs_stock'].",".$_POST['s_stock'].",".$_POST['m_stock'].",".$_POST['l_stock'].",".$_POST['xl_stock'].",".$_POST['xxl_stock'];
		$special = (isset($_POST['special'])?$_POST['special']:'');
		$xsmall = $_POST['xsmall_n'].",".$_POST['xsmall_c'].",".$_POST['xsmall_b'];
		$small = $_POST['small_n'].",".$_POST['small_c'].",".$_POST['small_b'];
		$med = $_POST['med_n'].",".$_POST['med_c'].",".$_POST['med_b'];
		$large = $_POST['large_n'].",".$_POST['large_c'].",".$_POST['large_b'];
		$xlarge = $_POST['xlarge_n'].",".$_POST['xlarge_c'].",".$_POST['xlarge_b'];
		$xxlarge = $_POST['xxlarge_n'].",".$_POST['xxlarge_c'].",".$_POST['xxlarge_b'];
		$package = $_POST['package'];
		$prod_cat = $_POST['prod_cat'];
		$wholesale_code = $_POST['wholesale_code'];
		$shipping = $_POST['shipping'];
		$no_shipping = $_POST['no_shipping'];
		$page_layout = $_POST['p_layout'];
		$gift_idea = (isset($_POST['giftidea'])?$_POST['giftidea']:'');
		
			
		mysqli_query ($con, "UPDATE products SET id = '$id' , name = '$prod_name' , au_price = '$au_price' , uk_price = '$uk_price' , us_price = '$us_price' , 
		special = '$all_specials' , wholesale_price = '$wholesale_price' , descrip = '$descrip' , weight = '$weight' , colour = '$colour' , instock = '$instock' ,
		 img1 = '$img1' , special = '$all_specials' , xsmall = '$xsmall' , small = '$small' , med = '$med' , large = '$large' , xlarge = '$xlarge' , xxlarge = '$xxlarge' ,
		  package = '$package' , prod_cat = '$prod_cat' , img2 = '$img2' , img3 = '$img3' , img4 = '$img4' , wholesale_code = '$wholesale_code' , shipping = '$shipping' , no_shipping = '$no_shipping', layout = '$page_layout', gift_idea = '$gift_idea' WHERE id = '$edprod'");
		
		header ("Location: /edit_prod.php");
	}
	
	if ($delprod != ''){
		mysqli_query($con,"DELETE FROM products WHERE id = '$delprod'");
		header ("Location: /edit_prod.php");
	}
	
	$showit = "";

	if ($prod_id == "") {
		$showit = "all";
	}

	include("inc/headers.php");
	include("inc/admin_css.php");
	include("inc/site_header.php");
?>
		<div class="middle">
<?php
	If ($showit == "all") {
		$query1  = "SELECT * FROM products ORDER BY id";
		$result1 = mysqli_query($con, $query1) or die ('Error setting result1');
?>
			<table cellspacing="0" class="buy_table" width="758px">
				<thead>
					<tr> 
						<th><a href="/index.php">Admin Home</a></th>
						<th><a href="/add_product.php">Add Product</a></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Select which product you would like to edit</td>
						<td>NOTE: Deleting a product will remove it permanently</td>
					</tr>

<?php
		while($row1 = mysqli_fetch_array($result1)) {
				echo "<tr><td><form method=\"post\" action=\"/edit_prod.php?delprod=".$row1['id']."\">
				<a href=\"/edit_prod.php?prodid=".$row1['id']."\">".$row1['name']."</a></td>
				<td><input name=\"Delete\" type=\"Submit\" value=\"Delete\" /></form></td></tr>";
		}
?>
				</tbody>
			</table>
<?php
	} else {
			$query3  = "SELECT * FROM products WHERE id = '$prod_id'";
			$result3 = mysqli_query($con, $query3) or die ('failed to get product info');
			while($row3 = mysqli_fetch_array($result3)) {

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
				
				$all_specials =  $row3['special'];
				list($au_spec, $uk_spec, $us_spec) = explode(',', $all_specials);
				
				$page_lay = $row3['layout'];
			
			
			
?>
			<table cellspacing="0" class="buy_table" width="758px">
				<thead>
					<tr> 
						<th colspan="2"><a href="/index.php">Admin Home</a> - -  <a href="/edit_prod.php">Edit Home</a></th>
					</tr>
				</thead>
				<form enctype="multipart/form-data" action="/edit_prod.php?editprod=<?php echo $row3['id']; ?>" method="POST">
					<tbody>
						<tr>
							<td><strong>Page Layout</strong></td>
							<td>
								<select name="p_layout" tabindex="0">
									<option value="1" <?php if ($page_lay == "1") { echo "selected=\"yes\""; }?>>1</option>
									<option value="2" <?php if ($page_lay == "2") { echo "selected=\"yes\""; }?>>2</option>
									<option value="3" <?php if ($page_lay == "3") { echo "selected=\"yes\""; }?>>3</option>
									<option value="4" <?php if ($page_lay == "4") { echo "selected=\"yes\""; }?>>4</option>
									<option value="5" <?php if ($page_lay == "5") { echo "selected=\"yes\""; }?>>5</option>
								</select>
							</td>
						</tr>
						<tr>
							<td><strong>Product ID</strong><br />Must be 8 characters long IE 00000002</td>
							<td><input type="text" name="id" value="<?php echo $row3['id']; ?>" size="20" maxlength="8" class="textfield" tabindex="1" /></td>
						</tr>
						<tr>
							<td><strong>Product Name</strong><br />Also the menu Title so be careful of length - I.E. Puppy Princess T-Shirt</td>
							<td><input type="text" name="prod_name" value="<?php echo $row3['name']; ?>" size="20" maxlength="200" class="textfield" tabindex="2" /></td>
						</tr>
						<tr>
							<td><strong>Regular Australian price.</strong><br /><br />Dollars and cents ONLY <strong>Do not include $ signs </strong></td>
							<td><input type="text" name="au_price" value="<?php echo $row3['au_price']; ?>" size="20" maxlength="6" class="textfield" tabindex="3" /></td>
						</tr>
						<tr>
							<td><strong>On Special Australian price.</strong><br /><br />Dollars and cents ONLY <strong>Do not include $ signs </strong></td>
							<td><input type="text" name="au_spec_price" value="<?php echo $au_spec; ?>" size="20" maxlength="6" class="textfield" tabindex="4" /></td>
						</tr>
						<tr>
							<td><strong>Regular English price.</strong><br /><br />Pounds and Pence ONLY <strong >Do not include &pound; signs </strong></td>
							<td><input type="text" name="uk_price" value="<?php echo $row3['uk_price']; ?>" size="20" maxlength="6" class="textfield" tabindex="5" /></td>
						</tr>
						<tr>
							<td><strong>On Special English price.</strong><br /><br />Pounds and Pence ONLY <strong>Do not include &pound; signs </strong></td>
							<td><input type="text" name="uk_spec_price" value="<?php echo $uk_spec; ?>" size="20" maxlength="6" class="textfield" tabindex="6" /></td>
						</tr>
						<tr>
							<td><strong>Regular U.S. price.</strong><br /><br />Dollars and cents ONLY <strong> Do not include $ signs </strong></td>
							<td><input type="text" name="us_price" value="<?php echo $row3['us_price']; ?>" size="20" maxlength="6" class="textfield" tabindex="7" /></td>
						</tr>
						<tr>
							<td><strong>On Special U.S. price.</strong><br /><br />Dollars and cents ONLY <strong>Do not include $ signs </strong></td>
							<td><input type="text" name="us_spec_price" value="<?php echo $us_spec; ?>" size="20" maxlength="6" class="textfield" tabindex="8" /></td>
						</tr>
						<tr>
							<td><strong>Wholesale Price</strong><br /><br />Australian Dollars and cents ONLY</td>
							<td><input type="text" name="wholesale_price" value="<?php echo $row3['wholesale_price']; ?>" size="20" maxlength="6" class="textfield" tabindex="9" /></td>
						</tr>
						<tr>
							<td><strong>Product Description<br /><br />Limited to (6000) characters.</strong> This is where you should type all the text you want. You CAN use HTML here if you <strong>must</strong> but please be away that it can and very likely will screw with the page setup</td>
							<td><textarea name="descrip" rows="14" cols="40" tabindex="10"><?php echo $row3['descrip']; ?></textarea></td>
						</tr>
						<tr>
							<td><strong>Shipping Weight</strong><br /><br />This is the shiping weight for 1 product.<strong>FUNCTION NOT YET ENABLED</strong></td>
							<td><input type="text" name="weight" value="<?php echo $row3['weight']; ?>" size="20" maxlength="6" class="textfield" tabindex="11" /></td>
						</tr>						
						<tr>
							<td><strong>Available Colours<br /><br />Limited to (200) characters.</strong><br />Simply type the colours available seperated by a '/' I.E. - Blue / Black / Red </td>
							<td> <input type="text" name="colour" value="<?php echo $row3['colour']; ?>" size="40" maxlength="200" class="textfield"  tabindex="12" /> </td>
						</tr>
						<tr>
							<td><strong>Stock levels</strong><br /><br />Select if you have a size in stock <strong>If you will never stock  a size select N/A </strong></td>
						  	<td>
								<table width="350px">
									<tr>
										<td>Extra Small<br  />
											<select name="xs_stock" tabindex="13">
												<option value="N/A" <?php if ($xs_stock =="N/A") { echo "selected=\"yes\""; }?>>N/A</option>
												<option value="Y" <?php if ($xs_stock =="Y") { echo "selected=\"yes\""; }?>>Yes</option>
												<option value="N" <?php if ($xs_stock =="N") { echo "selected=\"yes\""; }?>>No</option>
											</select>
										</td>
										<td>Small<br  />
											<select name="s_stock" tabindex="14">
												<option value="N/A" <?php if ($s_stock =="N/A") { echo "selected=\"yes\""; }?>>N/A</option>
												<option value="Y" <?php if ($s_stock =="Y") { echo "selected=\"yes\""; }?>>Yes</option>
												<option value="N" <?php if ($s_stock =="N") { echo "selected=\"yes\""; }?>>No</option>
											</select>
										</td>
										<td>Medium <br  />
											<select name="m_stock" tabindex="15">
												<option value="N/A" <?php if ($m_stock =="N/A") { echo "selected=\"yes\""; }?>>N/A</option>
												<option value="Y" <?php if ($m_stock =="Y") { echo "selected=\"yes\""; }?>>Yes</option>
												<option value="N" <?php if ($m_stock =="N") { echo "selected=\"yes\""; }?>>No</option>
											</select>
										</td>
									</tr>
									<tr>
										<td>Large<br  />
											<select name="l_stock" tabindex="16">
												<option value="N/A" <?php if ($l_stock =="N/A") { echo "selected=\"yes\""; }?>>N/A</option>
												<option value="Y" <?php if ($l_stock =="Y") { echo "selected=\"yes\""; }?>>Yes</option>
												<option value="N" <?php if ($l_stock =="N") { echo "selected=\"yes\""; }?>>No</option>
											</select>
										</td>
										<td>Extra Large<br  />
											<select name="xl_stock" tabindex="17">
												<option value="N/A" <?php if ($xl_stock =="N/A") { echo "selected=\"yes\""; }?>>N/A</option>
												<option value="Y" <?php if ($xl_stock =="Y") { echo "selected=\"yes\""; }?>>Yes</option>
												<option value="N" <?php if ($xl_stock =="N") { echo "selected=\"yes\""; }?>>No</option>
											</select>
										</td>
										<td>Extra Extra Large<br  />
											<select name="xxl_stock" tabindex="18">
												<option value="N/A" <?php if ($xxl_stock =="N/A") { echo "selected=\"yes\""; }?>>N/A</option>
												<option value="Y" <?php if ($xxl_stock =="Y") { echo "selected=\"yes\""; }?>>Yes</option>
												<option value="N" <?php if ($xxl_stock =="N") { echo "selected=\"yes\""; }?>>No</option>
											</select>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<input type="text" name="n" value="Neck" size="10" maxlength="20" class="textfield" tabindex="101" />
								<input type="text" name="c" value="Chest" size="10" maxlength="20" class="textfield" tabindex="102" />		      
								<input type="text" name="b" value="Neck to Tail" size="10" maxlength="20" class="textfield" tabindex="103" />            
							</td>
						</tr>
						<tr>
							<td><strong>XS Measurements</strong><br /><br />All Sizes are in CM <strong>ONLY</strong> use numbers</td>
							<td>
								<input type="text" name="xsmall_n" value="<?php echo $xs_neck; ?>" size="10" maxlength="20" class="textfield" tabindex="21" />
								<input type="text" name="xsmall_c" value="<?php echo $xs_chest; ?>" size="10" maxlength="20" class="textfield" tabindex="22" />		      
								<input type="text" name="xsmall_b" value="<?php echo $xs_n2t; ?>" size="10" maxlength="20" class="textfield" tabindex="23" />            
							</td>
						</tr>
						<tr>
							<td><strong>S Measurements</strong><br /><br />All Sizes are in CM <strong>ONLY</strong> use numbers</td>
							<td>
								<input type="text" name="small_n" value="<?php echo $s_neck; ?>" size="10" maxlength="20" class="textfield" tabindex="24" />
								<input type="text" name="small_c" value="<?php echo $s_chest; ?>" size="10" maxlength="20" class="textfield" tabindex="25" />		      
								<input type="text" name="small_b" value="<?php echo $s_n2t; ?>" size="10" maxlength="20" class="textfield" tabindex="26" />            
							</td>
						</tr>
						
						<tr>
							<td><strong>M Measurements</strong><br /><br />All Sizes are in CM <strong>ONLY</strong> use numbers  </td>
							<td>
								<input type="text" name="med_n" value="<?php echo $m_neck; ?>" size="10" maxlength="20" class="textfield" tabindex="27" />
								<input type="text" name="med_c" value="<?php echo $m_chest; ?>" size="10" maxlength="20" class="textfield" tabindex="28" />		      
								<input type="text" name="med_b" value="<?php echo $m_n2t; ?>" size="10" maxlength="20" class="textfield" tabindex="29" />            
							</td>
						</tr>
						<tr>
							<td><strong>L Measurements</strong><br /><br />All Sizes are in CM <strong>ONLY</strong> use numbers  </td>
							<td>
								<input type="text" name="large_n" value="<?php echo $l_neck; ?>" size="10" maxlength="20" class="textfield" tabindex="30" />
								<input type="text" name="large_c" value="<?php echo $l_chest; ?>" size="10" maxlength="20" class="textfield" tabindex="31" />		      
								<input type="text" name="large_b" value="<?php echo $l_n2t; ?>" size="10" maxlength="20" class="textfield" tabindex="32" />            
							</td>
						</tr>
						<tr>
							<td><strong>XL Measurements</strong><br /><br />All Sizes are in CM <strong>ONLY</strong> use numbers  </td>
							<td>
								<input type="text" name="xlarge_n" value="<?php echo $xl_neck; ?>" size="10" maxlength="20" class="textfield" tabindex="33" />
								<input type="text" name="xlarge_c" value="<?php echo $xl_chest; ?>" size="10" maxlength="20" class="textfield" tabindex="34" />		      
								<input type="text" name="xlarge_b" value="<?php echo $xl_n2t; ?>" size="10" maxlength="20" class="textfield" tabindex="35" />            
							</td>
						</tr>
						<tr>
							<td><strong>XXL Measurements</strong><br /><br />All Sizes are in CM <strong>ONLY</strong> use numbers</td>
							<td>
								<input type="text" name="xxlarge_n" value="<?php echo $xxl_neck; ?>" size="10" maxlength="20" class="textfield" tabindex="36" />
								<input type="text" name="xxlarge_c" value="<?php echo $xxl_chest; ?>" size="10" maxlength="20" class="textfield" tabindex="37" />		      
								<input type="text" name="xxlarge_b" value="<?php echo $xxl_n2t; ?>" size="10" maxlength="20" class="textfield" tabindex="38" />            
							</td>
						</tr>
						<tr>
							<td><strong>Package Size</strong><br /><br />Packaging Size: Est. parcel size I.E. 00cm x 00cm<strong>Do no include cm's </strong> </td>
							<td><input type="text" name="package" value="<?php echo $row3['package']; ?>" size="20" maxlength="15" class="textfield" tabindex="39" /> </td>
						</tr>
						<tr>
							<td><strong>Menu Catagory</strong><br />THIS IS WHAT MENU THE ITEM WILL BE IN</td>
							<td>
								<select name="prod_cat" tabindex="40">
<?php
				
					$query2  = "SELECT * FROM menu ORDER BY men_order";
					$result2 = mysqli_query($con, $query2) or die ('Error setting result1');
					
					while($row2 = mysqli_fetch_array($result2)) {
					
						$men1 = $row3['prod_cat'];
						$men2 = $row2['menu_id'];
						if ( $men1 == $men2){ 
							echo "<option value=\"".$row2['menu_id']."\" selected=\"Yes\">".$row2['menu_name']."</option>";
						} else {
							echo "<option value=\"".$row2['menu_id']."\">".$row2['menu_name']."</option>";
						}
					}
					

?>	
								</select>
							</td>
						</tr>
						<tr>
							<td><strong>Image 1</strong><br /><br />Type in the full address on the main image for this product.<strong><br />'464px' Wide x '273px' High</strong> </td>
							<td><input name="img1" type="hidden" value="<?php echo $row3['img1']; ?>" /><input name="uploaded1" type="file" tabindex="41" /></td>
						</tr>
						<tr>
							<td><strong>Image 2</strong><br /><br />Upload the image you wish to display to the right of the discription <strong><br />'200px' Wide x '280px' High</strong> </td>
							<td><input name="img2" type="hidden" value="<?php echo $row3['img2']; ?>" /><input name="uploaded2" type="file" tabindex="42" /></td>
						</tr>
						<tr>
							<td><strong>Image 3</strong><br /><br />Upload the image you wish to display for the colours avaliable<br /><strong>'100px' Wide x '100px' High PER colour. Ensure you create 1 large image no more than '300px' wide</strong> </td>
							<td><input name="img3" type="hidden" value="<?php echo $row3['img3']; ?>" /><input name="uploaded3" type="file" tabindex="43" /></td>
						</tr>
						
						<tr>
							<td><strong>Image 4</strong><br /><br /><strong>ONLY </strong>check this box if you want the size guide image to appear with this product</td>
							<td> <input name="image_4" type="checkbox" value="yes" <?php if ($row3['img4'] == "/images/site/size_guide.jpg") { echo "checked"; }?>/> </td>
						</tr>
						
						<tr>
							<td><strong>Wholesale Code</strong><br /><br />The wholesale code is restricted to 5 characters</td>
							<td> <input type="text" name="wholesale_code" value="<?php echo $row3['wholesale_code']; ?>" size="20" maxlength="10" class="textfield" tabindex="45" /></td>
						</tr>
						
						<tr>
							<td><strong>Shipping Costs</strong><br /><br />Price of shipping <strong>CURRENTLY NOT IN USE</strong></td>
							<td> <input type="text" name="shipping" value="<?php echo $row3['shipping']; ?>" size="20" maxlength="10" class="textfield" tabindex="46"  /></td>
						</tr>

						<tr>
							<td><strong>Gift Idea</strong><br /><br />Is this product a good gift idea?</td>
							<td> <input name="giftidea" type="checkbox" value="yes" <?php if ($row3['gift_idea'] <> "") { echo "checked"; }?>/></td>
						</tr>

						<tr>
							<td><strong>No Shipping</strong><br /><br />This is the amount of items that need to be baught to stop being charged delivery again. </td>
							<td><input type="text" name="no_shipping" value="<?php echo $row3['no_shipping']; ?>" size="20" maxlength="30" class="textfield" tabindex="47" /></td>
						</tr>
						
						<tr>
							<td></td>
							<td><input type="submit" value="Upload" /></td>
						</tr>
					</tbody>
				</form>	
			</table>
	
<?php		
		}
	}
?>	
		</div>

<?PHP require_once("inc/footer.php") ?>
</div>
</body>
</html>