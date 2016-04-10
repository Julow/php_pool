#!/usr/bin/php
<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   who.php                                            :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/07 08:14:37 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/07 15:42:48 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

date_default_timezone_set("Europe/Paris");
if (($f = fopen("/var/run/utmpx", "r")) !== FALSE)
	while (($data = fread($f, 0x274)) !== FALSE)
	{
		if (strlen($data) != 0x274)
			break ;
		$data = unpack("Z256name/Z4garbage/Z32line/Igarbage2/Itype/ltime", $data);
		if ($data["type"] == 7)
			printf("%-8s %-8s %s\n",
				$data["name"], $data["line"], strftime("%b %e %H:%M", $data["time"]));
	}

?>
