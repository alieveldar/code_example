<?php
$params = require __DIR__ . '/params.php';
$test_db = require __DIR__ . '/test_db.php';
/**
 * Application configuration shared by all test types
 */
return [
    'id' => 'basic-tests',
    'basePath' => dirname(__DIR__),
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'language' => 'en-US',
    'components' => [
        'db' => $test_db,
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
            'messageClass' => 'yii\symfonymailer\Message'
        ],
        'assetManager' => [
            'basePath' => __DIR__ . '/../web/assets',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'request' => [
            'cookieValidationKey' => 'test',
            'enableCsrfValidation' => false,
            // but if you absolutely need it set cookie domain to localhost
            /*
            'csrfCookie' => [
                'domain' => 'localhost',
            ],
            */
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'controller' => [
                        'todo' => 'api/todo',
                    ],
                    'patterns' => [
                        'PUT,PATCH {id}' => 'update',
                    ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                    ],
                    'prefix' => 'api',
                    'class' => \yii\rest\UrlRule::class,
                ],

                '/' => 'todo/index',
                '<action:[\w-]+>/<id:\d+>' => 'todo/<action>',
                '<action:[\w-]+>' => 'todo/<action>',
            ],
        ],
    ],
    'params' => [
        'environment' => 'test',
    ],
];
