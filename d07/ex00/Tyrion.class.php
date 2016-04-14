<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   Tyrion.class.php                                   :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/13 09:34:16 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/13 09:38:54 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

class Tyrion extends Lannister
{
	public function __construct()
	{
		parent::__construct();
		print("My name is Tyrion" . PHP_EOL);
	}

	public function getSize()
	{
		return ("Short");
	}
}

?>
