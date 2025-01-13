<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=mysql4;dbname=mysql',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8',
	'tablePrefix' => 'app_',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
