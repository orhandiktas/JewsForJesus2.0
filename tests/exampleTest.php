<?php 

class ExampleTest extends PHPUnit_Framework_TestCase
{
	public function testWhatever()
	{
		$this->assertEquals(false, false);
	}
	public function testGetFile() 
	{
		include 'example.php';
		$this->assertEquals(false, false);
	}
	public function testRenderReturnsHelloWorld() 
	{
		$page = new Example();
		$this->assertEquals('Hello World', $page->Render());
	}
}

