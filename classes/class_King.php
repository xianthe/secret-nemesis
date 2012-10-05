<?php
/* 
chess/classes/class_King.php

v1.0 2009.07.24 Valerie Thompson


*/

require_once "class_Chess_Piece.php";



class King extends Chess_Piece
{
	protected $type = "King";
	protected $vMoves = array();
	protected $moved;
	
	function __construct ($startPos = "a1", $color = LIGHT, $name)
	{
		parent::__construct($startPos, $color, $name);
		$this->moved = false;
	}
	
	function getPieceType ()
	{
		return ($this -> type);
	}
	
	function getTypeAbbrev ()
	{
	 	return (substr($this -> type, 0, 1));	
	}	
	
	function getMovedStatus()
	{
		return ($this->moved);	
	}
	
	function setMoved($value)
	{
		$this->moved = $value;	
	}
	
	function setCapturedStatus($status)
	{
		//kings can't be captured
		
	}
	
	public static function validMoves ($chessboard, $fpiece)
	{
		$vMoves = array(); //array to hold the set of valid moves
		
		//kings valid moves - king can move in a square around itself
		$currPos = $fpiece->getPosition();
		
		
		$newPos = $chessboard->getMoveLeft($currPos);
		
		if ($newPos != null)
			if (!$chessboard->isPieceAtPosition($newPos))
				array_push ($vMoves, $newPos);

		//print ("<br> moveLeft: $newPos <br>");
		
		$newPos = $chessboard->getMoveRight($currPos);
		if ($newPos != null)
			if (!$chessboard->isPieceAtPosition($newPos))
				array_push ($vMoves, $newPos);
		//print ("<br> moveRight: $newPos <br>");	 		
		
		$newPos = $chessboard->getMoveUp($currPos);
		if ($newPos != null)
			if (!$chessboard->isPieceAtPosition($newPos))	
				array_push ($vMoves, $newPos);
		//print ("<br> moveUp: $newPos <br>");	
			
		$newPos = $chessboard->getMoveDown($currPos);
		if ($newPos != null)
			if (!$chessboard->isPieceAtPosition($newPos))
				array_push ($vMoves, $newPos);
		//print ("<br> moveDown: $newPos <br>");
			
		//corners
		$newPos = $chessboard->getMoveLeft($currPos);
		$newPos = $chessboard->getMoveUp($newPos);
		if ($newPos != null)
			if (!$chessboard->isPieceAtPosition($newPos))
				array_push ($vMoves, $newPos);
		//print ("<br> moveUpperLeft: $newPos <br>");	 
			
		$newPos = $chessboard->getMoveLeft($currPos);
		$newPos = $chessboard->getMoveDown($newPos);
		if ($newPos != null)
			if (!$chessboard->isPieceAtPosition($newPos))
				array_push ($vMoves, $newPos); 
		//print ("<br> moveLowerLeft: $newPos <br>");
			
		$newPos = $chessboard->getMoveRight($currPos);
		$newPos = $chessboard->getMoveUp($newPos);
		if ($newPos != null)
			if (!$chessboard->isPieceAtPosition($newPos))
				array_push ($vMoves, $newPos); 
		//print ("<br> moveUpperRight: $newPos <br>");
			
		$newPos = $chessboard->getMoveRight($currPos);
		$newPos = $chessboard->getMoveDown($newPos);
		if ($newPos != null)
			if (!$chessboard->isPieceAtPosition($newPos))
				array_push ($vMoves, $newPos);
		//print ("<br> moveLowerRight: $newPos <br>"); 	
		
		//TO DO: king also has a special condition move that if it hasn't been moved
		/* 	Once in every game, each king is allowed to make a special move, known as castling. 
		  	Castling consists of moving the king two squares towards a rook, then placing the rook
			immediately on the far side of the king. Castling is only permissible if all of the following conditions hold:[1]

		    * Neither of the pieces involved in the castling may have been previously moved during the game;
		    * There must be no pieces between the king and the rook;
		    * The king may not currently be in check, nor may the king pass through squares that are under attack 
		    	by enemy pieces. As with any move, castling is illegal if it would place the king in check.
		    * The king and the rook must be on the same rank (to exclude castling with a promoted pawn, described later).
		*/
			
		print ("<BR> valid king moves: ");
		print_r($vMoves);
		print ("<BR>");
		
		return $vMoves;
	}	
	
	function getPiecesBetween ($from, $to, $chessboard )
	{
		//kings don't have pieces between
		$setBetween = array();
		
		return $setBetween;	
	}
}

?>