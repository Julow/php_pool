#!/usr/bin/php
<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   do_op_2.php                                        :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/05 11:00:56 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/05 18:22:02 by jaguillo         ###   ########.fr       //
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
	if ($b == 0)
		return (FALSE);
	return ($a / $b);
}

function op_mod($a, $b)
{
	if ($b == 0)
		return (FALSE);
	return ($a % $b);
}

$ops = array(
	"+" => op_plus,
	"-" => op_minus,
	"*" => op_mul,
	"/" => op_div,
	"%" => op_mod
);

function next_number($str)
{
	$comma = FALSE;
	$i = (strlen($str) > 0 && $str[0] == '-') ? 1 : 0;
	for (; $i < strlen($str); $i++)
	{
		$c = ord($str[$i]);
		if ($c >= ord('0') && $c <= ord('9'))
			continue ;
		if ($str[$i] != '.' || $comma)
			break ;
		$comma = TRUE;
	}
	return ($i);
}

function do_op_2($arg)
{
	global $ops;
	if (($tmp = next_number($arg)) == 0)
		return (FALSE);
	$num1 = floatval(substr($arg, 0, $tmp));
	if (strlen(($arg = ltrim(substr($arg, $tmp)))) == 0
		|| !isset($ops[($op = $arg[0])])
		|| ($tmp = next_number(($arg = ltrim(substr($arg, 1))))) == 0)
		return (FALSE);
	$num2 = floatval(substr($arg, 0, $tmp));
	if (strlen(ltrim(substr($arg, $tmp))) > 0)
		return (FALSE);
	if (($res = $ops[$op]($num1, $num2)) === FALSE)
		return (FALSE);
	echo "$res\n";
	return (TRUE);
}

if ($argc != 2)
	echo "Incorrect Parameters\n";
else if (!do_op_2(trim($argv[1])))
	echo "Syntax Error\n";

?>
