<?php

return array(

    // Set to TRUE to enable profiling, FALSE to disable. NULL to listen to the app.debug value (default)
    'profiler' => null,

    // Set to TRUE to activate URL based Profiler enabling/ disabling (add /_profiler to the root url to activate the toggle mechanism, e.g. http://localhost/_profiler)
    'urlToggle' => true,

    // Change below urlTogglePassword from *(string) mt_rand(0, microtime(true))* to your prefered password for improved security in production environments.
    'urlTogglePassword' => \Hash::make((string) mt_rand(0, microtime(true))),

    // Profiler can hide certain footer elements and be annoying. This makes it minimized by default. Set TRUE to enable.
    'minimized' => true,

    // Buttons: order /disable buttons
    'btns' => array(
        'environment'=> array('label'=>'ENV','title'=>'Environment'),
        'memory'=>        array('label'=>'MEM','title'=>'Memory'),
        'controller'=>    array('label'=>'CTRL','title'=>'Controller'),
        'routes'=>        array('label'=>'ROUTES'),
        'log'=>            array('label'=>'LOG'),
        'sql'=>            array('label'=>'SQL'),
        'checkpoints'=> array('label'=>'TIME'),
        'file'=>        array('label'=>'FILES'),
        'view'=>        array('label'=>'VIEW'),
        'session'=>        array('label'=>'SESSION'),
        'config'=>        array('label'=>'CONFIG'),
        'storage'=>        array('label'=>'LOGS','title'=>'Logs in storage'),
        'auth'=>        array('label'=>'AUTH'),
        'auth-sentry'=> array('label'=>'AUTH')
    ),
    'doc' => 'http://www.laravel.com/docs/',

);
