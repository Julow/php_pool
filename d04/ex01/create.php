<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   create.php                                         :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/08 10:53:39 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/08 14:03:07 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

$PRIVATE_DIR = "../private";
$PASSWD_FILE = "../private/passwd";

function load_users()
{
	global $PASSWD_FILE;

	if (!file_exists($PASSWD_FILE))
		return ([]);
	$users = @unserialize(@file_get_contents($PASSWD_FILE));
	if ((array)$users !== $users)
		return ([]);
	return ($users);
}

function save_users($users)
{
	global $PASSWD_FILE;
	global $PRIVATE_DIR;

	return ((file_exists($PRIVATE_DIR) || @mkdir($PRIVATE_DIR))
		&& @file_put_contents($PASSWD_FILE, serialize($users)) !== FALSE);
}

function get_user($users, $login)
{
	foreach ($users as $user_data)
		if ($user_data["login"] == $login)
			return ($user_data);
	return (FALSE);
}

function add_user($users, $login, $passwd)
{
	if ($login === "" || $passwd === ""
		|| get_user($users, $login) !== FALSE)
		return (FALSE);
	$users[] = array(
		"login" => $login,
		"passwd" => hash("whirlpool", $passwd)
	);
	return ($users);
}

echo (isset($_POST["submit"]) && $_POST["submit"] == "OK"
	&& ($users = load_users()) !== FALSE
	&& ($users = add_user($users, $_POST["login"], $_POST["passwd"])) !== FALSE
	&& save_users($users))
		? "OK\n" : "ERROR\n";

?>
