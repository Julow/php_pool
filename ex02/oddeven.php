#!/usr/bin/php
<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   oddeven.php                                        :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/05 10:22:33 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/05 14:31:28 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

function all_digits($str)
{
	if (strlen($str) == 0)
		return (FALSE);
	$i = (strlen($str) > 1 && $str[0] == '-') ? 1 : 0;
	for (; $i < strlen($str); $i++)
	{
		$c = ord($str[$i]);
		if ($c < ord('0') || $c > ord('9'))
			return (FALSE);
	}
	return (TRUE);
}

while (TRUE)
{
	echo "Entrez un nombre: ";
	if (!($line = fgets(STDIN)))
		break ;
	$line = substr($line, 0, -1);
	if (!all_digits($line))
		echo "'$line' n'est pas un chiffre";
	else
		echo "Le chiffre $line est " . (((intval(substr($line, -1)) % 2) == 0) ? "Pair" : "Impair");
	echo "\n";
}

echo "\n";

?>
