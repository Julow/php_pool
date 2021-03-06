<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   chat.php                                           :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/08 15:46:45 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/08 17:43:39 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

session_start();

include "auth.php";

if (!isset($_SESSION["loggued_on_user"]) || $_SESSION["loggued_on_user"] == "")
{
	echo "ERROR\n";
	exit(1);
}

date_default_timezone_set("Europe/Paris");

?>
<!DOCTYPE html>
<html>
<head>
	<title>chat</title>
</head>
<body>

<?php

$messages = load_from_file("chat");

foreach ($messages as $data)
	echo date("[H:i] ", $data["time"]) ."<b>". $data["login"] ."</b>: ". $data["msg"] ."<br />\n";

?>

</body>
</html>
