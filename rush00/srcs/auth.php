<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   auth.php                                           :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/09 13:52:08 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/10 14:42:14 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

include "file_save.php";

$PASSWD_FILE = "passwd";
$PASSWD_HASH = "whirlpool";
$PASSWD_SALT = "PONEYYYYY_";
$ADMIN_LOGIN = "admin";
$ADMIN_PASSWD = "admin";

function load_users()
{
	global $PASSWD_FILE;
	global $ADMIN_LOGIN;
	global $ADMIN_PASSWD;

	$users = load_from_file($PASSWD_FILE);
	if (($admin = data_get($users, "login", $ADMIN_LOGIN)) === FALSE)
		$users[] = array(
			"login" => $ADMIN_LOGIN,
			"passwd" => user_genpass($ADMIN_PASSWD),
			"admin" => TRUE
		);
	else if ($users[$admin]["admin"] !== TRUE)
		$users[$admin]["admin"] = TRUE;
	return ($users);
}

function save_users($users)
{
	global $PASSWD_FILE;

	return (save_to_file($PASSWD_FILE, $users));
}

function user_genpass($pass)
{
	global $PASSWD_HASH;
	global $PASSWD_SALT;

	return (hash($PASSWD_HASH, $PASSWD_SALT . $pass));
}

function user_get($users, $login)
{
	if (($key = data_get($users, "login", $login)) === FALSE)
		return (FALSE);
	return ($users[$key]);
}

function user_chpasswd($users, $login, $old_passwd, $new_passwd)
{
	if ($login == "" || $old_passwd == "" || $new_passwd == "")
		return (FALSE);
	for ($i = 0; $i < count($users); $i++)
	{
		if ($users[$i]["login"] == $login)
		{
			if ($users[$i]["passwd"] != user_genpass($old_passwd))
				return (FALSE);
			$users[$i]["passwd"] = user_genpass($new_passwd);
			return ($users);
		}
	}
	return (FALSE);
}

function user_add($users, $login, $passwd, $data)
{
	if ($login === "" || $passwd === ""
		|| user_get($users, $login) !== FALSE)
		return (FALSE);
	$data["login"] = $login;
	$data["passwd"] = user_genpass($passwd);
	$data["admin"] = FALSE;
	$users[] = $data;
	return ($users);
}

function user_auth($users, $login, $passwd)
{
	if (($user = user_get($users, $login)) === FALSE
		|| $user["passwd"] != user_genpass($passwd))
		return (FALSE);
	return ($user);
}

?>
