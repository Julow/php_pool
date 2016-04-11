<?php

include "srcs/cart.php";
include "srcs/categories.php";

$data["main_color"] = "rgb(" . join(", ", [rand(50, 200), rand(80, 210), rand(40, 130)]) . ")";

?>
<div id="header" style="background-color: <?php echo $data["main_color"]; ?>;">
	<section>
		<h1 id="title"><?php echo $data["page_title"]; ?></h1>
	</section>
	<nav id="menu">
		<section>
			<ul class="menu menu-horizontal">

				<li><a href="index.php">Boutique</a><ul class="menu"><?php
				if (($categories = categories_load()) !== FALSE)
					foreach ($categories as $c) { ?>
						<li><a href="index.php?category=<?php echo $c; ?>"><?php echo $c; ?></a></li>
					<?php } ?>
				</ul></li>

				<?php if ($_SESSION["is_admin"] === TRUE) { ?>
					<li><a href="admin.php">Admin</a><ul class="menu">
							<li><a href="admin.php?panel=users">Users</a></li>
							<li><a href="admin.php?panel=categories">Categories</a></li>
							<li><a href="admin.php?panel=items">Items</a></li>
							<li><a href="admin.php?panel=commands">Commands</a></li>
					</ul></li>
				<?php } ?>

				<li style="float: right;"><a href="cart.php">Cart: <?php echo cart_size(); ?></a></li>

				<li style="float: right;">
					<?php if ($_SESSION["logged_user"] != "") { ?>
						<a><?php echo $_SESSION["logged_user"]; ?></a>
						<ul class="menu">
							<li><a>Account</a></li>
							<li><a href="logout.php">Logout</a></li>
						</ul>
					<?php } else { ?>
						<a href="login.php">Login</a>
						<ul class="menu">
							<li><a href="register.php">Register</a></li>
						</ul>
					<?php } ?>
				</li>

			</ul>
		</section>
	</nav>
</div>
