<?php

class OldBrowserAlert_View_Helper_OldBrowserAlert
    extends Zend_View_Helper_Abstract
    implements Zefram_Twig_SafeInterface
{
    /**
     * @var bool
     */
    protected $_isOldBrowser;

    /**
     * @return OldBrowserAlert_View_Helper_OldBrowserAlert
     */
    public function oldBrowserAlert() // {{{
    {
        return $this;
    } // }}}

    /**
     * @return string
     */
    public function toString() // {{{
    {
        if ($this->needShowAlert()) {
            // append stylesheet
            return $this->view->renderScript('alert.html.twig', 'old-browser-alert');
        }
        return '';
    } // }}}

    /**
     * Append stylesheet to headStyle view helper.
     *
     * @return void
     */
    public function appendStyle() // {{{
    {
        if ($this->needShowAlert()) {
            $style = $this->view->renderScript('style.css.twig', 'old-browser-alert');
            $this->view->headStyle()->appendStyle($style);
        }
    } // }}}

    /**
     * @return bool
     */
    public function isOldBrowser()
    {
        if ($this->_isOldBrowser === null) {
            $ua = Zend_Controller_Front::getInstance()->getRequest()->getServer('HTTP_USER_AGENT');

            switch (true) {
                case preg_match('/(MSIE\s[1-7]\.)/i', $ua):
                    // MSIE 1-7 are considered old
                    $this->_isOldBrowser = true;
                    break;

                case preg_match('/rv:(?<gecko_version>[^\)]+)\)\s+Gecko/i', $ua, $match):
                    // Gecko engine older than 1.9.2 (Firefox 3.6) is old
                    $this->_isOldBrowser = version_compare($match['gecko_version'], '1.9.2', '<');
                    break;

                // WebKit version number is worthless when it comes to detecting
                // browser capabilities, see: http://www.quirksmode.org/webkit.html
                default:
                    $this->_isOldBrowser = false;
                    break;
            }
        }
        return $this->_isOldBrowser;
    }

    /**
     * @return bool
     */
    public function needShowAlert() // {{{
    {
        $front = Zend_Controller_Front::getInstance();
        return $this->isOldBrowser() && !$front->getRequest()->getCookie($this->getCookieName());
    } // }}}

    /**
     * @return string
     */
    public function getCookieName() // {{{
    {
        return 'old-browser-alert';
    } // }}}

    /**
     * @return array
     */
    public function getSafe() // {{{
    {
        return array('html');
    } // }}}

    /**
     * @return string
     */
    public function __toString() // {{{
    {
        try {
            return $this->toString();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    } // }}}
}
