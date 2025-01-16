			<table cellspacing='0' class="buy_table" width="350px" align="center">
				<thead>
					<tr>
						<th colspan="2">
<?php

				if ($location == "GB") {
					echo "<img src=\"/images/site/uk_price.jpg\" alt=\"UK Pound\" width=\"39\" height=\"19\" />";
					} else if ($location == "AU") {
					echo "<img src=\"/images/site/au_price.jpg\" alt=\"AU Dollars\" width=\"40\" height=\"19\" />";
					} else if ($location == "US") {
					echo "<img src=\"/images/site/us_price.jpg\" alt=\"US Dollars\" width=\"41\" height=\"19\" />";
					} else {
					echo "Please Select Your Country at the top of the site";
				}
?>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th>Price - </th>
						<td>
<?php
				$all_specials =  $row3['special'];
				list($au_spec, $uk_spec, $us_spec) = explode(',', $all_specials);
				
				
				if ($location == "GB") {
					if ($uk_spec){
						?>&pound;<span style="text-decoration:line-through"><?php echo $row3['uk_price'];?></span>&nbsp;&nbsp;&nbsp;<span style="color:#FF0000">&pound;<?php echo $uk_spec;?></span><?php
					} else {
						?>&pound;<?php echo $row3['uk_price'];
					}
					} else if ($location == "AU") {
					if ($au_spec){
						?>$<span style="text-decoration:line-through"><?php echo $row3['au_price'];?></span>&nbsp;&nbsp;&nbsp;<span style="color:#FF0000">$<?php echo $au_spec;?></span><?php
					} else {
						?>$<?php echo $row3['au_price'];
					}
					} else if ($location == "US") {
					if ($us_spec){
						?>$<span style="text-decoration:line-through"><?php echo $row3['us_price'];?></span>&nbsp;&nbsp;&nbsp;<span style="color:#FF0000">$<?php echo $us_spec;?></span><?php
					} else {
						?>$<?php echo $row3['us_price'];
					}

					} else {
					echo "";
				}
?>
						</td>
					</tr>
				</tbody>
			</table>