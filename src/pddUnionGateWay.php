<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/20
 * Time: 10:13
 */

namespace pddUnionSdk;

use pddUnionSdk\Tools\Helpers;

/**
 * 多多客网关
 * Class pddUnionGateWay
 * @package pddUnionSdk
 */
class pddUnionGateWay
{
    /**
     * 默认网关
     */
    const URL = 'https://gw-api.pinduoduo.com/api/router';
    /**
     * 拼多多 client_id
     * @var
     */
    protected $appId;
    /**
     * 拼多多 client_secret
     * @var
     */
    protected $appSk;

    /**
     * 多多客ID
     * @var
     */
    protected $ddkId;

    /**
     * 默认的PID
     * @var
     */
    protected $pid;

    /**
     * 是否强制使用curl，不自动适配swoole协程客户端
     * @var bool
     */
    private $isCurl = false;
    /**
     * pdd联盟实例
     * @var pddUnionFactory
     */
    protected $pddUnionFactory;

    public function __construct(array $config, pddUnionFactory $pddUnionFactory)
    {
        $this->appId = $config['appId'];
        $this->appSk = $config['appSk'];
        $this->ddkId = $config['ddkId'];
        $this->pid = isset($config['pid']) ? $config['pid'] : '';
        $this->isCurl = isset($config['isCurl']) && ($config['isCurl'] == true) ? true : false;
        $this->pddUnionFactory = $pddUnionFactory;
    }

    /**
     * 发送请求
     * @param $method
     * @param $params
     * @param string $data_type
     * @return mixed|string
     * @throws \Exception
     */
    public function send($method, $params, $data_type = 'JSON')
    {
        $params = $this->paramsHandle($params);
        $params['client_id'] = $this->appId;
        $params['sign_method'] = 'md5';
        $params['type'] = $method;
        $params['data_type'] = $data_type;
        $params['timestamp'] = strval(time());
        $params['sign'] = $this->signature($params);
        try {
            $response = $this->isCurl == false ? Helpers::curl_post(self::URL, $params): Helpers::fpm_curl_post(self::URL, $params);
            $info = strtolower($data_type) == 'json' ? json_decode($response, true) : $response;
            if (isset($info['error_response'])) {
                $this->pddUnionFactory->setError($info['error_response']['error_msg']);
                return false;
            }
            return \current($info);
        } catch (\Exception $exception) {
            $this->pddUnionFactory->setError($exception->getMessage());
            return false;
        }
    }


    /**
     * 签名算法
     * @param $params
     * @return string
     */
    private function signature($params)
    {
        ksort($params);
        $paramsStr = '';
        array_walk($params, function ($item, $key) use (&$paramsStr) {
            if ('@' != substr($item, 0, 1)) {
                $paramsStr .= sprintf('%s%s', $key, $item);
            }
        });
        return strtoupper(md5(sprintf('%s%s%s', $this->appSk, $paramsStr, $this->appSk)));
    }

    /**
     * 参数预处理
     * @param array $params
     * @return array
     */
    protected function paramsHandle(array $params)
    {
        array_walk($params, function (&$item) {
            if (is_array($item)) {
                $item = json_encode($item);
            }
            if (is_bool($item)) {
                $item = ['false', 'true'][intval($item)];
            }
        });
        return $params;
    }
}