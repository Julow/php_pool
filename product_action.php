<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   product_action.php                                 :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/10 16:38:31 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/10 19:51:49 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

include "srcs/init.php";
include "srcs/cart.php";

function product_action($action)
{
	if ($action == "add")
	{
		if (($error = add_to_cart($_GET["item"])) !== TRUE)
			return ($error);
	}
	return (TRUE);
}

if (($error = product_action($_GET["action"])) === TRUE)
	header("Location: index.php?category=" . $_GET["category"]);
else
	header("Location: index.php?error=" . $error . "&category=" . $_GET["category"]);

?>
