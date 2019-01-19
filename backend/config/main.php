<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
//     'controller' => [
//             'class'=>'backend\controllers\TemaihuiController',
//             'on EVENT_BEFORE_ACTION'=>function (){
//                 echo 'forst~~~';
//             }
//         ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        
//         'user' => [
//             'identityClass' => 'common\models\User',
//             'enableAutoLogin' => true,
// //             'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
//             'identityCookie' => ['name' => 'zdl', 'httpOnly' => true],
//         ],
//         'session' => [
//             // this is the name of the session cookie used for login on the backend
// //             'name' => 'advanced-backend',
//            'name' => 'advanced-zdl', 
//         ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*
         *url管理 
         */
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        
    ],
    'params' => $params,
];
