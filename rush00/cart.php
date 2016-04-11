<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   cart.php                                           :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/10 17:08:37 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/10 19:15:34 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

include "srcs/init.php";
include "srcs/items.php";

if (($items = items_load()) === FALSE)
	$items = [];

$data["css"][] = "res/products.css";

function get_item_image($items, $cart_item) // TODO
{
	return ("");
}

/*
** Do not handle invalid cart items
*/

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

<?php

$total_price = 0;

$cart = get_cart();

foreach ($cart as $cart_item)
{
	if (($key = data_get($items, "name", $cart_item["name"])) === FALSE)
		continue ;
	$item = $items[$key];

	$total_price += $item["price"] * $cart_item["quantity"];

?>

	<div class="product">
		<p class="product_name"><?php echo $item["name"]; ?></p>
		<p>Price: <?php echo $item["price"] ?><br />
		Quantity: <?php echo $cart_item["quantity"]; ?>
			<a href="cart_action.php?action=set_q&item=<?php echo $item["name"]; ?>&q=<?php echo $cart_item["quantity"] - 1; ?>">-</a>
			/ <a href="cart_action.php?action=set_q&item=<?php echo $item["name"]; ?>&q=<?php echo $cart_item["quantity"] + 1; ?>">+</a><br />
			<a href="cart_action.php?action=delete&item=<?php echo $item["name"]; ?>">delete</a>
		</p>
	</div>

<?php } ?>

	<div class="big_bar">
<?php if (count($cart) > 0) { ?>
		<a class="button" href="cart_action.php?action=validate" style="background-color: <?php echo $data["main_color"]; ?>;float: right;">Validate</a>
<?php } ?>

		<p>Total price: <?php echo $total_price; ?></p>
	</div>

</section>

<?php include "fragments/footer.php"; ?>

</body>
</html>
