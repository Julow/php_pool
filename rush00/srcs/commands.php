<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   commands.php                                       :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/10 19:13:10 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/10 19:38:26 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

if (!$FILE_COMMANDS_H)
{
	$FILE_COMMANDS_H = TRUE;

include "srcs/cart.php";

$BDD_COMMAND_FILE = "commands.bdd";

function commands_load()
{
	global $BDD_COMMAND_FILE;

	return (load_from_file($BDD_COMMAND_FILE));
}

function commands_save($commands)
{
	global $BDD_COMMAND_FILE;

	return (save_to_file($BDD_COMMAND_FILE, $commands));
}

function command_validate()
{
	if (!isset($_SESSION["cart"]))
		return ([]);
	if (($items = items_load()) === FALSE)
		$items = [];
	if (($commands = commands_load()) === FALSE)
		$commands = [];
	$command = array(
		"user_name" => $_SESSION["logged_user"],
		"items" => [],
		"total" => 0
	);
	foreach ($_SESSION["cart"] as $value)
	{
		if (($item_key = data_get($items, "name", $value["name"])) === FALSE
			|| $items[$item_key]["stock"] <= 0 || $value["quantity"] <= 0)
			continue ;
		$item = $items[$item_key];
		$tmp = array(
			"name" => $item["name"],
			"quantity" => min($value["quantity"], $item["stock"]),
			"price" => $item["price"]
		);
		$command["items"][] = $tmp;
		$command["total"] += $item["price"] * $tmp["quantity"];
		$items[$item_key]["stock"] -= $tmp["quantity"];
	}
	$commands[] = $command;
	if (!items_save($items) || !commands_save($commands))
		return (FALSE);
	$_SESSION["cart"] = [];
	return (TRUE);
}

}

?>
