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

    protected $sleep = 0;

    public function setUp() {
        $this->webdriver = new WebDriver();
        $this->session = $this->webdriver->session( Browser::CHROME );
        $this->sleep();
        $this->session->window('current')->postSize( [ 'width' => 1440, 'height' => 900 ] );
        $this->session->open( "http://localhost/~sean/udiff-selenium/web/app_testing.php");
    }

    public function tearDown() {
        $this->session->close();
    }

    protected function sendValue( Element $element, $value ) {
        $element->postValue( [ "value" => str_split( $value, 1 ) ] );
    }

    protected function loginWith($username, $password) {
        $usernameField = $this->session->element( LocatorStrategy::ID, 'username' );
        $this->sendValue( $usernameField, $username );

        $this->sleep();

        $passwordField = $this->session->element( LocatorStrategy::ID, 'password' );
        $this->sendValue( $passwordField, $password );

        $this->sleep();

        $this->session->element( LocatorStrategy::ID, 'submit' )->click();
    }

    protected function sleep() {
        sleep( $this->sleep );
    }

    protected function pageHeaderIs( $text ) {
        $header = $this->session->element( LocatorStrategy::CSS_SELECTOR, '.page-header h1' )->text();
        $this->assertEquals( $text, $header );
    }

    protected function clickLink($text) {
        $this->session->element(LocatorStrategy::LINK_TEXT, $text)->click();
    }
} 