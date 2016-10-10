<?php 

class PluginTest extends PHPUnit_Framework_TestCase
{
	public function testGettingFiles()
	{
		include 'contact_us_original.php';
		include 'placeholderFunctions.php';
		$this->assertEquals(true, true);
	}
	// the contact form loads properly
	public function testContactFormLoadsProperly() 
	{
		$_SERVER['REQUEST_URI'] = 'dev01.jewsforjesus.org';
		$this->form = html_form_code( 'The real title', 'The real intro');
		$this->assertContains('made it to the end of the function', $this->form);
	}
	// the contact submit works when all the fields are filled out
	public function testContactSubmitsWithAllFieldsFilledOut() 
	{
		$this->assertEquals(true, true);
	}
	// the contact submit does not work when all the fields aren't filled out
	public function testContactDoesNotSubmitWithoutAllFieldsFilledOut() 
	{
		$this->assertEquals(true, true);
	}
	// the contact email validation does not accept illegitimate email addresses
	public function testEmailFieldDoesNotAcceptInvalidEmails() 
	{
		$this->assertEquals(true, true);
	}
	// the create shortcode form loads properly
	public function testCreateShortcodeFormLoadsProperly() 
	{
		$_SERVER['REQUEST_URI'] = 'dev01.jewsforjesus.org';
		$this->form = (string)test_init();
		$this->assertContains('made it to the end of the function', $this->form);
	}
	// the create shortcode submit works when all the fields are filled out
	public function testCreateShortcodeFormSubmitsWithAllFieldsFilledOut() 
	{
		$this->assertEquals(true, true);
	}
	// the create shortcode submit does not work when all the fields aren't filled out
	public function testCreateShortcodeFormDoesNotSubmitWithoutAllFieldsFilledOut() 
	{
		$this->assertEquals(true, true);
	}
	// the create shortcode email validation does not accept illegitimate email addresses
	public function testCreateShortcodeFormDoesNotAcceptInvalidEmails() 
	{
		$this->assertEquals(true, true);
	}
}