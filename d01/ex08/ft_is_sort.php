<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   ft_is_sort.php                                     :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/05 11:00:56 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/05 14:31:35 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

function ft_is_sort($tab)
{
	$tmp = array_merge($tab);
	sort($tmp);
	for ($i = 0; $i < count($tab); $i++)
		if ($tmp[$i] !== $tab[$i])
			return (FALSE);
	return (TRUE);
}

?>
