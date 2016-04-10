<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   index.php                                          :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/08 09:55:24 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/08 10:45:01 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

session_start();

if (isset($_GET["submit"]) && $_GET["submit"] == "OK")
{
	$_SESSION["user_login"] = $_GET["login"];
	$_SESSION["user_passwd"] = $_GET["passwd"];
}

$user_login = $_SESSION["user_login"];
$user_passwd = $_SESSION["user_passwd"];

?>
<!DOCTYPE html>
<html>
<head>
	<title>lol</title>
</head>
<body>

<form action="index.php" method="GET">
	Identifiant: <input type="text" name="login" value="<?php echo $user_login; ?>" />
	<br />
	Mot de passe: <input type="password" name="passwd" value="<?php echo $user_passwd; ?>" />
	<br />
	<input type="submit" name="submit" value="OK" />
</form>

</body></html>
