<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   UnholyFactory.class.php                            :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/13 10:01:58 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/13 13:35:46 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

require_once('Fighter.class.php');

class UnholyFactory
{
	private $_fighters = [];

	public function absorb($fighter)
	{
		if (!($fighter instanceof Fighter))
		{
			printf("(Factory can't absorb this, it's not a fighter)" . PHP_EOL);
			return ;
		}
		$type = $fighter->getType();
		if (isset($this->_fighters[$type]))
		{
			printf("(Factory already absorbed a fighter of type %s)" . PHP_EOL, $type);
			return ;
		}
		$this->_fighters[$type] = $fighter;
		printf("(Factory absorbed a fighter of type %s)" . PHP_EOL, $type);
	}

	public function fabricate($requested_fighter)
	{
		if (!isset($this->_fighters[$requested_fighter]))
		{
			printf("(Factory hasn't absorbed any fighter of type %s)" . PHP_EOL, $requested_fighter);
			return (null);
		}
		printf("(Factory fabricates a fighter of type %s)" . PHP_EOL, $requested_fighter);
		return (clone $this->_fighters[$requested_fighter]);
	}
}

?>
