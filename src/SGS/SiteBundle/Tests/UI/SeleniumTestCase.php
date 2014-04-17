<?php

namespace SGS\SiteBundle\Tests\UI;
use WebDriver\Browser;
use WebDriver\LocatorStrategy;
use WebDriver\WebDriver;
use WebDriver\Element;

abstract class SeleniumTestCase extends \PHPUnit_Framework_TestCase {

    /**
     * @var \WebDriver\Session
     */
    protected $session;

    /**
     * @var \WebDriver\WebDriver
     */
    protected $webdriver;

    public function setUp() {
        $this->webdriver = new WebDriver();
        $this->session = $this->webdriver->session( Browser::CHROME );
        $this->session->window('current')->postSize( [ 'width' => 1440, 'height' => 900 ] );
        $this->session->open( "http://localhost/~sean/udiff-selenium/web/app_testing.php");
    }

    public function tearDown() {
        $this->session->close();
    }

    protected function loginWith($username, $password) {
     d
        $this->fillField('username', $username);
        $this->fillField('password', $password);

        $this->session->element( LocatorStrategy::ID, 'submit' )->click();
    }

    protected function pageHeaderIs( $text ) {
        $header = $this->session->element( LocatorStrategy::CSS_SELECTOR, '.page-header h1' )->text();
        $this->assertEquals( $text, $header );
    }

    protected function fillField( $field, $value ) {
        $element = $this->session->element(LocatorStrategy::ID, $field);
        $this->sendValue($element, $value);
    }

    protected function clickLink($text) {
        $this->session->element(LocatorStrategy::LINK_TEXT, $text)->click();
    }

    protected function sendValue( Element $element, $value ) {
        $element->postValue( [ "value" => str_split( $value, 1 ) ] );
    }
} 