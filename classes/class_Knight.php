<?php
/* 
chess/classes/class_Knight.php

v1.0 2009.07.24 Valerie Thompson


*/

require_once "class_Chess_Piece.php";

class Knight extends Chess_Piece
{
	protected $type = "Knight";

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
	 	return ("N");	
	}	
	
		public static function validMoves ($chessboard, $fpiece)
	{
		$vMoves = array(); //array to hold the set of valid moves
		
		//kings valid moves - king can move in a square around itself
		$currPos = $fpiece->getPosition();
				
		$newPos = $chessboard->getMoveLeft($currPos);
		$newPos = $chessboard->getMoveUp ($newPos);
		$newPos = $chessboard->getMoveUp ($newPos);
		
		if ($newPos != null)
			if (!$chessboard->isPieceAtPosition($newPos))
				array_push ($vMoves, $newPos);

		$newPos = $chessboard->getMoveLeft($currPos);
		$newPos = $chessboard->getMoveLeft ($newPos);
		$newPos = $chessboard->getMoveUp ($newPos);
		
		if ($newPos != null)
			if (!$chessboard->isPieceAtPosition($newPos))
				array_push ($vMoves, $newPos);
		
		$newPos = $chessboard->getMoveLeft($currPos);
		$newPos = $chessboard->getMoveLeft ($newPos);
		$newPos = $chessboard->getMoveDown ($newPos);
		
		if ($newPos != null)
			if (!$chessboard->isPieceAtPosition($newPos))
				array_push ($vMoves, $newPos);
				
		$newPos = $chessboard->getMoveLeft($currPos);
		$newPos = $chessboard->getMoveDown ($newPos);
		$newPos = $chessboard->getMoveDown ($newPos);
		
		if ($newPos != null)
			if (!$chessboard->isPieceAtPosition($newPos))
				array_push ($vMoves, $newPos);
			
		$newPos = $chessboard->getMoveRight($currPos);
		$newPos = $chessboard->getMoveUp ($newPos);
		$newPos = $chessboard->getMoveUp ($newPos);
		
		if ($newPos != null)
			if (!$chessboard->isPieceAtPosition($newPos))
				array_push ($vMoves, $newPos);

		$newPos = $chessboard->getMoveRight($currPos);
		$newPos = $chessboard->getMoveRight ($newPos);
		$newPos = $chessboard->getMoveUp ($newPos);
		
		if ($newPos != null)
			if (!$chessboard->isPieceAtPosition($newPos))
				array_push ($vMoves, $newPos);
		
		$newPos = $chessboard->getMoveRight($currPos);
		$newPos = $chessboard->getMoveRight ($newPos);
		$newPos = $chessboard->getMoveDown ($newPos);
		
		if ($newPos != null)
			if (!$chessboard->isPieceAtPosition($newPos))
				array_push ($vMoves, $newPos);
				
		$newPos = $chessboard->getMoveRight($currPos);
		$newPos = $chessboard->getMoveDown ($newPos);
		$newPos = $chessboard->getMoveDown ($newPos);
		
		if ($newPos != null)
			if (!$chessboard->isPieceAtPosition($newPos))
				array_push ($vMoves, $newPos);		
				
		print ("<BR> valid knight moves: ");
		print_r($vMoves);
		print ("<BR>");
		
		return $vMoves;
	}	
	
	function getPiecesBetween ($from, $to, $chessboard )
	{
		//knights don't care about pieces between
		$setBetween = array();
		
		return $setBetween;	
	}
	
}


?>