	<title><?php echo $data["title"]; ?></title>
	<meta charset="UTF-8">
<?php

foreach ($data["css"] as $css)
	echo '	<link rel="stylesheet" href="'. $css .'" type="text/css" />'

?>
