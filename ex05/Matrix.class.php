<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   Matrix.class.php                                   :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/12 11:27:59 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/13 14:05:11 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

require_once 'Vertex.class.php';
require_once 'Vector.class.php';

class Matrix
{
	const IDENTITY = 0;
	const SCALE = 1;
	const RX = 2;
	const RY = 3;
	const RZ = 4;
	const TRANSLATION = 5;
	const PROJECTION = 6;

	private $_v;

	public static $verbose = FALSE;

	function __construct($tab)
	{
		if (isset($tab["value"]))
		{
			$this->_v = $tab["value"];
		}
		else
		{
			$this->_v = [
				[1, 0, 0, 0],
				[0, 1, 0, 0],
				[0, 0, 1, 0],
				[0, 0, 0, 1]
			];

			switch ($tab["preset"])
			{
			case Matrix::IDENTITY:
				if (Matrix::$verbose)
					echo "Matrix IDENTITY instance constructed" . PHP_EOL;
				break ;
			case Matrix::SCALE:
				foreach (range(0, 2) as $i)
					$this->_v[$i][$i] = $tab["scale"];
				if (Matrix::$verbose)
					echo "Matrix SCALE preset instance constructed" . PHP_EOL;

				break ;
			case Matrix::RX:
				$cos = cos($tab["angle"]);
				$sin = sin($tab["angle"]);
				$this->_v[1][1] = $cos;
				$this->_v[1][2] = -$sin;
				$this->_v[2][1] = $sin;
				$this->_v[2][2] = $cos;
				if (Matrix::$verbose)
					echo "Matrix Ox ROTATION preset instance constructed" . PHP_EOL;

				break ;
			case Matrix::RY:
				$cos = cos($tab["angle"]);
				$sin = sin($tab["angle"]);
				$this->_v[0][0] = $cos;
				$this->_v[0][2] = $sin;
				$this->_v[2][0] = -$sin;
				$this->_v[2][2] = $cos;
				if (Matrix::$verbose)
					echo "Matrix Oy ROTATION preset instance constructed" . PHP_EOL;

				break ;
			case Matrix::RZ:
				$cos = cos($tab["angle"]);
				$sin = sin($tab["angle"]);
				$this->_v[0][0] = $cos;
				$this->_v[0][1] = -$sin;
				$this->_v[1][0] = $sin;
				$this->_v[1][1] = $cos;
				if (Matrix::$verbose)
					echo "Matrix Oz ROTATION preset instance constructed" . PHP_EOL;

				break ;
			case Matrix::TRANSLATION:
				$this->_v[0][3] = $tab["vtc"]->getX();
				$this->_v[1][3] = $tab["vtc"]->getY();
				$this->_v[2][3] = $tab["vtc"]->getZ();
				if (Matrix::$verbose)
					echo "Matrix TRANSLATION preset instance constructed" . PHP_EOL;

				break ;
			case Matrix::PROJECTION:
				$fov = $tab["fov"];
				$ratio = $tab["ratio"];
				$near = $tab["near"];
				$far = $tab["far"];
				$tmp = 1 / tan($fov / 2 * (pi() / 180));
				$this->_v[0][0] = $tmp / $ratio;
				$this->_v[1][1] = $tmp;
				$this->_v[2][2] = ($far + $near) / ($near - $far);
				$this->_v[2][3] = (2 * $far * $near) / ($near - $far);
				$this->_v[3][2] = -1;
				$this->_v[3][3] = 0;
				if (Matrix::$verbose)
					echo "Matrix PROJECTION preset instance constructed" . PHP_EOL;

				break ;
			}
		}
	}

	function __destruct()
	{
		if (Matrix::$verbose)
			echo "Matrix instance destructed" . PHP_EOL;
	}

	function mult($rhs)
	{
		$value = [
			[0, 0, 0, 0],
			[0, 0, 0, 0],
			[0, 0, 0, 0],
			[0, 0, 0, 0]
		];
		foreach (range(0, 3) as $y)
			foreach (range(0, 3) as $x)
			{
				$tmp = 0;
				foreach (range(0, 3) as $i)
					$tmp += $this->_v[$y][$i] * $rhs->_v[$i][$x];
				$value[$y][$x] = $tmp;
			}
		return (new Matrix(array("value" => $value)));
	}

	function transformVertex($rhs)
	{
		$tmp = [0, 0, 0, 0];
		foreach (range(0, 3) as $i)
			$tmp[$i] = $this->_v[$i][0] * $rhs->getX()
					+ $this->_v[$i][1] * $rhs->getY()
					+ $this->_v[$i][2] * $rhs->getZ()
					+ $this->_v[$i][3] * $rhs->getW();
		return (new Vertex(array(
			"x" => $tmp[0],
			"y" => $tmp[1],
			"z" => $tmp[2],
			"w" => $tmp[3],
			"color" => $rhs->getColor()
		)));
	}

	function transformTriangle($triangle)
	{
		$vertices = array_map([$this, 'transformVertex'], $triangle->getVertices());
		return (new Triangle($vertices[0], $vertices[1], $vertices[2]));
	}

	function transformMesh($mesh)
	{
		return (array_map([$this, 'transformTriangle'], $mesh));
	}

	function transpose()
	{
		$tmp = [
			[0, 0, 0, 0],
			[0, 0, 0, 0],
			[0, 0, 0, 0],
			[0, 0, 0, 0]
		];
		foreach (range(0, 3) as $i)
			foreach (range(0, 3) as $j)
				$tmp[$i][$j] = $this->_v[$j][$i];
		return (new Matrix(array(
			"value" => $tmp
		)));
	}

	function __toString()
	{
		$tmp  = "M | vtcX | vtcY | vtcZ | vtxO\n";
		$tmp .= "-----------------------------";
		foreach (range(0, 3) as $i)
			$tmp .= sprintf("\n%s | %.2f | %.2f | %.2f | %.2f", "xyzw"[$i],
				$this->_v[$i][0], $this->_v[$i][1], $this->_v[$i][2], $this->_v[$i][3]);
		return ($tmp);
	}

	static function doc()
	{
		return (file_get_contents(dirname(__FILE__) . "/Matrix.doc.txt"));
	}
}

?>
