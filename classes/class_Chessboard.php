<?php

/*
chess/classes/class_Chessboard.php

v1.0 2009.07.24 Valerie Thompson

This is a class for setting up a default chessboard.

Chessboard for reference:
 	a	b	c	d	e	f	g	h
 8	R	N 	B	Q	K 	B	N	R	8 //black
 7	P 	P	P 	P 	P 	P 	P 	P 	7
 6									6
 5									5
 4									4
 3									3
 2	P 	P 	P 	P 	P 	P 	P 	P 	2 //white
 1  R	N	B 	Q	K	B	N	R 	1
 	a	b	c	d	e	f	g	h							

*/



//chessboards are filled with chess pieces
require_once "class_Pawn.php";
require_once "class_Rook.php";
require_once "class_Bishop.php";
require_once "class_King.php";
require_once "class_Knight.php";
require_once "class_Queen.php";

//color constants
define ("DARK" , "black");
define ("LIGHT", "white");

class Chessboard {
	//chessboard properties
	protected $setup 			= false; 	//flag variable indicating if the chessboard has been initialized
	protected $displayBoard 	= array();	//array of chess pieces for display purposes
	protected $chessPieces		= array();  //array containing all pieces accessable by name/color
	protected $alphaIndex 		= array();  //array of alpha letters on board 
	
	//default constructor
	function __construct()
	{
		/* Note: on the chess piece structure - there are other structures we could create
			for better access/searching or performing actions on a group - like if you wanted
			to do a certain animation or color change on the remaining knights on the board.
			
			In those cases you can create the virtual equivalent of tuples or other kinds of 
			sets to better logically represent the data - it would all depend on what other
			kinds of operations you want and why the current access method (array key/value)
			would or would not be suitable.	
		
		 */	
		
		//setup alphaIndex
		$this->alphaIndex = array ('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h');
		
		//create pieces and their default positions
		//black 
		
			
			$blackPieces = array ( LIGHT => array ( 
				//rooks
				"rook1" => new Rook ("a8", DARK, DARK . "_rook1"),
				"rook2" => new Rook ("h8", DARK, DARK . "_rook2"),
				
				//knights
				"knight1" => new Knight ("b8", DARK, DARK . "_knight1"),
				"knight2" => new Knight ("g8", DARK, DARK . "_knight2"),
				
				//bishops
				"bishop1" => new Bishop ("c8", DARK, DARK . "_bishop1"),
				"bishop2" => new Bishop ("f8", DARK, DARK . "_bishop2"),

				//queen
				"queen1" => new Queen ("d8", DARK, DARK . "_queen1"),
				
				//king
				"king1" => new King ("e8", DARK, DARK . "_king1"),
				
				//pawns
				"pawn1" => new Pawn ("a7", DARK, DARK . "_pawn1"),
				"pawn2" => new Pawn ("b7", DARK, DARK . "_pawn2"),
				"pawn3" => new Pawn ("c7", DARK, DARK . "_pawn3"),
				"pawn4" => new Pawn ("d7", DARK, DARK . "_pawn4"),
				"pawn5" => new Pawn ("e7", DARK, DARK . "_pawn5"),
				"pawn6" => new Pawn ("f7", DARK, DARK . "_pawn6"),
				"pawn7" => new Pawn ("g7", DARK, DARK . "_pawn7"),
				"pawn8" => new Pawn ("h7", DARK, DARK . "_pawn8"),
			));
			
		//white
		$whitePieces = array ( DARK => array ( 
				//rooks
				"rook1" => new Rook ("a1", LIGHT, LIGHT . "_rook1"),
				"rook2" => new Rook ("h1", LIGHT, LIGHT . "_rook2"),
				
				//knights
				"knight1" => new Knight ("b1", LIGHT, LIGHT . "_knight1"),
				"knight2" => new Knight ("g1", LIGHT, LIGHT . "_knight2"),
				
				//bishops
				"bishop1" => new Bishop ("c1", LIGHT, LIGHT . "_bishop1"),
				"bishop2" => new Bishop ("f1", LIGHT, LIGHT . "_bishop2"),

				//queen
				"queen1" => new Queen ("d1", LIGHT, LIGHT . "_queen1"),
				
				//king
				"king1" => new King ("e1", LIGHT, LIGHT . "_king1"),
				
				//pawns
				"pawn1" => new Pawn ("a2", LIGHT, LIGHT . "_pawn1"),
				"pawn2" => new Pawn ("b2", LIGHT, LIGHT . "_pawn2"),
				"pawn3" => new Pawn ("c2", LIGHT, LIGHT . "_pawn3"),
				"pawn4" => new Pawn ("d2", LIGHT, LIGHT . "_pawn4"),
				"pawn5" => new Pawn ("e2", LIGHT, LIGHT . "_pawn5"),
				"pawn6" => new Pawn ("f2", LIGHT, LIGHT . "_pawn6"),
				"pawn7" => new Pawn ("g2", LIGHT, LIGHT . "_pawn7"),
				"pawn8" => new Pawn ("h2", LIGHT, LIGHT . "_pawn8"),

			));
			
		//create one array to house them both
		$this->chessPieces = array_merge ($blackPieces, $whitePieces);
		$this->sortPiecesForDisplay();	
			
		//board has been successfully initiated
		$this->setup = true;
		
	}
	
