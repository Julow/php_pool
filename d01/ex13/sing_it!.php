#!/usr/bin/php
<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   sing_it!.php                                       :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/05 11:00:56 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/05 14:21:45 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

$lol = array(
	"mais pourquoi cette demo ?" => ["Tout simplement pour qu'en feuilletant le sujet\non ne s'apercoive pas de la nature de l'exo"],
	"mais pourquoi cette chanson ?" => ["Parce que Kwame a des enfants"],
	"vraiment ?" => ["Nan c'est parce que c'est le premier avril", "Oui il a vraiment des enfants"]
);

if ($argc > 1 && isset($lol[$argv[1]]))
{
	echo $lol[$argv[1]][array_rand($lol[$argv[1]], 1)] . "\n";
}

?>
