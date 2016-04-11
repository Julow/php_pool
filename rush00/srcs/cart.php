<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   cart.php                                           :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/10 16:55:35 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/10 18:58:17 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

if ($FILE_CART_H !== TRUE)
{
	$FILE_CART_H = TRUE;

include "srcs/items.php";

function add_to_cart($item_name)
{
	return (cart_set_q($item_name, (($key = data_get($_SESSION["cart"], "name", $item_name)) === FALSE) ?
			1 : $_SESSION["cart"][$key]["quantity"] + 1));
}

function cart_size()
{
	if (!isset($_SESSION["cart"]))
		return (0);
	$count = 0;
	foreach ($_SESSION["cart"] as $item)
		$count += $item["quantity"];
	return ($count);
}

function get_cart()
{
	if (!isset($_SESSION["cart"]))
		return ([]);
	if (($items = items_load()) === FALSE)
		$items = [];
	foreach ($_SESSION["cart"] as $key => $value)
	{
		if (($tmp = data_get($items, "name", $value["name"])) === FALSE
			|| $items[$tmp]["stock"] <= 0)
			unset($_SESSION["cart"][$key]);
		else if ($items[$tmp]["stock"] < $_SESSION["cart"][$key]["quantity"])
			$_SESSION["cart"][$key]["quantity"] = $items[$tmp]["stock"];
	}
	return ($_SESSION["cart"]);
}

function cart_set_q($item_name, $quantity)
{
	if (!isset($_SESSION["cart"]))
		$_SESSION["cart"] = [];
	if (($items = items_load()) === FALSE)
		$items = [];
	if (($key = data_get($items, "name", $item_name)) === FALSE
		|| $quantity < 0)
		return ("Error");
	if ($items[$key]["stock"] < $quantity)
		return ("Not enougth stock");
	if (($key = data_get($_SESSION["cart"], "name", $item_name)) === FALSE)
		$_SESSION["cart"][] = array(
			"name" => $item_name,
			"quantity" => $quantity
		);
	else
		$_SESSION["cart"][$key]["quantity"] = $quantity;
	return (TRUE);
}

function cart_delete($item_name)
{
	if (($key = data_get($_SESSION["cart"], "name", $item_name)) === FALSE)
		return (FALSE);
	unset($_SESSION["cart"][$key]);
	return (TRUE);
}

}

?>
