<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   print_get.php                                      :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/07 19:02:33 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/07 19:03:37 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

foreach ($_GET as $key => $value)
	echo "$key: $value\n";

?>