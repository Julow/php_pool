#!/usr/bin/php
<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   agent_stats.php                                    :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/05 11:00:56 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/05 15:58:28 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

function mode_moyenne($data)
{
	$count = 0;
	$sum = 0;
	foreach ($data as $user => $tab)
	{
		$count += count($tab[0]);
		foreach ($tab[0] as $n)
			$sum += $n;
	}
	if ($count > 0)
		echo $sum / $count . "\n";
}

function average($tab)
{
	$sum = 0;
	foreach ($tab as $data)
		$sum += $data;
	return ($sum / count($tab));
}

function mode_moyenne_user($data)
{
	ksort($data);
	foreach ($data as $user => $tab)
	{
		if (count($tab[0]) > 0)
			echo $user . ":" . average($tab[0]) . "\n";
	}
}

function mode_ecart_moulinette($data)
{
	ksort($data);
	foreach ($data as $user => $tab)
	{
		if (count($tab[0]) > 0 && count($tab[1]) > 0)
			echo $user . ":" . (average($tab[0]) - average($tab[1])) . "\n";
	}
}

function parse_csv()
{
	$data = array();
	if (!fgetcsv(STDIN, 0, ';'))
		return ($data);
	while (($entry = fgetcsv(STDIN, 0, ';')) !== FALSE)
	{
		if (count($entry) != 4)
			continue ;
		if (!isset($data[$entry[0]]))
			$data[$entry[0]] = [[], []];
		if (strlen($entry[1]) > 0)
			$data[$entry[0]][($entry[2] == "moulinette") ? 1 : 0][] = floatval($entry[1]);
	}
	return ($data);
}

$MODES = array(
	"moyenne" => mode_moyenne,
	"moyenne_user" => mode_moyenne_user,
	"ecart_moulinette" => mode_ecart_moulinette
);

if ($argc == 2 && isset($MODES[$argv[1]]))
	$MODES[$argv[1]](parse_csv());

?>
