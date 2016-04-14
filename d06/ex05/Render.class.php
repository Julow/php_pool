<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   Render.class.php                                   :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/12 18:28:52 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/13 14:23:01 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

require_once 'Render.class.php';

class Render
{
	const VERTEX = 0;
	const EDGE = 0;
	const RASTERIZE = 0;

	private $_width;
	private $_height;

	private $_image;
	private $_filename;

	public static $verbose = FALSE;

	function __construct($width, $height, $filename)
	{
		$this->_width = $width;
		$this->_height = $height;
		$this->_image = @imagecreatetruecolor($this->_width, $this->_height) or die ("ERROR\n");
		$this->_filename = $filename;
		if (Render::$verbose)
			echo "Render instance constructed" . PHP_EOL;
	}

	function __destruct()
	{
		if (Render::$verbose)
			echo "Render instance destructed" . PHP_EOL;
	}

	function __toString()
	{
		return ("Render( )");
	}

	private function _renderLine($v1, $v2)
	{
		$color = imagecolorallocate($this->_image, $v1->getColor()->red,
			$v1->getColor()->green, $v1->getColor()->blue);
		imageline($this->_image, $v1->getX(), $v1->getY(), $v2->getX(), $v2->getY(), $color);
		imagecolordeallocate($this->_image, $color);
	}

	function renderVertex($screenVertex)
	{
		$this->_renderLine($screenVertex, $screenVertex);
	}

	function renderTriangle($triangle, $mode)
	{
		$vertices = $triangle->getVertices();
		print_r($vertices);
		switch ($mode)
		{
		case Render::VERTEX:
			foreach ($vertices as $v)
				$this->renderVertex($v);
			break ;
		case Render::EDGE:
			$this->_renderLine($vertices[0], $vertices[1]);
			$this->_renderLine($vertices[1], $vertices[2]);
			$this->_renderLine($vertices[2], $vertices[0]);
			break ;
		case Render::RASTERIZE:
			break ;
		}
	}

	function renderMesh($mesh, $mode)
	{
		foreach ($mesh as $triangle)
			$this->renderTriangle($triangle, $mode);
	}

	function develop()
	{
		imagepng($this->_image, $this->_filename);
	}

	static function doc()
	{
		return (file_get_contents(dirname(__FILE__) . "/Render.doc.txt"));
	}
}

?>
