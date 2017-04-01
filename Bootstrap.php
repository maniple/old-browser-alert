<?php

class OldBrowserAlert_Bootstrap extends Maniple_Application_Module_Bootstrap
{
    public function getModuleDependencies()
    {
        return array();
    }

    public function getTranslationsConfig()
    {
        return array(
            'scan'    => Zend_Translate::LOCALE_DIRECTORY,
            'content' => dirname(__FILE__) . '/languages',
        );
    }

    public function getViewConfig()
    {
        return array(
            'scriptPaths' => dirname(__FILE__) . '/views/scripts',
            'helperPaths' => array(
                'OldBrowserAlert_View_Helper_' => dirname(__FILE__) . '/library/View/Helper/',
            ),
        );
    }
}
