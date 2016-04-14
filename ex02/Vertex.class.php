<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   Vertex.class.php                                   :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/12 09:56:21 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/12 18:38:44 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

require_once 'Color.class.php';

class Vertex
{
	private $_x;
	private $_y;
	private $_z;
	private $_w;

	private $_color;

	public static $verbose = FALSE;

	function __construct($tab)
	{
		$this->_x = $tab["x"];
		$this->_y = $tab["y"];
		$this->_z = $tab["z"];
		$this->_w = isset($tab["w"]) ? $tab["w"] : 1.0;
		$this->_color = isset($tab["color"]) ?
				$tab["color"] : new Color(array("rgb" => 0xFFFFFF));
		if (Vertex::$verbose)
			echo $this . " constructed" . PHP_EOL;
	}

	function __destruct()
	{
		if (Vertex::$verbose)
			echo $this . " destructed" . PHP_EOL;
	}

	function getX() { return ($this->_x); }
	function getY() { return ($this->_y); }
	function getZ() { return ($this->_z); }
	function getW() { return ($this->_w); }
	function getColor() { return ($this->_color); }

	function setX($val) { $this->_x = $val; }
	function setY($val) { $this->_y = $val; }
	function setZ($val) { $this->_z = $val; }
	function setW($val) { $this->_w = $val; }
	function setColor($val) { $this->_color = $val; }

	function __toString()
	{
		$tmp = sprintf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f",
			$this->_x, $this->_y, $this->_z, $this->_w);
		if (Vertex::$verbose)
			$tmp .= ", " . $this->_color;
		return ($tmp . " )");
	}

	static function doc()
	{
		return (file_get_contents(dirname(__FILE__) . "/Vertex.doc.txt"));
	}
}

?>
