#!/usr/bin/php
<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   epur_str.php                                       :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/05 10:51:12 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/05 12:22:35 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

function empty_filter($str)
{
	return (strlen($str) > 0);
}

if ($argc == 2)
	echo implode(" ", array_filter(explode(" ", $argv[1]), empty_filter)) . "\n";

?>
