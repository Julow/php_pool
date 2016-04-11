<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   cart_action.php                                    :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/10 16:38:31 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/10 19:41:39 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

include "srcs/init.php";
include "srcs/cart.php";
include "srcs/commands.php";

function cart_action($action)
{
	if ($action == "set_q")
	{
		if (($error = cart_set_q($_GET["item"], intval($_GET["q"]))) !== TRUE)
			return ($error);
	}
	else if ($action == "delete")
	{
		if (!cart_delete($_GET["item"]))
			return ("Error");
	}
	else if ($action == "validate")
	{
		if (!$_SESSION["logged_user"])
		{		
			header("Location: login.php");
			exit (0);
		}
		command_validate();
	}
	return (TRUE);
}

if (($error = cart_action($_GET["action"])) === TRUE)
	header("Location: cart.php");
else
	header("Location: cart.php?error=". $error);

?>
