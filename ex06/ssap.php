#!/usr/bin/php
<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   ssap.php                                           :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/05 11:00:56 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/05 12:22:42 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

function empty_filter($str)
{
	return (strlen($str) > 0);
}

$words = [];

for ($i = 1; $i < $argc; $i++)
	$words = array_merge($words, array_filter(explode(" ", $argv[$i]), empty_filter));

sort($words);

foreach ($words as $w)
	echo "$w\n";

?>
