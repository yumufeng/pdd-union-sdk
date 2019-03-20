<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/20
 * Time: 10:10
 */

namespace pddUnionSdk;


use pddUnionSdk\Api\Goods;
use pddUnionSdk\Api\Link;
use pddUnionSdk\Api\Promotion;
use pddUnionSdk\Api\Theme;

/**
 * Class pddUnionFactory
 * @package pddUnionSdk
 * @property Goods goods ;
 * @property Promotion promotion;
 * @property Link link;
 * @property Theme theme;
 */
class pddUnionFactory
{
    private $config;
    private $error;

    public function __construct($config = null)
    {
        if (empty($config)) {
            throw new \Exception('no config');
        }
        $this->config = $config;
        return $this;
    }


    public function __get($api)
    {
        try {
            $classname = __NAMESPACE__ . "\\Api\\" . ucfirst($api);
            if (!class_exists($classname)) {
                throw new \Exception('pdd Union Sdk Api Undefined');
                return false;
            }
            $new = new $classname($this->config, $this);
            return $new;
        } catch (\Exception $e) {
            throw new \Exception('api undefined');
        }
    }

    /**
     * 设置错误信息
     * @param $message
     */
    public function setError($message)
    {
        $this->error = $message;
    }

    /**
     * 获取错误信息
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }
}