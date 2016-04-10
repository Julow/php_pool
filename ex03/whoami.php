<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   whoami.php                                         :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/08 15:21:29 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/08 19:20:07 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

session_start();

echo (isset($_SESSION["loggued_on_user"]) && $_SESSION["loggued_on_user"] != "") ? $_SESSION["loggued_on_user"] ."\n" : "ERROR\n";

?>
