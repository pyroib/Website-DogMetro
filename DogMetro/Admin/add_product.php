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
	
	$adprod = (isset($_GET['adprod'])?$_GET['adprod']:'');

	if ($adprod) {
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
	
			header ("Location: /index.php");
			
			if(move_uploaded_file($_FILES['uploaded1']['tmp_name'], $target1)) {
				$img1 = $dbloc . basename( $_FILES['uploaded1']['name']) ;
			} else {
				$img1 = "/images/site/blank_large.jpg";
			}
	
			if(move_uploaded_file($_FILES['uploaded2']['tmp_name'], $target2)) {
				$img2 = $dbloc . basename( $_FILES['uploaded2']['name']) ;
			} else {
				$img2 = "/images/site/blank_wearing.jpg";
			}
			
			if(move_uploaded_file($_FILES['uploaded3']['tmp_name'], $target3)) {
				$img3 =$dbloc . basename( $_FILES['uploaded3']['name']) ;
			} else {
				$img3 = "/images/site/blank_colours.jpg";
			}
		}
		
		if ($_POST['image_4']) {
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
		$size = $_POST['size'];
		$instock = $_POST['xs_stock'].",".$_POST['s_stock'].",".$_POST['m_stock'].",".$_POST['l_stock'].",".$_POST['xl_stock'].",".$_POST['xxl_stock'];
		$special = $_POST['special'];
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
		$giftidea = $_POST['giftidea'];	

			
		mysqli_query($con, "INSERT INTO products (id, name, au_price, uk_price, us_price, wholesale_price, descrip, weight, colour, instock, img1, special, xsmall, small, med, large, xlarge, xxlarge, package, prod_cat, img2, img3, img4, wholesale_code, shipping, no_shipping, layout, gift_idea) VALUES ('$id', '$prod_name', '$au_price', '$uk_price', '$us_price', '$wholesale_price', '$descrip', '$weight', '$colour', '$instock', '$img1', '$all_specials', '$xsmall', '$small', '$med', '$large', '$xlarge', '$xxlarge', '$package', '$prod_cat', '$img2', '$img3', '$img4', '$wholesale_code', '$shipping', '$no_shipping', '$page_layout', '$giftidea')");
		
		header ("Location: /edit_prod.php");
	} else {
		require_once("inc/headers.php");
		require_once("inc/admin_css.php");
		require_once("inc/site_header.php");
?>
		<div class="middle">
			<table cellspacing="0" class="buy_table" width="758px">
				<thead>
					<tr> 
						<th colspan="2"><a href="/index.php">Admin Home</a></th>
					</tr>
				</thead>
				<form enctype="multipart/form-data" action="/add_product.php?adprod=new" method="POST">
					<tbody>
							<td><strong>Page Layout</strong></td>
							<td>
								<select name="p_layout" tabindex="0">
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>
							</td>
						<tr>
							<td><strong>Product ID</strong><br /><br />Must be 8 characters long IE 00000002</td>
							<td><input type="text" name="id" value="00000000" size="20" maxlength="8" class="textfield" tabindex="1" /></td>
						</tr>
						<tr>
							<td><strong>Product Name</strong><br /><br />Also the menu Title so be careful of length - I.E. Puppy Princess T-Shirt</td>
							<td><input type="text" name="prod_name" value="" size="20" maxlength="200" class="textfield" tabindex="2" /></td>
						</tr>
						<tr>
							<td><strong>Regular Australian price.</strong><br /><br />Dollars and cents ONLY <strong>Do not include $ signs </strong></td>
							<td><input type="text" name="au_price" value="" size="20" maxlength="6" class="textfield" tabindex="3" /></td>
						</tr>
						<tr>
							<td><strong>On Special Australian price.</strong><br /><br />Dollars and cents ONLY<strong>Do not include $ signs </strong></td>
							<td><input type="text" name="au_spec_price" value="" size="20" maxlength="6" class="textfield" tabindex="4" /></td>
						</tr>
						<tr>
							<td><strong>Regular English price.</strong><br /><br />Pounds and Pence ONLY <strong >Do not include &pound; signs </strong></td>
							<td><input type="text" name="uk_price" value="" size="20" maxlength="6" class="textfield" tabindex="5" /></td>
						</tr>
						<tr>
							<td><strong>On Special English price.</strong><br /><br />Pounds and Pence ONLY <strong>Do not include &pound; signs </strong></td>
							<td><input type="text" name="uk_spec_price" value="" size="20" maxlength="6" class="textfield" tabindex="6" /></td>
						</tr>
						<tr>
							<td><strong>Regular U.S. price.</strong><br /><br />Dollars and cents ONLY <strong> Do not include $ signs </strong></td>
							<td><input type="text" name="us_price" value="" size="20" maxlength="6" class="textfield" tabindex="7" /></td>
						</tr>
						<tr>
							<td><strong>On Special U.S. price.</strong><br /><br />Dollars and cents ONLY <strong>Do not include $ signs</strong></td>
							<td><input type="text" name="us_spec_price" value="" size="20" maxlength="6" class="textfield" tabindex="8" /></td>
						</tr>
						<tr>
							<td><strong>Wholesale Price</strong><br /><br />Australian Dollars and cents ONLY</td>
							<td><input type="text" name="wholesale_price" value="" size="20" maxlength="6" class="textfield" tabindex="9" /></td>
						</tr>
						<tr>
							<td><strong>Product Description<br /><br />Limited to (6000) characters.</strong> This is where you should type all the text you want. You CAN use HTML here if you <strong>must</strong> but please be away that it can and very likely will screw with the page setup</td>
							<td><textarea name="descrip" rows="14" cols="40" tabindex="10"></textarea></td>
						</tr>
						<tr>
							<td><strong>Shipping Weight</strong><br /><br />This is the shiping weight for 1 product.<strong>FUNCTION NOT YET ENABLED</strong></td>
							<td><input type="text" name="weight" value="XXX" size="20" maxlength="6" class="textfield" tabindex="11" /></td>
						</tr>
						<tr>
							<td><strong>Available Colours<br /><br />Limited to (200) characters.</strong><br />Simply type the colours available seperated by a '/' I.E. - Blue / Black / Red </td>
							<td> <input type="text" name="colour" value="XXXX / XXXX / XXXX" size="40" maxlength="200" class="textfield"  tabindex="12" /> </td>
						</tr>
						<tr>
							<td><strong>Stock levels</strong><br /><br />Select if you have a size in stock <strong>If you will never stock  a size select N/A </strong></td>
						  	<td>
								<table width="350px">
									<tr>
										<td>Extra Small<br  />
											<select name="xs_stock" tabindex="13">
												<option value="Y" selected="yes">Yes</option>
												<option value="N">No</option>
												<option value="N/A">N/A</option>
											</select>
										</td>
										<td>Small<br  />
											<select name="s_stock" tabindex="14">
												<option value="Y" selected="yes">Yes</option>
												<option value="N">No</option>
												<option value="N/A">N/A</option>
											</select>
										</td>
										<td>Medium <br  />
											<select name="m_stock" tabindex="15">
												<option value="Y" selected="yes">Yes</option>
												<option value="N">No</option>
												<option value="N/A">N/A</option>
											</select>
										</td>
									</tr>
									<tr>
										<td>Large<br  />
											<select name="l_stock" tabindex="16">
												<option value="Y" selected="yes">Yes</option>
												<option value="N">No</option>
												<option value="N/A">N/A</option>
											</select>
										</td>
										<td>Extra Large<br  />
											<select name="xl_stock" tabindex="17">
												<option value="Y" selected="yes">Yes</option>
												<option value="N">No</option>
												<option value="N/A">N/A</option>
											</select>
										</td>
										<td>Extra Extra Large<br  />
											<select name="xxl_stock" tabindex="18">
												<option value="Y" selected="yes">Yes</option>
												<option value="N">No</option>
												<option value="N/A">N/A</option>
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
								<input type="text" name="xsmall_n" value="" size="10" maxlength="20" class="textfield" tabindex="21" />
								<input type="text" name="xsmall_c" value="" size="10" maxlength="20" class="textfield" tabindex="22" />		      
								<input type="text" name="xsmall_b" value="" size="10" maxlength="20" class="textfield" tabindex="23" />            
							</td>
						</tr>
						<tr>
							<td><strong>S Measurements</strong><br /><br />All Sizes are in CM <strong>ONLY</strong> use numbers</td>
							<td>
								<input type="text" name="small_n" value="" size="10" maxlength="20" class="textfield" tabindex="24" />
								<input type="text" name="small_c" value="" size="10" maxlength="20" class="textfield" tabindex="25" />		      
								<input type="text" name="small_b" value="" size="10" maxlength="20" class="textfield" tabindex="26" />            
							</td>
						</tr>
						
						<tr>
							<td><strong>M Measurements</strong><br /><br />All Sizes are in CM <strong>ONLY</strong> use numbers  </td>
							<td>
								<input type="text" name="med_n" value="" size="10" maxlength="20" class="textfield" tabindex="27" />
								<input type="text" name="med_c" value="" size="10" maxlength="20" class="textfield" tabindex="28" />		      
								<input type="text" name="med_b" value="" size="10" maxlength="20" class="textfield" tabindex="29" />            
							</td>
						</tr>
						<tr>
							<td><strong>L Measurements</strong><br /><br />All Sizes are in CM <strong>ONLY</strong> use numbers  </td>
							<td>
								<input type="text" name="large_n" value="" size="10" maxlength="20" class="textfield" tabindex="30" />
								<input type="text" name="large_c" value="" size="10" maxlength="20" class="textfield" tabindex="31" />		      
								<input type="text" name="large_b" value="" size="10" maxlength="20" class="textfield" tabindex="32" />            
							</td>
						</tr>
						<tr>
							<td><strong>XL Measurements</strong><br /><br />All Sizes are in CM <strong>ONLY</strong> use numbers  </td>
							<td>
								<input type="text" name="xlarge_n" value="" size="10" maxlength="20" class="textfield" tabindex="33" />
								<input type="text" name="xlarge_c" value="" size="10" maxlength="20" class="textfield" tabindex="34" />		      
								<input type="text" name="xlarge_b" value="" size="10" maxlength="20" class="textfield" tabindex="35" />            
							</td>
						</tr>
						<tr>
							<td><strong>XXL Measurements</strong><br /><br />All Sizes are in CM <strong>ONLY</strong> use numbers  </td>
							<td>
								<input type="text" name="xxlarge_n" value="" size="10" maxlength="20" class="textfield" tabindex="36" />
								<input type="text" name="xxlarge_c" value="" size="10" maxlength="20" class="textfield" tabindex="37" />		      
								<input type="text" name="xxlarge_b" value="" size="10" maxlength="20" class="textfield" tabindex="38" />            
							</td>
						</tr>
						<tr>
							<td><strong>Package Size</strong><br /><br />Packaging Size: Est. parcel size I.E. 00cm x 00cm <strong>Do no include cm's </strong> </td>
							<td><input type="text" name="package" value="" size="40" maxlength="15" class="textfield" tabindex="39" /> </td>
						</tr>
						<tr>
							<td><strong>Menu Catagory</strong><br /><br />THIS IS WHAT MENU THE ITEM WILL BE IN</td>
							<td>
								<select name="prod_cat" tabindex="40">
<?php
				
					$query2  = "SELECT * FROM menu ORDER BY men_order";
					$result2 = mysqli_query($con, $query2) or die ('Error setting result1');
					while($row2 = mysqli_fetch_array($result2))
					{
						echo "<option value=\"".$row2['menu_id']."\">".$row2['menu_name']."</option>";
					}
?>	
								</select>
							</td>
						</tr>
						<tr>
							<td><strong>Image 1</strong><br /><br />Type in the full address on the main image for this product.<strong><br />'464px' Wide x '273px' High</strong> </td>
							<td><input name="uploaded1" type="file" value="" tabindex="41" /></td>
						</tr>
						<tr>
							<td><strong>Image 2</strong><br /><br />Upload the image you wish to display to the right of the discription <strong><br />'200px' Wide x '280px' High</strong> </td>
							<td> <input name="uploaded2" type="file" value="" tabindex="42" /></td>
						</tr>
						<tr>
							<td><strong>Image 3</strong><br /><br />Upload the image you wish to display for the colours avaliable<br /><strong>'100px' Wide x '100px' High PER colour. Ensure you create 1 large image no more than '300px' wide</strong> </td>
							<td><input name="uploaded3" type="file" value="" tabindex="43" /></td>
						</tr>
						
						<tr>
							<td><strong>Image 4</strong><br /><br /><strong>ONLY </strong>check this box if you want the size guide image to appear with this product</td>
							<td> <input name="image_4" type="checkbox" value="yes" /> </td>
						</tr>
						
						<tr>
							<td><strong>Wholesale Code</strong><br /><br />The wholesale code is restricted to 5 characters</td>
							<td> <input type="text" name="wholesale_code" value="XXXXX" size="15" maxlength="10" class="textfield" tabindex="45" /></td>
						</tr>
						
						<tr>
							<td><strong>Shipping Costs</strong><br /><br />Price of shipping <strong>CURRENTLY NOT IN USE</strong></td>
							<td> <input type="text" name="shipping" value="" size="30" maxlength="10" class="textfield" tabindex="46"  /></td>
						</tr>

						<tr>
							<td><strong>Gift Idea</strong><br /><br />Is this product a good gift idea?</td>
							<td> <input name="giftidea" type="checkbox" value="yes" /></td>
						</tr>
						
						<tr>
							<td><strong>No Shipping</strong><br /><br />This is the amount of items that need to be baught to stop being charged delivery again. </td>
							<td><input type="text" name="no_shipping" value="2" size="30" maxlength="30" class="textfield" tabindex="48" /></td>
						</tr>
						
						<tr>
							<td></td>
							<td><input type="submit" value="Upload" /></td>
						</tr>
					</tbody>
				</form>	
			</table>
		</div>
<?php
		include("footer.php");
	}
 ?>
</div>
</body>
</html>







