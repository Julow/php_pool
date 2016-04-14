<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   Vector.class.php                                   :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/12 10:28:54 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/12 17:22:05 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

require_once 'Vertex.class.php';

class Vector
{
	private $_x;
	private $_y;
	private $_z;
	private $_w;

	public static $verbose = FALSE;

	function __construct($tab)
	{
		if (isset($tab["dest"]))
		{
			$orig = isset($tab["orig"]) ?
				$tab["orig"] : new Vertex(array("x" => 0, "y" => 0, "z" => 0));
			$this->_x = $tab["dest"]->getX() - $orig->getX();
			$this->_y = $tab["dest"]->getY() - $orig->getY();
			$this->_z = $tab["dest"]->getZ() - $orig->getZ();
			$this->_w = $tab["dest"]->getW() - $orig->getW();
		}
		else
		{
			$this->_x = $tab["x"];
			$this->_y = $tab["y"];
			$this->_z = $tab["z"];
			$this->_w = $tab["w"];
		}
		if (Vector::$verbose)
			echo $this . " constructed" . PHP_EOL;
	}

	function __destruct()
	{
		if (Vector::$verbose)
			echo $this . " destructed" . PHP_EOL;
	}

	function getX()
	{
		return ($this->_x);
	}

	function getY()
	{
		return ($this->_y);
	}

	function getZ()
	{
		return ($this->_z);
	}

	function getW()
	{
		return ($this->_w);
	}

	function magnitude()
	{
		return (sqrt($this->dotProduct($this)));
	}

	function normalize()
	{
		$len = $this->magnitude();
		return (new Vector(array(
			"x" => $this->_x / $len,
			"y" => $this->_y / $len,
			"z" => $this->_z / $len,
			"w" => $this->_w / $len
		)));
	}

	function add($rhs)
	{
		return (new Vector(array(
			"x" => $this->_x + $rhs->_x,
			"y" => $this->_y + $rhs->_y,
			"z" => $this->_z + $rhs->_z,
			"w" => $this->_w + $rhs->_w
		)));
	}

	function sub($rhs)
	{
		return (new Vector(array(
			"x" => $this->_x - $rhs->_x,
			"y" => $this->_y - $rhs->_y,
			"z" => $this->_z - $rhs->_z,
			"w" => $this->_w - $rhs->_w
		)));
	}

	function opposite()
	{
		return (new Vector(array(
			"x" => -$this->_x,
			"y" => -$this->_y,
			"z" => -$this->_z,
			"w" => -$this->_w
		)));
	}

	function scalarProduct($k)
	{
		return (new Vector(array(
			"x" => $this->_x * $k,
			"y" => $this->_y * $k,
			"z" => $this->_z * $k,
			"w" => $this->_w * $k
		)));
	}

	function dotProduct($rhs)
	{
		return ($this->_x * $rhs->_x
			+ $this->_y * $rhs->_y
			+ $this->_z * $rhs->_z
			+ $this->_w * $rhs->_w);
	}

	function cos($rhs)
	{
		return ($this->dotProduct($rhs) / ($this->magnitude() * $rhs->magnitude()));
	}

	function crossProduct($rhs)
	{
		return (new Vector(array(
			"x" => ($this->_y * $rhs->_z) - ($this->_z * $rhs->_y),
			"y" => ($this->_z * $rhs->_x) - ($this->_x * $rhs->_z),
			"z" => ($this->_x * $rhs->_y) - ($this->_y * $rhs->_x),
			"w" => 0
		)));
	}

	function __toString()
	{
		return (sprintf("Vector( x:%.2f, y:%.2f, z:%.2f, w:%.2f )",
			$this->_x, $this->_y, $this->_z, $this->_w));
	}

	static function doc()
	{
		return (file_get_contents(dirname(__FILE__) . "/Vector.doc.txt"));
	}
}

?>
