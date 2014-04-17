<?php
namespace SGS\SiteBundle\Tests\UI;


use WebDriver\LocatorStrategy;
use WebDriver\Exception;

class MainTest extends SeleniumTestCase {
    public function setUp() {
        parent::setUp();
        $this->loginWith('tester', 'udiff');
    }

    public function testListingBooks(){
        $this->goToBooksPage();
        $this->assertBookWithTitleAndAuthor('The Lord Of The Rings', 'J. R. R. Tolkien');
        $this->assertBookWithTitleAndAuthor('Dune', 'Frank Herbert');
    }

    public function testReadingBook(){
        $this->goToBooksPage();
        $this->clickLink('Dune');
        $this->assertBookTitleIs('Dune');
    }

    protected function goToBooksPage() {
        $this->clickLink("Books");
    }

    protected function assertBookWithTitleAndAuthor( $title, $author ) {
        try {
            $this->session->element(LocatorStrategy::XPATH, "//tr[@class='book' and td[@class='title']/a[text()='$title'] and td[@class='author' and text()='$author']]");
        }
        catch( Exception\NoSuchElement $e ) {
            $this->fail();
        }
    }

    protected function assertBookTitleIs( $title ) {
        $book_title = $this->session->element(LocatorStrategy::ID,'book_title');
        $this->assertEquals($title, $book_title->text());
    }
} 