<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   categories.php                                     :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/09 13:52:08 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/10 20:08:17 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

if (!$FILE_CATEGORIES_H)
{
	$FILE_CATEGORIES_H = TRUE;

include "file_save.php";
include "items.php";

$CATEGORIES_FILE = "categories.bdd";

function categories_load()
{
	global $CATEGORIES_FILE;

	return (load_from_file($CATEGORIES_FILE));
}

function categories_save($bdd_categories)
{
	global $CATEGORIES_FILE;

	return (save_to_file($CATEGORIES_FILE, $bdd_categories));
}

function categories_check($categories)
{
	if (($items = items_load()) === FALSE)
		return ;
	foreach ($items as $key => $value)
		foreach ($value["categories"] as $k => $c)
			if (array_search($c, $categories) === FALSE)
				unset($items[$key]["categories"][$k]);
	items_save($items);
}

}

?>
