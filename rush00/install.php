<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   install.php                                        :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/09 10:49:16 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/10 20:10:50 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

include "srcs/items.php";
include "srcs/categories.php";
include "srcs/auth.php";

categories_save([]);
save_users([]);
items_save([]);

	// "name" => $item_name,
	// "categories" => [],
	// "stock" => intval($_POST["stock"]),
	// "price" => floatval($_POST["price"])

// php
$categories[] = "Librairie Standard";
$categories[] = "Librairie PCRE";

$items[] = array("name" => "fopen", "categories" => [$categories[0]], "stock" => 10, "price" => 0.02);
$items[] = array("name" => "print_r", "categories" => [$categories[0]], "stock" => 10, "price" => 0.02);
$items[] = array("name" => "arsort", "categories" => [$categories[0]], "stock" => 20, "price" => 0.10);
$items[] = array("name" => "preg_grep", "categories" => [$categories[1]], "stock" => 10, "price" => 0.02);
$items[] = array("name" => "preg_match", "categories" => [$categories[1]], "stock" => 10, "price" => 0.02);

$items[] = array("name" => "hello", "categories" => [$categories[0], $categories[0]], "stock" => 20, "price" => 0.10);
$users = [];

categories_save($categories);
save_users($users);
items_save($items);
?>
