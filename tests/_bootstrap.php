<?php
// define('YII_ENV', 'test');
// defined('YII_DEBUG') or define('YII_DEBUG', true);

// require_once __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
// require __DIR__ .'/../vendor/autoload.php';
// $config = require __DIR__ . '/../config/test.php';
// new yii\console\Application($config);

// Определение тестового окружения и включение отладочного режима
define('YII_ENV', 'test');
defined('YII_DEBUG') or define('YII_DEBUG', true);

// Подключение основных файлов Yii2 и Composer автозагрузчика
require_once __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../vendor/autoload.php';

// Загрузка конфигурации для тестов
$config = require __DIR__ . '/../config/test.php';

// Инициализация приложения Yii2 для функционального тестирования
new yii\web\Application($config);