	function isSetup ()
	{
		return ($this -> setup);
	}
	
	function setSetupValue ($setup)
	{
		$this -> setup = $setup;
	}	
	
	function getDisplayBoard ()
	{
		return ($this -> displayBoard);	
	}
	
	function setDisplayBoard ($db)
	{
		$this->displayBoard = $db;
	}
	
	function isPieceAtPosition ($pos)
	{
		$alpha 	= $this -> getPositionAlpha ($pos);
		$num	= $this -> getPositionNumeric ($pos);
		
		if (empty($this -> displayBoard[$num][$alpha]))
			return false;
		else
			return true;
	}
	
	function getPieceAtPosition ($pos)
	{
		
		//returns the chess piece at this particular location
		//null if no piece is there
		$alpha 	= $this -> getPositionAlpha ($pos);
		$num	= $this -> getPositionNumeric ($pos);
				
		return $this -> displayBoard[$num][$alpha];
				
	}
	
	function getColorofPieceAtPosition ($pos)
	{
		
		//returns the chess piece at this particular location
		//null if no piece is there
		$alpha 	= $this -> getPositionAlpha ($pos);
		$num	= $this -> getPositionNumeric ($pos);
		
		
		
		return ($this -> displayBoard[$num][$alpha] -> getColor());
					
	}
	
		
	function sortPiecesForDisplay()
	{	
		//grab all pieces
		$piecesGrabA = array_values($this->chessPieces[LIGHT]);
		$piecesGrabB = array_values($this->chessPieces[DARK]);
		$piecesGrab = array_merge($piecesGrabA, $piecesGrabB);
		//print ("<BR> piecesGrab: ");
		//print_r($piecesGrab);
		
		
		//reindex this array based on position
		foreach ($piecesGrab as $value)
		{
			$alpha = $value -> getPositionAlpha();	
			$number = $value -> getPositionNumeric();	
			
			$this -> displayBoard[$number][$alpha] = $value;
		}	
		
		
		return ($this -> displayBoard);
	}
	
	function resortDisplayBoard()
	{
		$tempBoard = $this->getDisplayBoard();
		$tempBoardVals = array();
		$alphaIndex = $this->alphaIndex;
		
		for ($j = 8; $j > 0; $j--)
		{
			foreach ($alphaIndex as $aI)
			{
				//make sure the piece is not empty and not captured before adding it to be displayed
				if (!empty($tempBoard[$j][$aI]) && !($tempBoard[$j][$aI]->getCapturedStatus()) )
					array_push($tempBoardVals, $tempBoard[$j][$aI]);	
			}
				
		}
		
		foreach ($tempBoardVals as $value)
		{
			$alpha = $value -> getPositionAlpha();	
			$number = $value -> getPositionNumeric();	
			
			$newDisplayBoard[$number][$alpha] = $value;
		}	
		
		$this->setDisplayBoard($newDisplayBoard);	
	}
	
	function noPiecesBetween ($from, $to)
	{
		//find out if there are pieces between this piece and its destination
		$piece = $this->getPieceAtPosition($from);
		
		$piecesBetween = $piece -> getPiecesBetween($from, $to, $chessboard);
		
		if (empty($piecesBetween))
			return true;		
		else
			return false;	
		
	}
	
	function validDestination($from, $to)
	{
		//is there a piece of the same color on this square?
		//if so this location is invalid
		//else valid
		
		if ($this->isPieceAtPosition($to))
		{
			$color 	= $this->getColorOfPieceAtPosition($from);
			$color2 = $this->getColorOfPieceAtPosition($to);
			
			if ($color == $color2)
				return false;
			else
				return true;
		}	
		else
			return true;	
	}
	
	function noPiecesInTheWay($from, $to)
	{
		//This function returns true if no pieces are between $from, $to 
		//and no piece of the same color on the destination ($to)
		
		
		$validDest 			= $this->validDestination($from, $to);
		$noPiecesBetween 	= true;
		if ($validDest)
			print ("<br> No piece is at this destination or it is not the same color. ");
		else
		{
			$noPiecesBetween = $this->noPiecesBetween($from, $to);	
			print ("<br> There is a piece at that location or it is the same color as the piece you are trying to move. ");
		}			
			
		return $validDest && $noPiecesBetween;
	}	

