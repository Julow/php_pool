<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   insert.php                                         :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/15 13:31:35 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/15 14:37:26 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

$LIST_FILE = "list.csv";

if (!isset($_GET["todo"]) || strlen($_GET["todo"]) == 0
	|| ($f = @fopen($LIST_FILE, "c+")) === FALSE)
{
	header("HTTP/1.1 405 Method Not Allowed");
	return (1);
}

$tmp = 0;
while (($line = fgetcsv($f, 0, ";")) !== FALSE)
	$tmp = intval($line[0]);

$todo_id = strval($tmp + 1);

fputcsv($f, [$todo_id, $_GET["todo"]], ";");

fclose($f);

echo $todo_id;

?>
