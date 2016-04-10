#!/usr/bin/php
<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   srt.php                                            :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/07 15:45:05 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/07 16:13:10 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

function parse_next($f)
{
	$matches = [];
	if (($line = fgets($f)) === FALSE
		|| !preg_match('/^[0-9]+$/', $line)
		|| ($line = fgets($f)) === FALSE
		|| !preg_match('/^\d{2}:\d{2}:\d{2},\d{3} --> \d{2}:\d{2}:\d{2},\d{3}$/', $line, $matches)
		|| ($line = fgets($f)) === FALSE)
		return (FALSE);
	return ([$matches[0], $line]);
}

function date_cmp($a, $b)
{
	return (strcmp($a[0], $b[0]));
}

if ($argc != 2 || ($f = fopen($argv[1], "r")) === FALSE)
	return (FALSE);

$data = [];

while (TRUE)
{
	if (($tmp = parse_next($f)) === FALSE)
		return (FALSE);
	array_push($data, $tmp);
	if (($line = fgets($f)) === FALSE)
		break ;
	if (strlen($line) > 1)
		return (FALSE);
}

fclose($f);

usort($data, date_cmp);

for ($i = 0; $i < count($data); $i++)
{
	echo $i+1 . "\n" . $data[$i][0] . "\n";
	echo $data[$i][1] . (($i + 1 < count($data)) ? "\n" : "");
}

?>
