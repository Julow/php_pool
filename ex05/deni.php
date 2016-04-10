#!/usr/bin/php
<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   deni.php                                           :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/07 08:14:37 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/07 13:20:24 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

function parse_data($f, $key)
{
	$keys = fgetcsv($f, 0, ";");
	$data = array();
	if (($key_index = array_search($key, $keys)) === FALSE)
		return (FALSE);
	while (($line = fgetcsv($f, 0, ";")) !== FALSE)
		for ($i = 0; $i < count($keys); $i++)
			$data[$keys[$i]][$line[$key_index]] = $line[$i];
	return ($data);
}

function eval_loop($data)
{
	foreach ($data as $var => $val)
		eval('$' . $var . ' = $data[$var];');
	while (TRUE)
	{
		echo "Entrez votre commande: ";
		if (($line = fgets(STDIN)) === FALSE)
			break ;
		eval($line);
	}
	echo "\n";
}

if ($argc > 2 && ($f = fopen($argv[1], "r")) !== FALSE)
{
	if (($data = parse_data($f, $argv[2])) !== FALSE)
		eval_loop($data);
	fclose($f);
}

?>
