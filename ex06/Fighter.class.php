<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   Fighter.class.php                                  :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/13 10:01:58 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/13 10:11:18 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

abstract class Fighter
{
	private $_type;

	public function __construct($type)
	{
		$this->_type = $type;
	}

	public function getType()
	{
		return ($this->_type);
	}

	abstract public function fight($target);
}

?>
