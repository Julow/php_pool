<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   admin.php                                          :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/09 10:49:16 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/10 19:36:14 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

include "srcs/init.php";
include "srcs/auth.php";

include "srcs/categories.php";
include "srcs/items.php";
include "srcs/commands.php";

if (!$_SESSION["logged_user"] || $_SESSION["is_admin"] !== TRUE
	|| ($tmp = user_get($users = load_users(), $_SESSION["logged_user"])) === FALSE
	|| !$tmp["admin"])
{
	header("Location: index.php");
	echo "Unautorized user\n";
	exit (0);
}

$data["css"][] = "res/admin.css";

?>
<!DOCTYPE html>
<html>
<head>

<?php include "fragments/head.php"; ?>

</head>
<body>

<?php include "fragments/header.php"; ?>

	<section class="content">

	<?php if ($_GET["error"]) { ?>
		<div class="error"><?php echo $_GET["error"]; ?></div>
	<?php } ?>

<?php if ($_GET["panel"] == "users") { ?>

		<h1>Add user</h1>
		<form class="login_form" action="admin_action.php?panel=users&action=add_user" method="POST">
			<div><label for="input_login">Login</label><input id="input_login" type="text" name="login" /></div>
			<div><label for="input_passwd">Password</label><input id="input_passwd" type="password" name="passwd" /></div>
			<div><label for="input_email">Email</label><input id="input_email" type="text" name="email" /></div>
			<div><input type="submit" name="submit" value="Add" /></div>
		</form>

		<h1>User list</h1>
		<table>
			<tr><th>User name</th><th>Email</th><th>Admin</th><th>Register date</th><th>Last login</th><th></th></tr>
<?php foreach ($users as $user_data) { ?>
			<tr>
				<td><?php echo $user_data["login"]; ?></td>
				<td><?php echo $user_data["email"]; ?></td>
				<td><?php echo $user_data["admin"] ? "ADMIN" : "normal user"; ?></td>
				<td><?php echo $user_data["register_date"]; ?></td>
				<td><?php echo $user_data["last_login"]; ?></td>
				<?php $lol = $user_data["admin"] ? ["unsetadmin", "Unset admin"] : ["setadmin", "Set admin"]; ?>
				<td><a href="admin_action.php?panel=users&action=delete&user=<?php echo $user_data["login"]; ?>">delete</a>
				<a href="admin_action.php?panel=users&action=<?php echo $lol[0]; ?>&user=<?php echo $user_data["login"]; ?>"><?php echo $lol[1]; ?></a></td>
			</tr>
<?php } ?>
		</table>

<?php } else if ($_GET["panel"] == "categories") { ?>

		<h1>Create Category</h1>
		<form class="login_form" action="admin_action.php?panel=categories&action=add_category" method="POST">
			<div><label for="input_category">Name: </label><input id="input_category" type="text" name="category" /></div>
			<div><input type="submit" name="submit" value="create" /></div>
		</form>

	<?php if (($categories = categories_load()) !== FALSE) { ?>
		<h1>User list</h1>
		<table>
			<tr><th>Id</th><th>category</th></th><th></th></tr>
		<?php foreach ($categories as $key => $category) { ?>
			<tr>
				<td><?php echo $key; ?></td>
				<td><?php echo $category; ?></td>
				<td><a href="admin_action.php?panel=categories&action=delete&category=<?php echo $category; ?>">delete</a>
			</tr>
		<?php } ?>
		</table>
	<?php } ?>

<?php } else if ($_GET["panel"] == "items") { ?>

<?php

if (($categories = categories_load()) === FALSE)
	$categories = [];

?>

		<h1>Create Item</h1>
		<form class="login_form" action="admin_action.php?panel=items&action=add_item" method="POST">
			<div><label for="input_item">Name: </label><input id="input_item" type="text" name="item" /></div>
			<div><label for="input_stock">Stock: </label><input id="input_stock" type="number" name="stock" /></div>
			<div><label for="input_price">Price: </label><input id="input_price" type="number" step="0.01" name="price" /></div>
			<div><input type="submit" name="submit" value="create" /></div>
		</form>

	<?php if (($items = items_load()) !== FALSE) { ?>
		<h1>Item list</h1>
		<table>
			<tr><th>Id</th><th>Name</th><th>Categories</th><th></th><th></th></tr>
		<?php foreach ($items as $key => $item) { ?>
			<tr>
				<td><?php echo $key; ?></td>
				<td><?php echo $item["name"]; ?></td>
				<td><ul><?php foreach ($item["categories"] as $category) { ?>
					<li><?php echo $category; ?> <a href="admin_action.php?panel=items&action=del_category&item=<?php echo $item["name"]; ?>&category=<?php echo $category; ?>">del</a></li>
				<?php } ?></ul>
				<form action="admin_action.php?panel=items&action=add_category&item=<?php echo $item["name"]; ?>" method="POST">
					<select name="category">
					<?php foreach ($categories as $category) { ?>
						<option value="<?php echo $category; ?>"><?php echo $category; ?></option>
					<?php } ?>
					</select>
					<input type="submit" value="add" />
				</form></td>
				<td><form action="admin_action.php?panel=items&action=set&item=<?php echo $item["name"]; ?>" method="POST">
					Stock: <input type="number" name="stock" value="<?php echo $item["stock"]; ?>" /><br />
					Price: <input type="number" name="price" step="0.01" value="<?php echo $item["price"]; ?>" /><br />
					<input type="submit" value="set" />
				</form></td>
				<td><a href="admin_action.php?panel=items&action=delete&item=<?php echo $item["name"]; ?>">delete</a></td>
			</tr>
		<?php } ?>
		</table>
	<?php } ?>

<?php } else if ($_GET["panel"] == "commands") { ?>

	<?php if (($commands = commands_load()) !== FALSE) { ?>
		<h1>Commands list</h1>
		<table>
			<tr><th>Id</th><th>User</th><th>Items</th><th>Total</th></tr>
		<?php foreach ($commands as $key => $cmd) { ?>
			<tr>
				<td><?php echo $key; ?></td>
				<td><?php echo $cmd["user_name"]; ?></td>
				<td><ul><?php
					foreach ($cmd["items"] as $item)
						echo "<li>" . $item["name"] . ": " . $item["price"] . " * " . $item["quantity"] . "</li>";
				?></ul></td>
				<td><?php echo $cmd["total"]; ?></td>
			</tr>
		<?php } ?>
		</table>
	<?php } ?>

<?php } else { ?>

<?php

if (($categories = categories_load()) === FALSE)
	$categories = [];
if (($items = items_load()) === FALSE)
	$items = [];

?>

		<p>Nombre d'utilisateur: <?php echo count($users);?></p>
		<p>Nombre de catégories: <?php echo count($categories);?></p>
		<p>Nombre d'articles différents: <?php echo count($items);?></p>

<?php } ?>

	</section>

<?php include "fragments/footer.php"; ?>

</body>
</html>
