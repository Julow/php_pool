<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   init.php                                           :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/09 15:30:01 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/10 14:46:36 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

session_start();

/*
** router only if we have an origin on the project so it loads all the files from there
*/

$data = array(
	"page_title" => "minishop",
	"css" => ["res/menu.css", "res/index.css"]
);

?>
