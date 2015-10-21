<?php

namespace OldBrowserAlert;

use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $sm = $e->getApplication()->getServiceManager();

        /** @var $view \Zend_View_Abstract */
        $view = $sm->get('View');
        $view->addHelperPath(__DIR__ . '/module/views/helpers', 'OldBrowserAlert_View_Helper_');
    }
}
