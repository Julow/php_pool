<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   Targaryen.class.php                                :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/13 09:43:00 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/13 09:44:35 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

class Targaryen
{
	public function resistsFire()
	{
		return (False);
	}

	public function getBurned()
	{
		return ($this->resistsFire() ?
				"emerges naked but unharmed" : "burns alive");
	}
}

?>
