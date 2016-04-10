<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   login.php                                          :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/08 15:21:29 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/08 15:32:21 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

session_start();

include "auth.php";

if (auth($_GET["login"], $_GET["passwd"]))
{
	$_SESSION["loggued_on_user"] = $_GET["login"];
	echo "OK\n";
}
else
{
	$_SESSION["loggued_on_user"] = "";
	echo "ERROR\n";
}

?>
