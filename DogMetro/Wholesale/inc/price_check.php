<input type="hidden" name="amount" value="<?php if ($location == "GB") {if ($uk_spec) { echo $uk_spec; } else { echo $row3['uk_price']; } } else if ($location == "AU") { if ($au_spec) { echo $au_spec; } else { echo $row3['au_price']; } } else { if ($us_spec) { echo $us_spec; } else { echo $row3['us_price']; } } ?>"> 