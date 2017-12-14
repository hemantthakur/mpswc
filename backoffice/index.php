<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
// echo __DIR__;die;

require(__DIR__ . '/../yii2/vendor/autoload.php');
require(__DIR__ . '/../yii2/vendor/yiisoft/yii2/Yii.php');
//require(__DIR__ . '/../yii2/vendor/openkm/OpenKM.php');
require(__DIR__ . '/../yii2/vendor/yiisoft/yii2/helpers/Precho.php');
require(__DIR__ . '/../yii2/vendor/yiisoft/yii2/helpers/Projectidvs.php');
require(__DIR__.'/constants.php');
$config = require(__DIR__ . '/../yii2/config/web.php');

(new yii\web\Application($config))->run();
