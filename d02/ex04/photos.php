#!/usr/bin/php
<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   photos.php                                         :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/07 08:14:37 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/07 17:43:07 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

function dump_url($url)
{
	if (($curl = curl_init($url)) === FALSE)
		return (FALSE);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
	$data = curl_exec($curl);
	curl_close($curl);
	return ($data);
}

function get_photos($data)
{
	$matches = [];
	if (($count = preg_match_all('/<img (?:.*?)src=(?:"([^"]+)"|([^> ]+))?(?:.*?)>/si', $data, $matches)) === FALSE)
		return (FALSE);
	$photos = [];
	for ($i = 0; $i < $count; $i++)
		if (strlen($matches[1][$i]) > 0)
			array_push($photos, $matches[1][$i]);
		else if (strlen($matches[2][$i]) > 0)
			array_push($photos, $matches[2][$i]);
	return (array_unique($photos));
}

if ($argc > 1
	&& ($hostname = parse_url($argv[1], PHP_URL_HOST)) !== FALSE
	&& ($data = dump_url($argv[1])) !== FALSE
	&& ($photos = get_photos($data)) !== FALSE)
{
	@mkdir($hostname);
	foreach ($photos as $url)
		if (($filename = parse_url($url, PHP_URL_PATH)) !== FALSE
			&& strlen($filename) > 0
			&& ($data = dump_url($url)) !== FALSE)
		{
			$filename = array_slice(explode("/", $filename), -1)[0];
			file_put_contents($hostname . "/" . $filename, $data);
		}
}

?>
