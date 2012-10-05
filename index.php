<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
<HTML>
	<HEAD>
		<TITLE> Example Chess Game Display Page </TITLE>
	</HEAD>
	<BODY>
		 <h1> Chess Script To Use Chess Classes </h1>
		 
		 A series of moves is being run on a Chessboard object,
		 to add moves - go to chessSetup.php and add them in the
		 function getMovesForMatch().
		 <br>
		 After each move is made, the board is redisplayed in a 
		 representation of the Chess Piece objects. bP is a black
		 pawn, while wN is a white knight.		 
		 <br>
		 <br>
		 Given more time I would work on the following:
		 <br>
		 	= visibility of all the functions and make sure they have
		 	appropriate scope. Right now all properties are protected,
		 	but some functions should only have protected or even private
		 	status as well instead of the default public.
		 <br>
		 	= adding logging for things instead of print statements
		 <br>	
		 	= using a Smarty tpl or other display logic to present the page
		 	  better.
		 <br>
		 	= more validation logic on every input.
		 <br>
		 	= Eventually evolve this into being playable with human input, 
		 	right now this just shows off some classes and move validation.
		 
		 <hr>
		 
		 <?php 
		 	require_once "chessSetup.php";
			 	
		 ?>
	</BODY>
</HTML>
