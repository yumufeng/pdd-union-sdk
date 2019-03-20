<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/20
 * Time: 13:36
 */

error_reporting(E_ALL);
require dirname(__DIR__) . '/vendor/autoload.php';

header("content-type: application/json;charset=UTF-8");

$config = [
    'appId' => '',
    'appSk' => '',
    'ddkId' => ''
];
//'1628880_31417969', true
$pdd = new \pddUnionSdk\pddUnionFactory($config);

$info = $pdd->goods->mall('918323727');

if ($info === false) {
    var_dump($pdd->getError());
}

var_dump($info);