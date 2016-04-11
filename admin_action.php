<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   admin_action.php                                   :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/09 19:17:10 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/10 20:07:55 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

//required for categories'action
include "srcs/init.php";
include "srcs/categories.php";
include "srcs/items.php";
//required for users'action
include "srcs/auth.php";

function user_action()
{
	if (($users = load_users()) === FALSE)
		return ("Cannot load users");
	if ($_GET["action"] == "delete")
	{
		if (($key = data_get($users, "login", $_GET["user"])) === FALSE)
			return ("User not found ". $_GET["user"]);
		unset($users[$key]);
	}
	else if ($_GET["action"] == "setadmin")
	{
		if (($key = data_get($users, "login", $_GET["user"])) === FALSE)
			return ("User not found ". $_GET["user"]);
		$users[$key]["admin"] = TRUE;
	}
	else if ($_GET["action"] == "unsetadmin")
	{
		if (($key = data_get($users, "login", $_GET["user"])) === FALSE)
			return ("User not found ". $_GET["user"]);
		$users[$key]["admin"] = FALSE;
	}
	else if ($_GET["action"] == "add_user")
	{
		if (($users = user_add($users, $_POST["login"], $_POST["passwd"],
			array("email" => $_POST["email"]))) === FALSE)
			return ("Cannot create user");
	}
	if (!save_users($users))
		return ("Cannot save users");
	return (TRUE);
}

function categories_action()
{
	if (($categories = categories_load()) === FALSE)
		return ("Cannot load categories");
	if ($_GET["action"] == "delete")
	{
		if (($key = array_search($_GET["category"], $categories)) === FALSE)
			return ("Categorie not found ". $_GET["category"]);
		unset($categories[$key]);
		categories_check($categories);
	}
	else if ($_GET["action"] == "add_category")
	{
		if (strlen($category_name = trim($_POST["category"])) == 0)
			return ("Invalid name");
		if (($key = array_search($_POST["category"], $categories)) !== FALSE)
			return ("Category already exists ". $_POST["category"]);
		$categories[] = $_POST["category"];
	}
	if (!categories_save($categories))
		return ("Cannot save categories");
	return (TRUE);
}

function items_action()
{
	if (($items = items_load()) === FALSE)
		return ("Cannot load items");
	if ($_GET["action"] == "delete")
	{
		if (($key = data_get($items, "name", $_GET["item"])) === FALSE)
			return ("Item not found ". $_GET["item"]);
		unset($items[$key]);
	}
	else if ($_GET["action"] == "add_item")
	{
		if (strlen($item_name = trim($_POST["item"])) == 0)
			return ("Invalid name");
		if (($key = data_get($items, "name", $item_name)) !== FALSE)
			return ("Item already exists ". $item_name);
		$items[] = array(
			"name" => $item_name,
			"categories" => [],
			"stock" => intval($_POST["stock"]),
			"price" => floatval($_POST["price"])
		);
	}
	else if ($_GET["action"] == "add_category")
	{
		if (($key = data_get($items, "name", $_GET["item"])) === FALSE)
			return ("Item not found ". $_GET["item"]);
		if (array_search($_POST["category"], $items[$key]["categories"]) !== FALSE)
			return ("Already in category ". $_POST["category"]);
		$items[$key]["categories"][] = $_POST["category"];
	}
	else if ($_GET["action"] == "del_category")
	{
		if (($key = data_get($items, "name", $_GET["item"])) === FALSE)
			return ("Item not found ". $_GET["item"]);
		if (($index = array_search($_GET["category"], $items[$key]["categories"])) === FALSE)
			return ("Category not found ". $_GET["category"]);
		unset($items[$key]["categories"][$index]);
	}
	else if ($_GET["action"] == "set")
	{
		if (($key = data_get($items, "name", $_GET["item"])) === FALSE)
			return ("Item not found ". $_GET["item"]);
		if (($items[$key]["stock"] = intval($_POST["stock"])) < 0)
			return ("Invalid stock");
		if (($items[$key]["price"] = floatval($_POST["price"])) < 0)
			return ("Invalid price");
	}
	if (!items_save($items))
		return ("Cannot save items");
	return (TRUE);
}

$PANELS = array(
	"users" => user_action,
	"categories" => categories_action,
	"items" => items_action
);

if (isset($PANELS[$_GET["panel"]]))
{
	if (($error = $PANELS[$_GET["panel"]]()) === TRUE)
		header("Location: admin.php?panel=". $_GET["panel"]);
	else
		header("Location: admin.php?panel=". $_GET["panel"] ."&error=". $error);
}
else
	header("Location: admin.php?panel=&error=Error");

?>
