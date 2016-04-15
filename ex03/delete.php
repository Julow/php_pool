<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   delete.php                                         :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/15 13:31:35 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/15 14:29:48 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

$LIST_FILE = "list.csv";

if (!isset($_GET["id"]) || strlen($_GET["id"]) == 0
	|| ($f_in = @fopen($LIST_FILE, "r")) === FALSE
	|| ($tmp_fname = tempnam("/tmp", "LOL")) === FALSE
	|| ($f_out = @fopen($tmp_fname, "w")) === FALSE)
{
	header("HTTP/1.1 405 Method Not Allowed");
	return (1);
}

while (($line = fgetcsv($f_in, 0, ";")) !== FALSE)
	if ($_GET["id"] != $line[0])
		fputcsv($f_out, $line, ";");

fclose($f_in);
fclose($f_out);

if (!rename($tmp_fname, $LIST_FILE))
	header("HTTP/1.1 405 Method Not Allowed");

?>
