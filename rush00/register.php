<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   register.php                                       :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/09 15:23:34 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/09 16:53:54 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

include "srcs/init.php";

$error = [];

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

	if (!preg_match('/^[\w-]{4,}$/', $_POST["login"]))
		$error[] = "Invalid user name";
	if (strlen($_POST["passwd"]) < 8)
		$error[] = "Password too short";
	if ($_POST["passwd"] !== $_POST["passwd_repeat"])
		$error[] = "Password did not match";
	if (!preg_match('/^[\w\.-]+@[\w\.-]+\.\w+$/', $_POST["email"]))
		$error[] = "Invalid email";
	if (($users = load_users()) === FALSE
		|| ($users = user_add($users, $_POST["login"], $_POST["passwd"], array(
				"email" => $_POST["email"]
			))) === FALSE)
		$error[] = "User already exists";
	if (count($error) == 0)
	{
		if (!save_users($users))
			$error[] = "Lol";
		else
		{
			header("Location: login.php");
			exit(0);
		}
	}
}

$data["page_title"] = "register";

?>
<!DOCTYPE html>
<html>
<head>

<?php include "fragments/head.php"; ?>

</head>
<body>

<?php include "fragments/header.php"; ?>

<section class="content">

	<?php if (count($error)) { ?>

	<p class="error"><?php echo join("<br />", $error); ?></p>

	<?php } ?>

	<form class="login_form" action="register.php" method="post">
		<p><label for="input_login">Login:</label>
		<input type="text" id="input_login" name="login" /></p>
		<p><label for="input_passwd">Password:</label>
		<input type="password" id="input_passwd" name="passwd" /></p>
		<p><label for="input_passwd_repeat">Repeat password:</label>
		<input type="password" id="input_passwd_repeat" name="passwd_repeat" /></p>
		<p><label for="input_email">email:</label>
		<input type="passwd" id="input_email" name="email" /></p>
		<p><input type="submit" name="submit" value="OK" /></p>
	</form>

	<p><a href="login.php">Login</a></p>

</section>

<?php include "fragments/footer.php"; ?>

</body>
</html>
