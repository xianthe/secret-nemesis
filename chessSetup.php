<?php

print ("<BR> Php version: ");
echo PHP_VERSION;
$docroot = $_SERVER['DOCUMENT_ROOT'];
print ("<BR> Docroot: $docroot");

require_once "classes/class_Chessboard.php";

$chessboard = new Chessboard();
$pieces = $chessboard -> getDisplayBoard();

//This function prints out a simple chess board display
function displayChessboard ($pieces)
{

	$alphaIndex = array ('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h');
	
	print ("<table border=\"1\" cellpadding=\"10\">");
	print ("<tr>");
	print ("<td> </td>");
	foreach ($alphaIndex as $aI)
	{
		print ("<td> $aI </td>");
	} 
	print ("<td> </td>");
	print ("</tr>");
	
	for ($j = 8; $j > 0; $j--)
	{
		print ("<tr>");
		print ("<td>$j</td>");
		foreach ($alphaIndex as $aI)
		{
			if (!empty($pieces[$j][$aI]))
			{
				$abbrev 	= $pieces[$j][$aI]->getTypeAbbrev();
				$colorNote  = $pieces[$j][$aI]->getColorAbbrev();
				print ("<td>" . $colorNote . $abbrev . "</td>");  
			}
			else
				print ("<td> </td>");
		}
		print ("<td>$j</td>");		
	}	

	print ("<tr>");
	print ("<td> </td>");
	foreach ($alphaIndex as $aI)
	{
		print ("<td> $aI </td>");
	} 
	print ("<td> </td>");
	print ("</tr>");
	
	print ("</table>");

}

//pretend we have some moves for a match
function getMovesForMatch ()
{
	//array of chess moves assuming a few things:
	/* 	- light/dark take turns 
		- the moves are set up to take a piece and move it to another,
			so moving pawn e2 -> e4 would be stored as the first 2 elements in a multidimensional array.
		- there are many things that would need to be done to support algebraic chess notation, 
			I didn't go into that here.		
		
	*/
	$matchMoves = array();
	
	/*
	$matchMoves [0]['from'] = "e2";
	$matchMoves [0]['to'] 	= "e4";
	$matchMoves [1]['from'] = "c7";
	$matchMoves [1]['to']	= "c5";
	
	$matchMoves [2]['from'] = "g1";
	$matchMoves	[2]['to']	= "f3";
	$matchMoves [3]['from'] = "b8";
	$matchMoves [3]['to']	= "c6";
	
	//begin invalid off board examples
	$matchMoves [4]['from'] = "c6";
	$matchMoves [4]['to'] 	= "c9";
	
	$matchMoves [5]['from'] = "c6";
	$matchMoves [5]['to'] 	= "c0";
	
	$matchMoves [6]['from'] = "c6";
	$matchMoves [6]['to'] 	= "z9";
	*/
	//begin invalid examples for particular pieces
	
	//king =======================
	//bad move
	$matchMoves [7]['from'] = "e8";
	$matchMoves [7]['to'] 	= "g7";
	
	//bad move because pieces are in the way
	$matchMoves [8]['from'] = "e8";
	$matchMoves [8]['to'] 	= "f7";
	
	//rook =========================
	//bad move
	$matchMoves [9]['from'] = "h8";
	$matchMoves [9]['to'] 	= "h5";
	
	//move pawn first
	$matchMoves [10]['from'] = "h7";
	$matchMoves [10]['to'] 	 = "h6";	
	$matchMoves [11]['from'] = "h6";
	$matchMoves [11]['to'] 	 = "h5";
	$matchMoves [12]['from'] = "h5";
	$matchMoves [12]['to'] 	 = "h4";
	$matchMoves [13]['from'] = "h8";
	$matchMoves [13]['to'] 	 = "h5";
	
	//bishop ========================
	//bad move
	$matchMoves [14]['from'] 	= "c8";
	$matchMoves [14]['to'] 		= "b8";
	
	//bad move because pieces are in the way
	$matchMoves [15]['from'] 	= "c8";
	$matchMoves [15]['to'] 		= "c7";
	
	//move pawn first
	$matchMoves [16]['from'] 	= "b7";
	$matchMoves [16]['to'] 		= "b6";
	$matchMoves [17]['from'] 	= "c8";
	$matchMoves [17]['to'] 		= "a6";
	
	//queen ==========================
	$matchMoves [18]['from'] 	= "d8";
	$matchMoves [18]['to'] 		= "c8";
	
		
	//setting up a check for between functions - rook
	$matchMoves [19]['from'] 	= "f2";
	$matchMoves [19]['to'] 		= "f3";
	$matchMoves [20]['from'] 	= "f3";
	$matchMoves [20]['to'] 		= "f4";
	$matchMoves [21]['from'] 	= "f4";
	$matchMoves [21]['to'] 		= "f5";
	
	$matchMoves [22]['from'] 	= "h5";
	$matchMoves [22]['to'] 		= "e5";
	
	//demonstrating capture move a pawn to capture
	$matchMoves [23]['from'] 	= "f7";
	$matchMoves [23]['to'] 		= "f6";
	$matchMoves [24]['from'] 	= "g7";
	$matchMoves [24]['to'] 		= "g6";
	$matchMoves [25]['from'] 	= "f5";
	$matchMoves [25]['to'] 		= "g6";
	

	return ($matchMoves);
}



function playGame ($chessboard)
{
	//This function simulates a match
	
	$matchMoves = getMovesForMatch();
	$count = count($matchMoves);
	print ("<br> Number of total moves: $count");
	//display board changes
	//$chessboard -> resortDisplayBoard();
	//$pieces = $chessboard -> getDisplayBoard();
	//displayChessboard($pieces);
	
	foreach ($matchMoves as $mMove)
	{
		//check if from piece exists
		$fpiece = $chessboard->getPieceAtPosition($mMove['from']);
		if (!empty($fpiece))
		{
			//check if the to location is even on the board
			if ($chessboard->validPositionOnBoard ($mMove['to']))
			{
				print ("<br> Move: " . $mMove['to'] . " is valid on the board. <br>");
				if ($chessboard->validateMove($mMove['from'], $mMove['to'], $fpiece, $chessboard))
				{
					//move the piece to new location 
					print ("<BR> Current Position: " . $mMove['from'] . " </BR>");
					print ("<BR> After Position: " . $mMove['to'] . " </BR>");	
					
						//perfom captures/promotions (AI goes here to do this)
						//this would move appropriate pieces "off the board" by changing their 
						//status $captured to true.
						
						//display board changes
						$chessboard->move($mMove['from'], $mMove['to']);
						$chessboard -> resortDisplayBoard();
						$pieces = $chessboard -> getDisplayBoard();
						displayChessboard($pieces);
							
										
				}
				else
				{
					$type = strtolower($fpiece->getPieceType());
					print("That is not a valid move for a $type, skipping move.");
				}				
			}
			else
				print ("<br> Move: " . $mMove['to'] . " is not on the board, skipping. <br>");
		}
		else
			print ("<br>The piece you have selected does not exist");	
		
		
			
		
	}
}

displayChessboard($pieces);
playGame($chessboard);


?>