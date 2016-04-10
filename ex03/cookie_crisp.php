<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   cookie_crisp.php                                   :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/07 19:02:33 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/07 19:20:07 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

function action_get()
{
	if (isset($_GET["name"]) && isset($_COOKIE[$_GET["name"]]))
		echo $_COOKIE[$_GET["name"]];
}

function action_set()
{
	if (isset($_GET["name"]) && isset($_GET["value"]))
		setcookie($_GET["name"], $_GET["value"], time() + (30 * 24 * 60 * 60));
}

function action_del()
{
	if (isset($_GET["name"]))
		setcookie($_GET["name"], "", time() - (30 * 24 * 60 * 60));
}

$ACTIONS = array(
	"get" => action_get,
	"set" => action_set,
	"del" => action_del
);

if (isset($_GET["action"]) && isset($ACTIONS[$_GET["action"]]))
	$ACTIONS[$_GET["action"]]();

?>
