<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   file_save.php                                      :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/09 13:49:35 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/10 14:22:01 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

$PRIVATE_DIR = "../private/";

if (!$file_name_h)
{
	$file_name_h = true;

function load_from_file($file_name)
{
	global $PRIVATE_DIR;

	$file_name = $PRIVATE_DIR . $file_name;
	if (($f = @fopen($file_name, "r")) === FALSE)
		return ([]);
	if (!flock($f, LOCK_SH))
		$data = [];
	else
		$data = @unserialize(@file_get_contents($file_name));
	fclose($f);
	if ((array)$data !== $data)
		return ([]);
	return ($data);
}

function save_to_file($file_name, $data)
{
	global $PRIVATE_DIR;

	$file_name = $PRIVATE_DIR . $file_name;
	if ((!file_exists($PRIVATE_DIR) && !@mkdir($PRIVATE_DIR))
		|| ($f = fopen($file_name, "w")) === FALSE)
		return (FALSE);
	$ok = FALSE;
	if (flock($f, LOCK_EX))
	{
		if (@file_put_contents($file_name, serialize($data)) !== FALSE)
			$ok = TRUE;
		flock($f, LOCK_UN);
	}
	fclose($f);
	return ($ok);
}

/*
** Search for an element of $data
**  where $data[$key][$field] === $match
** Return $key
*/
function data_get($data, $field, $match)
{
	foreach ($data as $key => $value)
		if ($value[$field] === $match)
			return ($key);
	return (FALSE);
}

}
?>
