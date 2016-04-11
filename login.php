<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   login.php                                          :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/09 15:23:34 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/09 17:05:25 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

include "srcs/init.php";

$fail = FALSE;

if ($_SESSION["logged_user"])
{
	header("Location: index.php");
	echo "Already logged in.\n";
	exit (0);
}

// TODO: split
if (isset($_POST["submit"]) && $_POST["submit"] == "OK")
{
	include "srcs/auth.php";

	if (($users = load_users()) !== FALSE
		&& ($user_data = user_auth($users, $_POST["login"], $_POST["passwd"])) !== FALSE)
	{
		$_SESSION["logged_user"] = $_POST["login"];
		$_SESSION["is_admin"] = $user_data["admin"];
		header("Location: index.php");
		echo "Welcome back\n";
		exit(0);
	}
	$fail = TRUE;
}

$data["page_title"] = "login";

?>
<!DOCTYPE html>
<html>
<head>

<?php include "fragments/head.php"; ?>

</head>
<body>

<?php include "fragments/header.php"; ?>

<section class="content">

	<?php if ($fail) { ?>

	<p class="error">Invalid login/password</p>

	<?php } ?>

	<form class="login_form" action="login.php" method="post">
		<p><label for="input_login">Login:</label>
		<input type="text" id="input_login" name="login" /></p>
		<p><label for="input_passwd">Password:</label>
		<input type="password" id="input_passwd" name="passwd" /></p>
		<p><input type="submit" name="submit" value="OK" /></p>
	</form>

	<p><a href="register.php">Register</a></p>

</section>

<?php include "fragments/footer.php"; ?>

</body>
</html>
