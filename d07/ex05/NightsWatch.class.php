<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   NightsWatch.class.php                              :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/13 09:55:02 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/13 12:13:14 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

class NightsWatch
{
	private $_fighters = [];

	public function recruit($w)
	{
		$this->_fighters[] = $w;
	}

	public function fight()
	{
		foreach ($this->_fighters as $f)
			if ($f instanceof IFighter)
				$f->fight();
	}
}

?>
