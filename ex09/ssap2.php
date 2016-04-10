#!/usr/bin/php
<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   ssap2.php                                          :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/05 11:00:56 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/05 12:43:53 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

function ssap_cmp_type($c)
{
	$c = ord($c);
	if ($c >= ord('a') && $c <= ord('z'))
		return (0);
	else if ($c >= ord('0') && $c <= ord('9'))
		return (1);
	return (2);
}

function ssap_cmp($a, $b)
{
	$a = strtolower($a);
	$b = strtolower($b);
	$len = min(strlen($a), strlen($b));
	for ($i = 0; $i < $len; $i++)
	{
		if (($tmp = ssap_cmp_type($a[$i]) - ssap_cmp_type($b[$i])) != 0)
			return ($tmp);
		else if (($tmp = ord($a[$i]) - ord($b[$i])) != 0)
			return ($tmp);
	}
	return (strlen($a) - strlen($b));
}

function empty_filter($str)
{
	return (strlen($str) > 0);
}

$words = [];

for ($i = 1; $i < $argc; $i++)
	$words = array_merge($words, array_filter(explode(" ", $argv[$i]), empty_filter));

usort($words, ssap_cmp);

foreach ($words as $w)
	echo "$w\n";

?>
