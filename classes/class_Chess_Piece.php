<?php
/* 
chess/classes/class_Chess_Piece.php

v1.0 2009.07.24 Valerie Thompson

This is the base class for chess pieces, sets up normal information like name, position on board
and a list of moves the piece has made.

*/


require_once "class_LIFO_queue.php";


class Chess_Piece 
{
	
	//chess_piece properties
	protected $name;
	protected $color; 	//black or white
	protected $position; 	//example e3
	protected $moves; 	//keeps track of all the moves this piece has made
					//this can later be used to perfom undos or replays
	protected $captured;  //property to store the state of whether this piece is captured or not
					//so that it can be taken off the board when displayed
	
	/* Note: I'd probably add some other logic/state for promoted pieces as well */
	
	//default constructor for Chess_Piece class
	function __construct ($startPos = "a1", $color = LIGHT, $name)
	{
		$this -> position = $startPos;
		$this -> color	= $color;
		if (! empty($name))
			$this -> name = $name;	
		$this -> moves = new LIFO_queue();	
		$this -> caputured = false;		
	}	
	
	function getName ()
	{
		return ($this -> name);
	}

	function getPosition ()
	{
		return ($this -> position);	
	}
	
	function getColor ()
	{
		return ($this -> color);	
	}
	
	function getColorAbbrev()
	{
		return (substr ($this -> color, 0 , 1));	
	}
	
	function getMoves ()
	{
		return ($this -> moves);	
	}

	function setPosition ($pos = "a1")
	{
		$this -> moves -> push ($pos); //to record move
		$this -> position = $pos;	
		
		//if this is a king note the change
		if ("King" == $this -> getPieceType()) 
			$this->setMoved(true);
	}	
	
	function getPositionAlpha ()
	{
		return (substr($this -> position, 0 , 1));	
	}
	
	function getPositionNumeric ()
	{
		return (substr($this -> position, 1));
	}			

	function getCapturedStatus ()
	{
		return ($this->captured);
	}
	
	function setCapturedStatus($status)
	{
		$this->captured = $status;	
	}


	public static function validMoves ($chessboard, $fpiece)
	{
		//abstract class to return valid moves for this chess piece	
	}	
}


?>