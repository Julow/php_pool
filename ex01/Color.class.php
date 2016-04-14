<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   Color.class.php                                    :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/12 09:21:30 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/12 09:57:20 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

class Color
{
	public $red;
	public $green;
	public $blue;

	public static $verbose = FALSE;

	function __construct($tab)
	{
		if (isset($tab["rgb"]))
		{
			$rgb = intval($tab["rgb"]);
			$this->red = ($rgb >> 16) & 0xFF;
			$this->green = ($rgb >> 8) & 0xFF;
			$this->blue = $rgb & 0xFF;
		}
		else
		{
			$this->red = intval($tab["red"]);
			$this->green = intval($tab["green"]);
			$this->blue = intval($tab["blue"]);
		}
		if (Color::$verbose)
			echo $this . " constructed." . PHP_EOL;
	}

	function __destruct()
	{
		if (Color::$verbose)
			echo $this . " destructed." . PHP_EOL;
	}

	function __toString()
	{
		return (sprintf("Color( red: %3d, green: %3d, blue: %3d )",
			$this->red, $this->green, $this->blue));
	}

	function add($rhs)
	{
		return (new Color(array(
			"red"	=> $this->red + $rhs->red,
			"green"	=> $this->green + $rhs->green,
			"blue"	=> $this->blue + $rhs->blue
		)));
	}

	function sub($rhs)
	{
		return (new Color(array(
			"red"	=> $this->red - $rhs->red,
			"green"	=> $this->green - $rhs->green,
			"blue"	=> $this->blue - $rhs->blue
		)));
	}

	function mult($f)
	{
		return (new Color(array(
			"red"	=> $this->red * $f,
			"green"	=> $this->green * $f,
			"blue"	=> $this->blue * $f
		)));
	}

	static function doc()
	{
		return (file_get_contents(dirname(__FILE__) . "/Color.doc.txt"));
	}
};

?>
