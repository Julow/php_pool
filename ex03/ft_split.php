<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   ft_split.php                                       :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/05 10:36:55 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/05 12:22:23 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

function empty_filter($str)
{
	return (strlen($str) > 0);
}

function ft_split($str)
{
	$split = array_filter(explode(" ", $str), empty_filter);
	sort($split);
	return ($split);
}

?>
