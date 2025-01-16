<?php
$menu_id = (isset( $_GET['menuid'] ) ? $_GET['menuid'] : ''); 
$product = (isset( $_GET['prod'] ) ? $_GET['prod'] : ''); 
?>
</head>
	<body>
	<div id="wrap">
		<div id="currency">
			<span class="top-text">Set Currency&nbsp;&nbsp;&nbsp;</span>
			<a href="/index.php?menuid=<?php echo $menu_id; ?>&prod=<?php echo $product; ?>&loc=GB"><img src="/images/site/uk_price.jpg" alt="UK Pound" width="39" height="19" class="no_border" /></a
			><a href="/index.php?menuid=<?php echo $menu_id; ?>&prod=<?php echo $product; ?>&loc=AU"><img src="/images/site/au_price.jpg" alt="AU Dollars" width="40" height="19" class="no_border" /></a
			><a href="/index.php?menuid=<?php echo $menu_id; ?>&prod=<?php echo $product; ?>&loc=US"><img src="/images/site/us_price.jpg" alt="US Dollars" width="41" height="19" class="no_border" /></a
			>
		</div>
		<div id="header"></div>
		<div class="nav">
			Welcome <?PHP echo ( isset($_SESSION['wholesale']) ? $_SESSION['wholesale'] : "Visitor" ); ?>, Click here to <a href="<?PHP echo WHOLESALE_DOMAIN; ?>/index.php?id=logout">Log Out</a>
		</div>