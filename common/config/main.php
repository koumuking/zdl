<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => 'zdl', 'httpOnly' => true],
            //             'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
        //             'name' => 'advanced-frontend',
            'name' => 'advanced-zdl',
        ],
        'assetManager' =>array (
            'class' => 'yii\web\AssetManager',
            'appendTimestamp' => true,
            'forceCopy' => false,
        ),
    ],
];
