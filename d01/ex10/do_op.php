#!/usr/bin/php
<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   do_op.php                                          :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/05 11:00:56 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/05 12:31:55 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

function op_plus($a, $b)
{
	return ($a + $b);
}

function op_minus($a, $b)
{
	return ($a - $b);
}

function op_mul($a, $b)
{
	return ($a * $b);
}

function op_div($a, $b)
{
	return ($a / $b);
}

function op_mod($a, $b)
{
	return ($a % $b);
}

$ops = array(
	"+" => op_plus,
	"-" => op_minus,
	"*" => op_mul,
	"/" => op_div,
	"%" => op_mod
);

if ($argc != 4)
{
	echo "Incorrect Parameters";
}
else
{
	$op = trim($argv[2]);
	if (isset($ops[$op]))
		echo $ops[$op]($argv[1], $argv[3]) . "\n";
}

?>
