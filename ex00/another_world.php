#!/usr/bin/php
<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   another_world.php                                  :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/05 11:00:56 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/06 10:22:49 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

if ($argc > 1)
	echo implode(" ", preg_split("/[ \t]+/", $argv[1], -1, PREG_SPLIT_NO_EMPTY)) . "\n";

?>
