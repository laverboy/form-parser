<?php

namespace FormParser;

class FormParserTest extends \PHPUnit_Framework_TestCase
{
    private $testDir;

    protected function setUp()
    {
        parent::setUp();

        $this->testDir = dirname(dirname(__FILE__)) . '/form-samples/';
    }


    public function testInstantiatesWithForm()
    {
        $fp = new FormParser($this->testDir . 'contact-form.php');
        $this->assertInstanceOf('FormParser\FormParser', $fp);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThrowsExceptionWhenTemplateNotFound()
    {
        $fp = new FormParser();
        $fp->setTemplate('there-is-no-spoon.php');
    }

    public function testInputExistsReturnsTrue()
    {
        $fp = new FormParser($this->testDir . 'contact-form.php');
        $this->assertTrue($fp->inputExists('firstname'));
    }

    public function testInputExistsReturnsFalse()
    {
        $fp = new FormParser($this->testDir . 'contact-form.php');
        $this->assertFalse($fp->inputExists('ghost'));
    }

}
