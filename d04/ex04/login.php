<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   login.php                                          :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/08 15:46:45 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/08 16:13:03 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

session_start();

include "auth.php";

if (!auth($_POST["login"], $_POST["passwd"]))
{
	echo "ERROR\n";
	exit(1);
}

$_SESSION["loggued_on_user"] = $_POST["login"];

?>
<!DOCTYPE html>
<html>
<head>
	<title>42chat</title>
</head>
<body>

<iframe name="chat" width="100%" height="550px" src="chat.php"></iframe>
<iframe name="speak" width="100%" height="50px" src="speak.php"></iframe>

</body>
</html>
