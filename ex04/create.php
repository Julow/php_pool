<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   create.php                                         :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/08 15:46:45 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/08 16:08:45 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

include "auth.php";

if (isset($_POST["submit"]) && $_POST["submit"] == "OK"
	&& ($users = load_users()) !== FALSE
	&& ($users = user_add($users, $_POST["login"], $_POST["passwd"])) !== FALSE
	&& save_users($users))
{
	header("Location: index.html");
	echo "OK\n";
}
else
{
	header("Location: create.html");
	echo "ERROR\n";
}

?>
