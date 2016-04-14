<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   Lannister.class.php                                :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/13 09:49:00 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/13 09:51:42 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

class Lannister
{
	public function sleepWith($w)
	{
		if ($w instanceof Lannister)
			print("Not even if I'm drunk !" . PHP_EOL);
		else
			print("Let's do this." . PHP_EOL);
	}
}

?>
