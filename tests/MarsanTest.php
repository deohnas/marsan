<?php
namespace Marsan\Test;

use \Marsan\Marsan;

class MarsanTest extends \PHPUnit_Framework_TestCase
{
    protected $marsan;

    protected function setUp()
    {
        $this->marsan = new Marsan();
    }

    public function testBasicTagWhitelist()
    {
        $this->assertEquals("<h1>Hello World</h1>", $this->marsan->sanitizeHtml("<h1>Hello World</h1>"));
    }

    public function testLinkWhitelist()
    {
        $this->assertEquals("<a href=\"http://google.com/\">Google</a>", $this->marsan->sanitizeHtml("<a href=\"http://google.com/\">Google</a>"));
    }

    public function testSanitizeBadHtml()
    {
        $this->assertEquals("alert('Hello World');", $this->marsan->sanitizeHtml("<script>alert('Hello World');</script>"));
    }
}