<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   select.php                                         :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/15 13:31:35 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/15 14:37:10 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

$LIST_FILE = "list.csv";

if (($f = @fopen($LIST_FILE, "r+")) === FALSE)
	return (1);

while (($line = fgetcsv($f, 0, ";")) !== FALSE)
	echo $line[0] . ";" . urlencode($line[1]) . "\n";

fclose($f);

?>
