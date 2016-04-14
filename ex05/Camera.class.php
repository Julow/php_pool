<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   Camera.class.php                                   :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/12 15:08:42 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/13 14:19:36 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

require_once 'Matrix.class.php';

class Camera
{
	private $_projection;
	private $_view;

	private $_lolT;
	private $_lolR;
	private $_lolOrigin;

	private $_screen;

	public static $verbose = FALSE;

	function __construct($tab)
	{
		if (isset($tab["ratio"]))
		{
			$ratio = $tab["ratio"];
			$this->_screen = [$ratio, 1];
		}
		else
		{
			$ratio = $tab["width"] / $tab["height"];
			$this->_screen = [$tab["width"], $tab["height"]];
		}
		$this->_projection = new Matrix(array(
			"preset" => Matrix::PROJECTION,
			"fov" => $tab["fov"],
			"ratio" => $ratio,
			"near" => $tab["near"],
			"far" => $tab["far"]
		));
		$this->_lolOrigin = $tab["origin"];
		$this->_lolT = new Matrix(array(
			"preset" => Matrix::TRANSLATION,
			"vtc" => new Vector(array(
				"dest" => new Vertex(array("x" => 0, "y" => 0, "z" => 0, "w" => 0)),
				"orig" => $this->_lolOrigin
			))
		));
		$this->_lolR = $tab["orientation"]->transpose();
		$this->_view = $this->_lolR->mult($this->_lolT);
		if (Camera::$verbose)
			echo "Camera instance constructed" . PHP_EOL;
	}

	function __destruct()
	{
		if (Camera::$verbose)
			echo "Camera instance destructed" . PHP_EOL;
	}

	function __toString()
	{
		return (sprintf("Camera( \n+ Origine: %s\n+ tT:\n%s\n+ tR:\n%s\n+ tR->mult( tT ):\n%s\n+ Proj:\n%s\n)",
			$this->_lolOrigin, $this->_lolT, $this->_lolR, $this->_view, $this->_projection));
	}

	function watchVertex($worldVertex)
	{
		$tmp = $this->_projection->mult($this->_view)->transformVertex($worldVertex);
		return (new Vertex(array(
			"x" => ($tmp->getX() + 1) / 2 * $this->_screen[0],
			"y" => ($tmp->getY() + 1) / 2 * $this->_screen[1],
			"z" => $tmp->getZ(),
			"w" => $tmp->getW()
		)));
	}

	function watchTriangle($triangle)
	{
		$vertices = array_map([$this, 'watchVertex'], $triangle->getVertices());
		return (new Triangle($vertices[0], $vertices[1], $vertices[2]));
	}

	function watchMesh($mesh)
	{
		return (array_map([$this, 'watchTriangle'], $mesh));
	}

	static function doc()
	{
		return (file_get_contents(dirname(__FILE__) . "/Camera.doc.txt"));
	}
}

?>
