<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   index.php                                          :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/10 16:23:57 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/10 19:52:24 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

include "srcs/init.php";
include "srcs/items.php";
include "srcs/categories.php";

if (($categories = categories_load()) === FALSE)
	$categories = [];
if (($items = items_load()) === FALSE)
	$items = [];

$data["css"][] = "res/products.css";

?>
<!DOCTYPE html>
<html>
<head>

<?php include "fragments/head.php"; ?>

</head>
<body>

<?php include "fragments/header.php"; ?>

<section class="content">

	<?php if ($_GET["error"]) { ?>
		<div class="error"><?php echo $_GET["error"]; ?></div>
	<?php } ?>

<?php foreach ($items as $item)
{
	if (isset($_GET["category"]) && $_GET["category"] != "" && array_search($_GET["category"], $item["categories"]) === FALSE)
		continue ;

?>
	<div class="product">
		<p class="product_name"><?php echo $item["name"]; ?></p>
		<?php if ($item["stock"] > 0) { ?>
			<p>Price: <?php echo $item["price"]; ?> €<br />
				<a href="product_action.php?action=add&item=<?php echo $item["name"]; ?>&category=<?php echo $_GET["category"]; ?>">Add to cart</a></p>
		<?php } else { ?>
			<p>Out of stock</p>
		<?php } ?>
	</div>

<?php } ?>

</section>

<?php include "fragments/footer.php"; ?>

</body>
</html>
