<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   Jaime.class.php                                    :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/13 09:49:00 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/13 09:53:59 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

class Jaime extends Lannister
{
	public function sleepWith($w)
	{
		if ($w instanceof Cersei)
			print("With pleasure, but only in a tower in Winterfell, then." . PHP_EOL);
		else
			parent::sleepWith($w);
	}
}

?>
