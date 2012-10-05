<?php
/* 
chess/classes/class_Queen.php

v1.0 2009.07.24 Valerie Thompson


*/

require_once "class_Chess_Piece.php";

class Queen extends Chess_Piece
{
	protected $type = "Queen";
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
		$vMoves = array(); //array that holds the set of valid moves
		
		//queen's valid moves - queen can move diagonally in four directions and vertically/horizontally
		//bishop + rook
		$currPos = $fpiece->getPosition();
		
		$bishop = Bishop::validMoves($chessboard, $fpiece);
		$rook 	= Rook::validMoves($chessboard, $fpiece);
		
		$vMoves = array_merge($bishop, $rook);
		
		print ("<BR> valid queen's moves: ");
		print_r($vMoves);
		print ("<BR>");
		
		return $vMoves;
	}
	
	function getPiecesBetween ($from, $to, $chessboard)
	{
		$setBetween = array();
		
		$toNum	 = $chessboard->getPositionNumeric($to);
		$fromNum = $chessboard->getPositionNumeric($from);
		$toAlpha	 = $chessboard->getPositionAlpha($to);
		$fromAlpha 	 = $chessboard->getPositionAlpha($from); 
		
		$bishop = Bishop::getPiecesBetween ($from, $to, $chessboard);
		$rook	= Rook::getPiecesBetween ($from, $to, $chessboard);
		
		$setBetween = array_merge($bishop, $rook);
		
		print ("<BR> pieces between queen move: ");
		print_r($setBetween);
		print ("<BR>");
				
		return $setBetween;	
	}
}

?>