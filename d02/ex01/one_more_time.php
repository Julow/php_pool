#!/usr/bin/php
<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   one_more_time.php                                  :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/06 12:24:51 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/06 14:23:29 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

$DAYS = array(
	"lundi"					=> 0,
	"mardi"					=> 0,
	"mercredi"				=> 0,
	"jeudi"					=> 0,
	"vendredi"				=> 0,
	"samedi"				=> 0,
	"dimanche"				=> 0
);

$MONTHS = array(
	"janvier"				=> [1, 31],
	"février"				=> [2, 28],
	"fevrier"				=> [2, 28],
	"mars"					=> [3, 31],
	"avril"					=> [4, 30],
	"mai"					=> [5, 31],
	"juin"					=> [6, 30],
	"juillet"				=> [7, 31],
	"août"					=> [8, 31],
	"aout"					=> [8, 31],
	"septembre"				=> [9, 30],
	"octobre"				=> [10, 31],
	"novembre"				=> [11, 30],
	"décembre"				=> [12, 31],
	"decembre"				=> [12, 31]
);

function one_more_time($arg)
{
	global $DAYS;
	global $MONTHS;

	$matches = [];
	date_default_timezone_set("Europe/Paris");
	if (!preg_match('/^([a-zA-Z][a-z]+) (\d{1,2}) ([a-zA-Z][ûéa-z]+) (\d{4}) (\d{2}):(\d{2}):(\d{2})$/', $arg, $matches)
		|| !isset($DAYS[strtolower($matches[1])])
		|| !isset($MONTHS[($month = strtolower($matches[3]))])
		|| ($day = intval($matches[2])) > $MONTHS[$month][1]
		|| ($year = intval($matches[4])) < 1970
		|| ($hour = intval($matches[5])) >= 24
		|| ($min = intval($matches[6])) >= 60
		|| ($sec = intval($matches[7])) >= 60
		|| ($t = mktime($hour, $min, $sec, $MONTHS[$month][0], $day, $year)) === FALSE)
		return (FALSE);
	echo "$t\n";
	return (TRUE);
}

if ($argc > 1 && !one_more_time($argv[1]))
	echo "Wrong Format\n";

?>
