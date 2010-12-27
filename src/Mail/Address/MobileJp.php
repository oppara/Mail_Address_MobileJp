<?php

/**
 * mobile email address in Japan
 * 
 * @see Mail::Address::MobileJp  http://search.cpan.org/~miyagawa/Mail-Address-MobileJp/
 * @package Mail/Address
 * @version 0.09
 * @author oppara <oppara _at_ oppara.tv> 
 */
class Mail_Address_MobileJp
{
    private $regex_imode = '^(?:docomo\.ne\.jp)$';

    private $regex_vodafone = '^(?:
        jp\-[dhtckrnsq]\.ne\.jp|
        [dhtckrnsq]\.vodafone\.ne\.jp|
        softbank\.ne\.jp|
        disney\.ne\.jp
    )$';

    private $regex_ezweb = '^(?:
        ezweb\.ne\.jp|
        .*\.ezweb\.ne\.jp
    )$';

    private $regex_mobile = '^(?:
        dct\.dion\.ne\.jp|
        tct\.dion\.ne\.jp|
        hct\.dion\.ne\.jp|
        kct\.dion\.ne\.jp|
        cct\.dion\.ne\.jp|
        sct\.dion\.ne\.jp|
        qct\.dion\.ne\.jp|
        oct\.dion\.ne\.jp|
        email\.sky\.tdp\.ne\.jp|
        email\.sky\.kdp\.ne\.jp|
        email\.sky\.cdp\.ne\.jp|
        sky\.tu\-ka\.ne\.jp|
        cara\.tu\-ka\.ne\.jp|
        sky\.tkk\.ne\.jp|
        .*\.sky\.tkk\.ne\.jp|
        sky\.tkc\.ne\.jp|
        .*\.sky\.tkc\.ne\.jp|
        email\.sky\.dtg\.ne\.jp|
        em\.nttpnet\.ne\.jp|
        .*\.em\.nttpnet\.ne\.jp|
        cmchuo\.nttpnet\.ne\.jp|
        cmhokkaido\.nttpnet\.ne\.jp|
        cmtohoku\.nttpnet\.ne\.jp|
        cmtokai\.nttpnet\.ne\.jp|
        cmkansai\.nttpnet\.ne\.jp|
        cmchugoku\.nttpnet\.ne\.jp|
        cmshikoku\.nttpnet\.ne\.jp|
        cmkyusyu\.nttpnet\.ne\.jp|
        pdx\.ne\.jp|
        d.\.pdx\.ne\.jp|
        wm\.pdx\.ne\.jp|
        phone\.ne\.jp|
        .*\.mozio\.ne\.jp|
        page\.docomonet\.or\.jp|
        page\.ttm\.ne\.jp|
        pho\.ne\.jp|
        moco\.ne\.jp|
        emcm\.ne\.jp|
        p1\.foomoon\.com|
        mnx\.ne\.jp|
        .*\.mnx\.ne\.jp|
        ez.\.ido\.ne\.jp|
        cmail\.ido\.ne\.jp|
        .*\.i\-get\.ne\.jp|
        willcom\.com
    )$';

    private static $instance = null;

    final private function __construct() {}

    /**
     * getInstance
     * 
     * @access public
     * @return Mail_Address_MobileJp
     */
    final public static function getInstance() {
        if ( self::$instance === null ) {
            self::$instance = new Mail_Address_MobileJp();
        }

        return self::$instance;
    }

    /**
     * whether $email is a mobile email address or not.
     * 
     * @param string email string
     * @return bool 
     * @access public
     */
    public function isMobileJp( $email ) {
        $domain = $this->_domain( $email );
        $regex = "(?:$this->regex_imode|$this->regex_vodafone|$this->regex_ezweb|$this->regex_mobile)";
        return $domain && preg_match( "/$regex/x", $domain );
    }

    public function isImode( $email ) {
        $domain = $this->_domain( $email );
        $regex = "(?:$this->regex_imode)";
        return $domain && preg_match( "/$regex/x", $domain );
    }

    public function isEzweb( $email ) {
        $domain = $this->_domain( $email );
        $regex = "(?:$this->regex_ezweb)";
        return $domain && preg_match( "/$regex/x", $domain );
    }

    public function isAu( $email ) {
        return $this->isEzweb( $email );
    }

    public function isSoftbank( $email ) {
        $domain = $this->_domain( $email );
        $regex = "(?:$this->regex_vodafone)";
        return $domain && preg_match( "/$regex/x", $domain );
    }

    public function isVodafone( $email ) {
        return $this->isSoftbank( $email );
    }

    private function _domain( $email ) {
        $pos = strstr( $email, '@' );
        if ( $pos === false ) return '';
        return substr( $pos, 1 );
    }
}

