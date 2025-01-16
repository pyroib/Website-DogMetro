<?php
if (($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
&& ($_FILES["file"]["size"] < 20000))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    if (file_exists("tba/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
		move_uploaded_file($_FILES["file"]["tmp_name"],
		"tba/" . $_FILES["file"]["name"]);
		echo "<img src=\"http://www.dogmetro.com.au/images/site/bw_dm.jpg\" alt=\"Dogmetro Logo\" /><br /><h1>Thank you</h1> Your file " . $_FILES["file"]["name"] . " has been submited for approval";
		echo "<img src=\"/tba/" . $_FILES["file"]["name"] . "\" height=\"200px\" alt=\"\" />";
		mail( "pyroib@hotmail.com", "DM Galleries - New Photo Added to site", "You have received a request for a public photo to be added to DogMetro. Please log in to http://admin.dogmetro.com.au to view and approve the photo.", "From: photo@dogmetro.co.uk" );
      }
    }
  }
else
  {
  echo "Invalid file";
  }
?>