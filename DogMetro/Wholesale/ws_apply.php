<?php

		session_start(); 
		
		if ($_GET[id] == "logout") {
			session_destroy();
			header ("Location: index.php");
		}

		if($_GET[app] == "error") {
			$error = "missed";
		}

		if($_GET[app] == "passed") {
			echo "<meta http-equiv=\"refresh\" content=\"4;url=http:login.php\"><a href=\"login.php\">You have applied succefully. Click here if the page does not automatically return you to Dogmetro</a>";
		} else {
			if ($_POST[Submit]){

				mysql_connect ("localhost:3306", "daniel_metrotest", "123456") or die ('Error setting sql statement');
				mysql_select_db ("daniel_metroshop") or die ('Error setting dbname');
		
				$bad_chars = array("'", "\"", "\\", "/", "`", "(", ")", ".", "@");
				$bad_email_chars = array("'", "\"", "\\", "/", "`", "(", ")");
		
				$reg_co_name = $_POST['reg_co_name'];
				$reg_co_name = strtolower($reg_co_name);
				$reg_co_name = str_replace($bad_chars, '', $reg_co_name);
		
				$bus_name = $_POST['bus_name'];
				$bus_name = strtolower($bus_name);
				$bus_name = str_replace($bad_chars, '', $bus_name);
				
				$bus_email = $_POST['bus_email'];
				$bus_email = strtolower($bus_email);
				$bus_email= str_replace($bad_email_chars, '', $bus_email);
				
				$bus_phone = $_POST['bus_phone'];
				$bus_phone = strtolower($bus_phone);
				$bus_phone = str_replace($bad_chars, '', $bus_phone);
				
				$bus_fax = $_POST['bus_fax'];
				$bus_fax = strtolower($bus_fax);
				$bus_fax = str_replace($bad_chars, '', $bus_fax);
				
				$bus_abn = $_POST['bus_abn'];
				$bus_abn = strtolower($bus_abn);
				$bus_abn = str_replace($bad_chars, '', $bus_abn);
		
				$owner_name = $_POST['owner_name'];
				$owner_name = strtolower($owner_name);
				$owner_name = str_replace($bad_chars, '', $owner_name);
				
				$owner_email = $_POST['owner_email'];
				$owner_email = strtolower($owner_email);
				$owner_email = str_replace($bad_email_chars, '', $owner_email);
				
				$owner_phone = $_POST['owner_phone'];
				$owner_phone = strtolower($owner_phone);
				$owner_phone = str_replace($bad_chars, '', $owner_phone);
				
				$owner_fax = $_POST['owner_fax'];
				$owner_fax = strtolower($owner_fax);
				$owner_fax = str_replace($bad_chars, '', $owner_fax);
				
				$contact_name = $_POST['contact_name'];
				$contact_name = strtolower($contact_name);
				$contact_name = str_replace($bad_chars, '', $contact_name);
				
				$contact_email = $_POST['contact_email'];
				$contact_email = strtolower($contact_email);
				$contact_email = str_replace($bad_email_chars, '', $contact_email);
				
				$contact_phone = $_POST['contact_phone'];
				$contact_phone = strtolower($contact_phone);
				$contact_phone = str_replace($bad_chars, '', $contact_phone);
				
				$contact_fax = $_POST['contact_fax'];
				$contact_fax = strtolower($contact_fax);
				$contact_fax = str_replace($bad_chars, '', $contact_fax);
				
				$tanc = $_POST['tanc'];
	
	
				if($reg_co_name == "" OR $bus_name == "" OR $bus_email == "" OR $bus_phone == "" OR $bus_fax == "" OR $bus_abn == "" OR $owner_name == "" OR $owner_email == "" OR $owner_phone == "" OR $owner_fax == "" OR $contact_name == "" OR $contact_email == "" OR $contact_phone == "" OR $contact_fax == "" OR $tanc == "") {
				header ("Location: /ws_apply.php?app=error&1=$reg_co_name&2=$bus_name&3=$bus_email&4=$bus_phone&5=$bus_fax&6=$bus_abn&7=$owner_name&8=$owner_email&9=$owner_phone&10=$owner_fax&11=$contact_name&12=$contact_email&13=$contact_phone&14=$contact_fax&15=$tanc");
				} else {
				mysql_query("INSERT INTO ws_user (reg_co_name, bus_name, bus_email, bus_phone, bus_fax, bus_abn, owner_name, owner_email, owner_phone, owner_fax, contact_name, contact_email, contact_phone, contact_fax, tanc) VALUES ('$reg_co_name', '$bus_name', '$bus_email', '$bus_phone', '$bus_fax', '$bus_abn', '$owner_name', '$owner_email', '$owner_phone', '$owner_fax', '$contact_name', '$contact_email', '$contact_phone', '$contact_fax', '$tanc')");
				
				mail( "pyroib@hotmail.com", "DM Wholesale Application", "You have received a application for a wholesale account at dogmetro from $bus_name. Please log into http://admin.dogmetro.com.au to view the users details", "From: site@dogmetro.co.uk" );
				
				header ("Location: /ws_apply.php?app=passed");
				}
			} else {
include("headers.php");
include("css.php");
include("site_header.php");
?>
<table width="558px" align="center" style="font-size:12px;">
	<form method="post" action="">
		<tr><td colspan="2" align="center"><img src="http://www.dogmetro.com.au/images/site/bw_dm.jpg" alt="DM Wholesale logo" /></td></tr>
		<tr><td colspan="2" align="center"><h1>Wholesale Account Application</h1></td></tr>
		<tr><td colspan="2" align="center"><?PHP if($_GET[app] == "error") { echo "<p style=\"color:#FF0000; font-size:14px; \"><strong>It appears you missed a field</strong></p><br />"; }?></td></tr>
		<tr><td colspan="2" align="center"><strong>COMPANY INFORMATION</strong></td></tr>
		<tr><td>REGISTERED COMPANY NAME:<br /><br /></td><td><input type="text" name="reg_co_name" value="<?PHP if($_GET[1] <> "") { echo $_GET[1];} ?>" size="20" maxlength="20" class="textfield" tabindex="1" /></td></tr>
		<tr><td>BUSINESS NAME:<br /><br /></td><td><input type="text" name="bus_name" value="<?PHP if($_GET[2] <> "") { echo $_GET[2];} ?>" size="20" maxlength="40" class="textfield" tabindex="2" /></td></tr>
		<tr><td>BUSINESS EMAIL:<br /><br /></td><td><input type="text" name="bus_email" value="<?PHP if($_GET[3] <> "") { echo $_GET[3];} ?>" size="20" maxlength="40" class="textfield" tabindex="3" /></td></tr>
		<tr><td>BUSINESS PHONE:<br />Include Country Code and Area Code if not in Australia<br /><br /></td><td><input type="text" name="bus_phone" value="<?PHP if($_GET[4] <> "") { echo $_GET[4];} ?>" size="20" maxlength="20" class="textfield" tabindex="4" /></td></tr>
		<tr><td>BUSINESS FAX:<br />Include Country Code and Area Code if not in Australia<br /><br /></td><td><input type="text" name="bus_fax" value="<?PHP if($_GET[5] <> "") { echo $_GET[5];} ?>" size="20" maxlength="20" class="textfield" tabindex="5" /></td></tr>
		<tr><td>A.B.N / A.C.N:<br /><br /></td><td><input type="text" name="bus_abn" value="<?PHP if($_GET[6] <> "") { echo $_GET[6];} ?>" size="20" maxlength="15" class="textfield" tabindex="6" /></td></tr>
		<tr><td colspan="2"><hr /></td></tr>
		<tr><td colspan="2" align="center"><strong>OWNER / DIRECTOR INFORMATION</strong></td></tr>
		<tr><td>OWNER’S NAME:<br /><br /></td><td><input type="text" name="owner_name" value="<?PHP if($_GET[7] <> "") { echo $_GET[7];} ?>" size="20" maxlength="20" class="textfield" tabindex="7" /></td></tr>
		<tr><td>OWNER’S EMAIL:<br /><br /></td><td><input type="text" name="owner_email" value="<?PHP if($_GET[8] <> "") { echo $_GET[8];} ?>" size="20" maxlength="40" class="textfield" tabindex="8" /></td></tr>
		<tr><td>OWNER’S PHONE:<br />Include Country Code and Area Code if not in Australia<br /><br /></td><td><input type="text" name="owner_phone" value="<?PHP if($_GET[9] <> "") { echo $_GET[9];} ?>" size="20" maxlength="30" class="textfield" tabindex="9" /></td></tr>
		<tr><td>OWNER’S FAX:<br />Include Country Code and Area Code if not in Australia<br /><br /></td><td><input type="text" name="owner_fax" value="<?PHP if($_GET[10] <> "") { echo $_GET[10];} ?>" size="20" maxlength="30" class="textfield" tabindex="10" /></td></tr>
		<tr><td colspan="2"><hr /></td></tr>
		<tr><td colspan="2" align="center"><strong>SITE ACCOUNT CONTACT INFORMATION</strong></td></tr>
		<tr><td>CONTACT NAME:<br /><br /></td><td><input type="text" name="contact_name" value="<?PHP if($_GET[11] <> "") { echo $_GET[11];} ?>" size="20" maxlength="20" class="textfield" tabindex="11" /></td></tr>
		<tr><td>CONTACT EMAIL:<br /><br /></td><td><input type="text" name="contact_email" value="<?PHP if($_GET[12] <> "") { echo $_GET[12];} ?>" size="20" maxlength="40" class="textfield" tabindex="12" /></td></tr>
		<tr><td>CONTACT PHONE:<br />Include Country Code and Area Code if not in Australia<br /><br /></td><td><input type="text" name="contact_phone" value="<?PHP if($_GET[13] <> "") { echo $_GET[1];} ?>" size="20" maxlength="30" class="textfield" tabindex="13" /></td></tr>
		<tr><td>CONTACT FAX:<br />Include Country Code and Area Code if not in Australia<br /><br /></td><td><input type="text" name="contact_fax" value="<?PHP if($_GET[14] <> "") { echo $_GET[14];} ?>" size="20" maxlength="30" class="textfield" tabindex="14" /></td></tr>
		<tr><td colspan="2"><hr /></td></tr>
		<tr>
			<td colspan="2"><strong>TERMS & CONDITIONS:</strong><br />I certify that the information supplied in this application is true and correct and I am authorised to make this application, I hereby:<br /><br /><strong>a)</strong> Apply to DogMetro Pty Ltd for a trading account.<br /><br /><strong>b)</strong> Agree to notify DogMetro Pty Ltd of any changes which affects the trading address, legal entity, structure of management or control of the applicant.<br /><br /><strong>c)</strong> Agree that payment of all invoices are due within the notified time frame.<br /><br /><strong>d)</strong> Acknowledge that the approval of this signup is still not a binding contract between myself and DogMetro Pty Ltd. I also herby give permission for Dogmetro Pty Ltd to contact me in regards to creating official contracts at the above contact details.<br /><br /><strong>e)</strong> Agree that should DogMetro Pty Ltd accept this application, any contract between DogMetro Pty Ltd and the Applicant shall incorporate DogMetro Pty Ltd General Terms & Conditions of Sale, a copy of which is annexed or obtainable on separate application.
			</td>
		</tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td><input type="checkbox" <?PHP if($_GET[15] == "agree") { echo "checked";} ?> value="agree" name="tanc" tabindex="15" /> I have read and agree to these Term and Conditions</td>
			<td align="left"><input type="Submit" name="Submit" value="Submit" tabindex="16" /></td>
		</tr>
		<tr><td>&nbsp;</td></tr>
	</form>
</table>

<?php
include("footer.php");
			}
		}
 ?>
</div>
</body>
</html>