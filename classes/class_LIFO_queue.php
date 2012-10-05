<?php
/* chess/classes/class_LIFO_queue.php

v1.0 2009.07.24 Valerie Thompson

This class implements a simple LIFO (last in first out) queue.
Normally I would place this class in a generic library folder,
but for now I'm throwing it in with the rest of the chess classes.
I consider this type of class to be something that can be used 
over and over again.

*/


class LIFO_queue
{

	//LIFO_queue properties
	protected $queue = array(); //this array serves as the base structure for the queue.
	
	function __construct()
	{
		
	}
	
	function queueCount ()
	{
		return count($this->queue);		
	}	

	function currentPos ()
	{
		return current ($this->queue);
	}	
	
	function currentKey ()
	{
		return key ($this->queue);
	} 
	
	function elementAt ($key)
	{
		return ($this->queue[$key]);	
	}

	function nextPos ()
	{
		return next ($this->queue);	
	}
	
	function prevPos ()
	{
		return prev ($this->queue);
	}
	
	function firstPos ()
	{
		return reset ($this->queue);
	}
	
	function endPos ()
	{
		return end ($this->queue);	
	}	
	
	function push ($element)
	{
		//put this newest element at the end
		array_push($this->queue, $element);
	}	
	
	function pop ()
	{
		//pull off the newest element
		return (array_pop($this->queue));						
	}
}

?>