	function validateMove($from, $to, $piece, $chessboard)
	{
		//This function returns true if move is valid
		/*
			Parse from /to moves appropriately to access the display board so if from is e2 
			and to is e4 this would be $this -> displayBoard[2][e] and $this -> displayBoard[4][e]:
				- check if it has a value
				- check if not captured
				- and so on,
				- perform AI check if moving $from and $to is valid - if so return true, else false
				
				returning true all the time for the sake of showing the program
			*/
		
			
		//find out if this is a valid move for this piece
		$fpiece = $chessboard->getPieceAtPosition($from);
		$validMoves = $piece->validMoves($chessboard, $fpiece);
		
		//Note: originally wrote functions to detect pieces in the way - as far as
		//testing I think the original methods validMoves takes care of this check
		//when breaking out of the loop if an invalid board position or a piece is in the way
		
		//if (in_array($to, $validMoves) && $chessboard->noPiecesInTheWay($from, $to))	only use this if there is a
		//bug found and more testing is needed
		if (in_array($to, $validMoves))		
			return true;	
		else
			return false;
	}
	
	
	function move ($from, $to)
	{
		//moves one piece from one location to another
		$fromAlpha 	= $this -> getPositionAlpha($from);
		$fromNum	= $this -> getPositionNumeric($from);		
		
		//captures
		if ($this->isPieceAtPosition($to))
		{
			$tpiece = $this->getPieceAtPosition($to);
		
			//if there is a piece at the position , capture it
			if ("King" == $tpiece->getPieceType())
				print ("<BR> Game over - Checkmate"); //TO DO: add more logic to end game here
			else	
			{
				print ("<BR> Piece formerly at $to captured.");
				$tpiece->setCapturedStatus(true);
			}
		}
		
		
		//perform move
		$piece 	=  $this -> displayBoard[$fromNum][$fromAlpha];
		$currPos = $piece -> getPosition();	
		
		$piece->setPosition($to);
		$afterPos = $piece -> getPosition();
		
		
		
	}
	

	function getPositionAlpha ($pos)
	{
		return (substr($pos, 0 , 1));	
	}
	
	function getPositionNumeric ($pos)
	{
		return (substr($pos, 1));
	}	
	
	public static function getNumericAlphaIndex ($char)
	{
		//print ("<br> char: $char");
		$alphaIndex = array ('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h');
		foreach ($alphaIndex as $key => $aI)
		{
			
			if ($aI == $char)
			{
				//print("<br> equal: $aI key: $key " );
			 	return $key;
		 	}
		 	//else
		 		//print("<br> not equal: $aI key: $key");	
		}	
		
	}
		
	function validPositionOnBoard ($pos)
	{
		//function to determine if this position is on the board
		$alpha 	= $this->getPositionAlpha ($pos);
		$num	= $this->getPositionNumeric ($pos);
		$alphaIndex = array ('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h');
		
		return (in_array($alpha, $alphaIndex) && ($num > 1) && ($num < 9));  	
		
	}
	
	function addToNumericPosition ($pos, $offset)
	{
		$newPos = null;
		
		//	moves position up (positive number offset) 
		// 	or down (negative number offset) null if invalid
		$alpha 	= $this->getPositionAlpha ($pos);
		$num	= $this->getPositionNumeric ($pos);
		
		$newNum = $num + $offset;
		if (($newNum > 1) && ($newNum < 9))
			$newPos = $alpha . $newNum;
			
		//print ("<br> added to numeric position: $newPos | <br>");	
		return $newPos;			
	}
	
	function addToHorizontalPosition ($pos, $offset)
	{
		$newPos	= null;
		
		//moves position left (negative number offset) or right
		//(positive number offset) null if invalid
		$alpha 	= $this->getPositionAlpha ($pos);
		$num	= $this->getPositionNumeric ($pos);
		$alphaIndex = array ('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h');
				
		$index = $this->getNumericAlphaIndex ($alpha);
		//print("<BR> Numerical Alpha index: $index offset: $offset");
		//gets the alpha to left or right of original
		$alphaNum = $this->getNumericAlphaIndex ($alpha) + $offset;
 		
		if (array_key_exists($alphaNum, $alphaIndex))
			$newPos = $alphaIndex[$alphaNum] . $num;
			
		//print ("<br> added to alpha position: $newPos | <br>");
		return $newPos;
		
	}
	
	function getMoveUp ($pos)
	{
		$newPos = null;
		//for a given position, returns the valid position above this
		//position, if there isn't one, return null.
		
		$newPos = $this->addToNumericPosition ($pos, 1);

		return $newPos;
	}
	
	function getMoveDown ($pos)
	{
		$newPos = null;
		//for a given position, returns the valid position down from this
		//position, if there isn't one, return null.
		
		$newPos = $this->addToNumericPosition ($pos, -1);

		return $newPos;
	}
	
	
	function getMoveLeft ($pos)
	{
		$newPos = null;
		//for a given position, returns the valid position left from this
		//position, if there isn't one return null;
		
		$newPos = $this->addToHorizontalPosition ($pos, -1);
		
		return $newPos;		
	}
	
	function getMoveRight ($pos)
	{
		$newPos = null;
		//for a given position, returns the valid position left from this
		//position, if there isn't one return null;
		
		$newPos = $this->addToHorizontalPosition ($pos, 1);
		
		return $newPos;		
		
	}
	
	
}

?>