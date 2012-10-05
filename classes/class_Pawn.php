<?php
/* 
chess/classes/class_Pawn.php

v1.0 2009.07.24 Valerie Thompson


*/

require_once "class_Chess_Piece.php";

class Pawn extends Chess_Piece
{
	//pawn properties
	protected $type = "Pawn";
	protected $vMoves = array();
		
	function __construct ($startPos = "a1", $color = LIGHT, $name)
	{
		parent::__construct($startPos, $color, $name);
	}	

	function getPieceType ()
	{
		return ($this -> type);
	}
	
	function getTypeAbbrev ()
	{
	 	return (substr($this -> type, 0, 1));	
	}
	
	public static function validMoves($chessboard, $fpiece)
	{
		$vMoves = array(); //array to hold the set of valid moves
		
		//valid pawn move - only forward, so find the color
		$currPos = $fpiece->getPosition();
		
		//if dark only square below this one
		if (DARK == $fpiece->getColor())
		{
			$newPos = $chessboard->getMoveDown($currPos);
			if ($newPos != null)
				if (!$chessboard->isPieceAtPosition($newPos))
					array_push ($vMoves, $newPos);
			
			//if there is an opposing piece diagonally you can add this to valid moves
			$newPos = $chessboard->getMoveDown($currPos);
			$newPos = $chessboard->getMoveLeft($newPos);
			
			if ($newPos != null)
				if ($chessboard->isPieceAtPosition($newPos) && LIGHT == $chessboard->getPieceAtPosition($newPos)->getColor())
					array_push ($vMoves, $newPos);
					
			$newPos = $chessboard->getMoveDown($currPos);
			$newPos = $chessboard->getMoveRight($newPos);
			
			if ($newPos != null)
				if ($chessboard->isPieceAtPosition($newPos) && LIGHT == $chessboard->getPieceAtPosition($newPos)->getColor())
					array_push ($vMoves, $newPos);			
		}
		else //piece is light
		{
			$newPos = $chessboard->getMoveUp($currPos);
			if ($newPos != null)
				if (!$chessboard->isPieceAtPosition($newPos))
					array_push ($vMoves, $newPos);
			
			//if there is an opposing piece diagonally you can add this to valid moves
			$newPos = $chessboard->getMoveUp($currPos);
			$newPos = $chessboard->getMoveLeft($newPos);
			
			if ($newPos != null)
				if ($chessboard->isPieceAtPosition($newPos) && DARK == $chessboard->getPieceAtPosition($newPos)->getColor())
					array_push ($vMoves, $newPos);
					
			$newPos = $chessboard->getMoveUp($currPos);
			$newPos = $chessboard->getMoveRight($newPos);
			
			if ($newPos != null)
				if ($chessboard->isPieceAtPosition($newPos) && DARK == $chessboard->getPieceAtPosition($newPos)->getColor())
					array_push ($vMoves, $newPos);		
		}
		
		//TO DO en passant and promotion
		//put logic for both, where promotion would allow pawn to behave like the new type
		
		
		print ("<BR> valid pawn moves: ");
		print_r($vMoves);
		print ("<BR>");
		
		return $vMoves;
	}
	
	function getPiecesBetween ($from, $to, $chesboard)
	{
		//pawn moves don't have pieces between
		
		$setBetween = array();
	
		print ("<BR> pieces between pawn move: ");
		print_r($setBetween);
		print ("<BR>");
				
		return $setBetween;	
	}
}

?>