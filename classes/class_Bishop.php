<?php
/* 
chess/classes/class_Bishop.php

v1.0 2009.07.24 Valerie Thompson


*/

require_once "class_Chess_Piece.php";

class Bishop extends Chess_Piece
{
	protected $type = "Bishop";
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
		
		//bishop's valid moves - bishop can move diagonally in four directions
		$currPos = $fpiece->getPosition();
		
		//nw
		$numberToCheck = 8 - $chessboard->getPositionNumeric($currPos);
		$newPos  = $currPos;
		for ($j = 0; $j < $numberToCheck; $j++)
		{
			$pos = $chessboard->getMoveUp($newPos);
			$pos = $chessboard->getMoveLeft($pos);
			
			if ($pos != null)
			{
				//find out if there is a piece at this position, if so stop processing
				if ($chessboard->isPieceAtPosition($pos))
					break;
				else
				{	//print ("<BR> nw adding bishop pos: $pos");
					array_push ($vMoves, $pos);
				}	
			}
			else
				break;	
				
			$newPos = $pos;			
		}
		
		//ne
		$numberToCheck = 8 - $chessboard->getPositionNumeric($currPos);
		$newPos  = $currPos;
		for ($j = 0; $j < $numberToCheck; $j++)
		{
			$pos = $chessboard->getMoveUp($newPos);
			$pos = $chessboard->getMoveRight($pos);
			
			if ($pos != null)
			{
				//find out if there is a piece at this position, if so stop processing
				if ($chessboard->isPieceAtPosition($pos))
					break;
				else
				{	//print ("<BR> ne adding bishop pos: $pos");
					array_push ($vMoves, $pos);
				}	
			}
			else
				break;	
				
			$newPos = $pos;			
		}
		
		//sw
		$numberToCheck = $chessboard->getPositionNumeric($currPos) - 1;
		$newPos  = $currPos;
		for ($j = 0; $j < $numberToCheck; $j++)
		{
			$pos = $chessboard->getMoveDown($newPos);
			$pos = $chessboard->getMoveLeft($pos);
			
			if ($pos != null)
			{
				//find out if there is a piece at this position, if so stop processing
				if ($chessboard->isPieceAtPosition($pos))
					break;
				else
				{	//print ("<BR> sw adding bishop pos: $pos");
					array_push ($vMoves, $pos);
				}	
			}
			else
				break;	
				
			$newPos = $pos;			
		}
		
		//se
		$numberToCheck = $chessboard->getPositionNumeric($currPos) - 1;
		$newPos  = $currPos;
		for ($j = 0; $j < $numberToCheck; $j++)
		{
			$pos = $chessboard->getMoveDown($newPos);
			$pos = $chessboard->getMoveLeft($pos);
			
			if ($pos != null)
			{
				//find out if there is a piece at this position, if so stop processing
				if ($chessboard->isPieceAtPosition($pos))
					break;
				else
				{	//print ("<BR> se adding bishop pos: $pos");
					array_push ($vMoves, $pos);
				}	
			}
			else
				break;	
				
			$newPos = $pos;			
		}
		
		print ("<BR> valid bishop's moves: ");
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
		
		//find out which direction its moving in
		
		//north?
		if ($toNum > $fromNum)
		{
			//west?
			if (Chessboard::getNumericAlphaIndex($toAlpha) < Chessboard::getNumericAlphaIndex($fromAlpha))
			{
				$numberToCheck = $fromNum - $toNum;
				
				for ($j = 0; $j <= $numberToCheck; $j++)
				{
					$pos = $chessboard->getMoveUp($from);
					$pos = $chessboard->getMoveLeft($pos);	
					
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
		 	else
		 	{
			 	$numberToCheck = $toNum - $fromNum;
				
				for ($j = 0; $j <= $numberToCheck; $j++)
				{
					$pos = $chessboard->getMoveUp($from);
					$pos = $chessboard->getMoveRight($pos);	
					
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
		else //south
		{
			//west?
			if (Chessboard::getNumericAlphaIndex($toAlpha) < Chessboard::getNumericAlphaIndex($fromAlpha))
			{
				$numberToCheck = $fromNum - $toNum;
				
				for ($j = 0; $j <= $numberToCheck; $j++)
				{
					$pos = $chessboard->getMoveDown($from);
					$pos = $chessboard->getMoveLeft($pos);	
					
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
		 	else
		 	{
			 	$numberToCheck = $toNum - $fromNum;
				
				for ($j = 0; $j <= $numberToCheck; $j++)
				{
					$pos = $chessboard->getMoveDown($from);
					$pos = $chessboard->getMoveRight($pos);	
					
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