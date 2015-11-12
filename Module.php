<?php

namespace OldBrowserAlert;

class Module
{
    public function getConfig()
    {
        return array(
            'resources' => array(
                'view' => array(
                    'helperPath' => array(
                        'OldBrowserAlert_View_Helper_' => __DIR__ . '/module/views/helpers/',
                    ),
                    'scriptPath' => array(
                        __DIR__ . '/module/views/scripts',
                    ),
                ),
            ),
        );
    }
}
