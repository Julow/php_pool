#!/usr/bin/php
<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   search_it!.php                                     :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/05 11:00:56 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/05 14:37:44 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

if ($argc > 1)
{
	$key = $argv[1];
	$table = array();
	for ($i = 2; $i < $argc; $i++)
	{
		$entry = explode(':', $argv[$i], 2);
		$table[$entry[0]] = isset($entry[1]) ? $entry[1] : "";
	}
	if (isset($table[$key]))
		echo $table[$key] . "\n";
}

?>
