<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   items.php                                          :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/09 13:52:08 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/10 17:08:00 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

if ($FILE_ITEMS_H !== TRUE)
{
	$FILE_ITEMS_H = TRUE;

include "file_save.php";

$ITEMS_FILE = "items.bdd";

function items_load()
{
	global $ITEMS_FILE;

	return (load_from_file($ITEMS_FILE));
}

function items_save($bdd_items)
{
	global $ITEMS_FILE;

	return (save_to_file($ITEMS_FILE, $bdd_items));
}

}

?>
