#!/usr/bin/php
<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   loupe.php                                          :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/06 14:25:01 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/06 19:45:46 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

function param_match($str)
{
	// [1] = before text
	// [2] = param name=
	// [3] = param value
	// [4] = after text/next param
	return preg_replace_callback('/(.*?)(?:([a-z]+=)("[^"]*")(.*))?/s', function($matches)
	{
		return $matches[1] .
			((strlen($matches[2]) == 0) ? "" : $matches[2] . strtoupper($matches[3])) .
			((strlen($matches[4]) == 0) ? "" : param_match($matches[4]));
	}, $str);
}

function markup_match($str)
{
	// [1] = before text
	// [2] = markup if any
	// [3] = markup params
	return preg_replace_callback('/(.*?)(<([^>]*)>)?/s', function($matches)
	{
		return strtoupper($matches[1]) .
			((strlen($matches[2]) == 0) ? "" : "<" . param_match($matches[3]) . ">");
	}, $str);
}

function link_match($str)
{
	// [1] = params
	// [2] = text
	return preg_replace_callback('/<a([^>]*)>(.+?)<\/a>/s', function($matches)
	{
		return "<a" . param_match($matches[1]) . ">" . markup_match($matches[2]) . "</a>";
	}, $str);
}

$data = "";
if ($argc > 1 && ($f = fopen($argv[1], "r")) !== FALSE)
	while (($line = fgets($f)) !== FALSE)
		$data .= $line;
echo link_match($data);

?>
