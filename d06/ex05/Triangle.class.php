<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   Triangle.class.php                                 :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/12 18:28:57 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/13 14:08:32 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

require_once 'Vertex.class.php';

class Triangle
{
	private $_a;
	private $_b;
	private $_c;

	public static $verbose = FALSE;

	function __construct($A, $B, $C)
	{
		$this->_a = $A;
		$this->_b = $B;
		$this->_c = $C;
		if (Triangle::$verbose)
			echo "Triangle instance constructed" . PHP_EOL;
	}

	function __destruct()
	{
		if (Triangle::$verbose)
			echo "Triangle instance destructed" . PHP_EOL;
	}

	function __toString()
	{
		return ("Triangle( )");
	}

	function getVertices()
	{
		return ([$this->_a, $this->_b, $this->_c]);
	}

	static function doc()
	{
		return (file_get_contents(dirname(__FILE__) . "/Triangle.doc.txt"));
	}
}

?>
