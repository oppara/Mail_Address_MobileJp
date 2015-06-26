<?php
namespace Oppara\Mail\Address;

use Oppara\Mail\Address\MobileJp;

class MobileJpTest extends \PHPUnit_Framework_TestCase {

    protected $object;

    private $docomo = array(
        'foobar@docomo.ne.jp',
    );

    private $ezweb = array(
        'foobar@ezweb.ne.jp',
    );

    private $softbank = array(
        'foobar@softbank.ne.jp',
        'foobar@disney.ne.jp',
        'foobar@d.vodafone.ne.jp',
    );

    private $other = array(
        'foobar@willcom.com',
    );

    private $notMobile = array(
        'foobar@exmple.com',
        'foobar@docomo.co.jp',
    );

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp( ) {
        $this->object = MobileJp::getInstance( );
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown( ) {
    }

    public function testIsMobileJp( ) {
        $ok = array_merge($this->docomo, $this->ezweb, $this->softbank, $this->other);
        $notOk = $this->notMobile;
        $this->_assert('isMobileJp', $ok, $notOk);
    }

    public function testIsDocomo( ) {
        $ok = $this->docomo;
        $notOk = array_merge($this->notMobile, $this->ezweb, $this->softbank, $this->other);
        $this->_assert('isDocomo', $ok, $notOk);
    }

    public function testIsImode( ) {
        $ok = $this->docomo;
        $notOk = array_merge($this->notMobile, $this->ezweb, $this->softbank, $this->other);
        $this->_assert('isImode', $ok, $notOk);
    }

    public function testIsAu( ) {
        $ok = $this->ezweb;
        $notOk = array_merge($this->notMobile, $this->docomo, $this->softbank, $this->other);
        $this->_assert('isAu', $ok, $notOk);
    }

    public function testIsEzweb( ) {
        $ok = $this->ezweb;
        $notOk = array_merge($this->notMobile, $this->docomo, $this->softbank, $this->other);
        $this->_assert('isEzweb', $ok, $notOk);
    }

    public function testIsSoftbank( ) {
        $ok = $this->softbank;
        $notOk = array_merge($this->notMobile, $this->docomo, $this->ezweb, $this->other);
        $this->_assert('isSoftbank', $ok, $notOk);
    }

    private function _assert($func, $ok, $notOk) {
        foreach ( $ok as $email ) {
            $this->assertTrue( $this->object->{$func}( $email ), $email );
        }
        foreach ( $notOk as $email ) {
            $this->assertFalse( $this->object->{$func}( $email ), $email );
        }
    }
}
