<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   modif.php                                          :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/08 14:05:55 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/08 14:27:17 by jaguillo         ###   ########.fr       //
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

function user_get($users, $login)
{
	foreach ($users as $user_data)
		if ($user_data["login"] == $login)
			return ($user_data);
	return (FALSE);
}

function user_chpasswd($users, $login, $old_passwd, $new_passwd)
{
	if ($login == "" || $old_passwd == "" || $new_passwd == "")
		return (FALSE);
	for ($i = 0; $i < count($users); $i++)
	{
		if ($users[$i]["login"] == $login)
		{
			if ($users[$i]["passwd"] != hash("whirlpool", $old_passwd))
				return (FALSE);
			$users[$i]["passwd"] = hash("whirlpool", $new_passwd);
			return ($users);
		}
	}
	return (FALSE);
}

function user_add($users, $login, $passwd)
{
	if ($login === "" || $passwd === ""
		|| user_get($users, $login) !== FALSE)
		return (FALSE);
	$users[] = array(
		"login" => $login,
		"passwd" => hash("whirlpool", $passwd)
	);
	return ($users);
}

echo (isset($_POST["submit"]) && $_POST["submit"] == "OK"
	&& ($users = load_users()) !== FALSE
	&& ($users = user_chpasswd($users, $_POST["login"], $_POST["oldpw"], $_POST["newpw"])) !== FALSE
	&& save_users($users))
		? "OK\n" : "ERROR\n";

?>
