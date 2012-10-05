<?php
/* 
chess/classes/class_Rook.php

v1.0 2009.07.24 Valerie Thompson


*/

require_once "class_Chess_Piece.php";

class Rook extends Chess_Piece
{
	protected $type = "Rook";
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
		
		//rook's valid moves - rook can move vertically and horizontally
		$currPos = $fpiece->getPosition();
				
		//above
		$numberToCheck = 8 - $chessboard->getPositionNumeric($currPos);
		$newPos  = $currPos;
		for ($j = 0; $j < $numberToCheck; $j++)
		{
			$pos = $chessboard->getMoveUp($newPos);
			
			if ($pos != null)
			{
				//find out if there is a piece at this position, if so stop processing
				if ($chessboard->isPieceAtPosition($pos))
					break;
				else
				{	//print ("<BR> above adding rook pos: $pos");
					array_push ($vMoves, $pos);
				}	
			}
			else
				break;	
				
			$newPos = $pos;			
		}
		
		
		//below
		$numberToCheck = $chessboard->getPositionNumeric($currPos) - 1;
		$newPos = $currPos;
		for ($j = 0; $j < $numberToCheck; $j++)
		{
			$pos = $chessboard->getMoveDown($newPos);
			
			if ($pos != null)
			{
				//find out if there is a piece at this position, if so stop processing
				if ($chessboard->isPieceAtPosition($pos))
					break;
				else
				{	//print ("<BR> below adding rook pos: $pos");
					array_push ($vMoves, $pos);
				}	
			}
			else
				break;	
			
			$newPos = $pos;			
		}
		
		//left
		$numberToCheck = Chessboard::getNumericAlphaIndex($chessboard->getPositionAlpha($currPos)) - 1;
		$newPos  = $currPos;
		for ($j = 0; $j < $numberToCheck; $j++)
		{
			$pos = $chessboard->getMoveLeft($newPos);
			//print ("<BR> getMoveLeft currPos: $currPos left: $pos"); 
			if ($pos != null)
			{
				//find out if there is a piece at this position, if so stop processing
				if ($chessboard->isPieceAtPosition($pos))
					break;
				else
				{	//print ("<BR> left adding rook pos: $pos");
					array_push ($vMoves, $pos);
				}	
			}
			else
				break;		
				
			$newPos = $pos;		
		}
		
		//right
		$numberToCheck = 8 - Chessboard::getNumericAlphaIndex($chessboard->getPositionAlpha($currPos));
		$newPos  = $currPos;
		for ($j = 0; $j < $numberToCheck; $j++)
		{
			$pos = $chessboard->getMoveRight($newPos);
			
			if ($pos != null)
			{
				//find out if there is a piece at this position, if so stop processing
				if ($chessboard->isPieceAtPosition($pos))
					break;
				else
				{	//print ("<BR> right adding rook pos: $pos");
					array_push ($vMoves, $pos);
				}	
			}
			else
				break;
			
			$newPos = $pos;				
		}
		
		print ("<BR> valid rook moves: ");
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
		
		//find out which direction its going in
		
		//vertical?
		if ($toNum != $fromNum)
		{
			//above
			if ($toNum > $fromNum)
			{
				$numberToCheck = $toNum - $fromNum;
		
				for ($j = 0; $j <= $numberToCheck; $j++)
				{
					$pos = $chessboard->getMoveUp($from);
					
					if ($pos != null)
					{
						//find out if there is a piece at this position, if add to array
						if ($chessboard->isPieceAtPosition($pos))
						{
							array_push ($setBetween, $pos);
						}
					}								
				}
			}
			else //below
			{
				$numberToCheck = $fromNum - $toNum;
				 
				for ($j = 0; $j <= $numberToCheck; $j++)
				{
					$pos = $chessboard->getMoveDown($from);
					
					if ($pos != null)
					{
						//find out if there is a piece at this position, if add to array
						if ($chessboard->isPieceAtPosition($pos))
						{
							array_push ($setBetween, $pos);
						}
					}								
				}
			}
		}
		else //horizontal
		{
			if (Chessboard::getNumericAlphaIndex($toAlpha) < Chessboard::getNumericAlphaIndex($fromAlpha))
			{
				//left
				$numberToCheck = $fromNum - $toNum;
				 
				for ($j = 0; $j <= $numberToCheck; $j++)
				{
					$pos = $chessboard->getMoveLeft($from);
					
					if ($pos != null)
					{
						//find out if there is a piece at this position, if add to array
						if ($chessboard->isPieceAtPosition($pos))
						{
							array_push ($setBetween, $pos);
						}
					}								
				}
				
				//right	
				$numberToCheck = $fromNum - $toNum;
				 
				for ($j = 0; $j <= $numberToCheck; $j++)
				{
					$pos = $chessboard->getMoveRight($from);
					
					if ($pos != null)
					{
						//find out if there is a piece at this position, if add to array
						if ($chessboard->isPieceAtPosition($pos))
						{
							array_push ($setBetween, $pos);
						}
					}								
				}
			}	
		}
		
		print ("<BR> pieces between rook move: ");
		print_r($setBetween);
		print ("<BR>");
				
		return $setBetween;	
		
	}
}

?>