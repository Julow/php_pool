#!/usr/bin/php
<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   rostring.php                                       :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/05 11:00:56 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/05 12:22:51 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

function empty_filter($str)
{
	return (strlen($str) > 0);
}

if ($argc > 1)
{
	$words = array_filter(explode(" ", $argv[1]), empty_filter);
	if (count($words) > 1)
	{
		$del = array_splice($words, 0, 1);
		$words = array_merge($words, $del);
	}
	echo implode(" ", $words) . "\n";
}

?>
