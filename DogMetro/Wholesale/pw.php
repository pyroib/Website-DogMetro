<?PHP
include("css.php");

	if ($_POST['contact'] == "Submit") {
		$wsname= $_POST['login_name'];
		mail( "pyroib@hotmail.com", "DM Wholesale - Password Reset Request", "You have received a request for a wholesale account at dogmetro to be reset from $wsname . Please log into http://admin.dogmetro.com.au to update the users details. Remember to email them telling them there new password.", "From: site@dogmetro.co.uk" );
		echo "<script language=javascript>function closewindow(){window.close()}</script><body oncontextmenu=\"closewindow()\" onclick=\"closewindow()\"><div style=\"text-align:center\"><img src=\"http://www.dogmetro.com.au/images/site/bw_dm.jpg\" alt=\"DogMetro Logo\" /><br /><br />You have submited your request for a password reset.<br /><br />For security reasons Dogmetro will contact you via the information supplied on sign up.<br /><br /><strong>Please allow up to 24 Hours for our staff to contact you.</strong><br /><br /><br />Click anywhere on this page to return you to Dogmetro</a></div>";
	
	
	
	} else {
?>
		<div style="text-align:center">
			<img src="http://www.dogmetro.com.au/images/site/bw_dm.jpg" alt="DogMetro Logo" /><br /><br />
			<form method="post" action="">
				Please enter your login name that was given to you by Dogmetro<br /><br />
				Login:<input name="login_name" type="text" /><br />
				<input type="submit" value="Submit" name="contact" />
			</form>
		</div>
<?PHP
	}
?>
