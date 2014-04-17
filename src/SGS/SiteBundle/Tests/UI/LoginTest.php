<?php
/**
 * Created by PhpStorm.
 * User: sean
 * Date: 17/04/2014
 * Time: 11:23
 */

namespace SGS\SiteBundle\Tests\UI;


use WebDriver\LocatorStrategy;
use WebDriver\Exception;

class LoginTest extends SeleniumTestCase{

    public function testLogin() {
        $this->loginWith( 'tester', 'udiff' );
        $this->sleep();
        $this->pageHeaderIs( "Welcome" );
    }

    public function testBadLogin() {
        $this->loginWith( 'foo', 'bar' );
        $this->sleep();
        try {
            $this->session->element( LocatorStrategy::XPATH, "//div[text()='Bad credentials']");
        }
        catch (Exception\NoSuchElement $e) {
            $this->fail();
        }
    }
} 