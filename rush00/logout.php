<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   logout.php                                         :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/09 16:29:17 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/09 17:04:09 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

session_start();

header("Location: index.php");

$_SESSION["logged_user"] = "";
$_SESSION["is_admin"] = FALSE;

?>
