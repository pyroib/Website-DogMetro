	</head>
	<body>
	<div id="wrap">
		<div id="currency">
			<span class="top-text">Set Currency&nbsp;&nbsp;&nbsp;</span>
			<a href="index.php?menuid=<?php echo (isset($_GET['menuid'])?$_GET['menuid']:''); ?>&prod=<?php echo (isset($_GET['prod'])?$_GET['prod']:''); ?>&loc=GB"><img src="/images/site/uk_price.jpg" alt="UK Pound" width="39" height="19" class="no_border" /></a
			><a href="index.php?menuid=<?php echo (isset($_GET['menuid'])?$_GET['menuid']:''); ?>&prod=<?php echo (isset($_GET['prod'])?$_GET['prod']:'');  ?>&loc=AU"><img src="/images/site/au_price.jpg" alt="AU Dollars" width="40" height="19" class="no_border" /></a
			><a href="index.php?menuid=<?php echo (isset($_GET['menuid'])?$_GET['menuid']:''); ?>&prod=<?php echo (isset($_GET['prod'])?$_GET['prod']:'');  ?>&loc=US"><img src="/images/site/us_price.jpg" alt="US Dollars" width="41" height="19" class="no_border" /></a
			>
		</div>
		<div id="header"></div>
		<div class="nav">
			<a href="http://shop.dogmetro.com.au/index.php?loc=<?php echo (isset($_GET['loc'])?$_GET['loc']:''); ?>">Shop Online</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
			<a href="http://wholesale.dogmetro.com.au/index.php?loc=<?php echo (isset($_GET['loc'])?$_GET['loc']:''); ?>">Buy Wholesale</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
			<a href="http://galleries.dogmetro.com.au/index.php?loc=<?php echo (isset($_GET['loc'])?$_GET['loc']:''); ?>">Photo Galleries</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
			<a href="http://doggydirectory.dogmetro.com.au/index.php?loc=<?php echo (isset($_GET['loc'])?$_GET['loc']:''); ?>">Community Directory</a>
		</div>