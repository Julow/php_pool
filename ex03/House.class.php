<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   House.class.php                                    :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/13 09:45:18 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/13 11:28:01 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

abstract class House
{
	public abstract function getHouseName();
	public abstract function getHouseMotto();
	public abstract function getHouseSeat();

	public function introduce()
	{
		printf("House %s of %s : \"%s\"" . PHP_EOL,
			$this->getHouseName(), $this->getHouseSeat(), $this->getHouseMotto());
	}
}

?>
