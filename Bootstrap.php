<?php

class OldBrowserAlert_Bootstrap extends Zend_Application_Module_Bootstrap
{
    /**
     * @throws Zend_Application_Bootstrap_Exception
     * @throws Zend_Translate_Exception
     */
    protected function _initTranslations()
    {
        $bootstrap = $this->getApplication();
        if (!$bootstrap instanceof Zend_Application_Bootstrap_BootstrapAbstract) {
            return;
        }
        if (!$bootstrap->hasPluginResource('Translate') && !is_callable($bootstrap, '_initTranslate')) {
            return;
        }

        /** @var Zend_Translate_Adapter $translate */
        $translate = $bootstrap->bootstrap('Translate')->getResource('Translate')->getAdapter();

        $localeDirectory = dirname(__FILE__) . '/languages/' . $translate->getLocale();
        if (is_dir($localeDirectory)) {
            $options = array(
                'locale'  => $translate->getLocale(),
                'content' => $localeDirectory,
                'scan'    => Zend_Translate::LOCALE_DIRECTORY,
            );
            if (($cache = $translate->getCache()) !== null) {
                $options['cache'] = $cache;
            }

            $translate->addTranslation(new Zend_Translate_Adapter_Array($options));
        }
    }

    /**
     * @throws Zend_Application_Bootstrap_Exception
     */
    protected function _initView()
    {
        $bootstrap = $this->getApplication();
        if (!$bootstrap instanceof Zend_Application_Bootstrap_BootstrapAbstract) {
            return;
        }
        if (!$bootstrap->hasPluginResource('View') && !is_callable($bootstrap, '_initView')) {
            return;
        }

        /** @var Zend_View $view */
        $view = $bootstrap->bootstrap('View')->getResource('View');

        $view->addScriptPath(dirname(__FILE__) . '/views/scripts');
        $view->addHelperPath(dirname(__FILE__) . '/views/helpers', 'OldBrowserAlert_View_Helper_');
    }
}
