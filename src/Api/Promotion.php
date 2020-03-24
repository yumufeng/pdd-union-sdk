<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/20
 * Time: 11:06
 */

namespace pddUnionSdk\Api;

use pddUnionSdk\pddUnionGateWay;

/**
 * 推广相关
 * Class Promotion
 *
 * @package pddUnionSdk\Api
 */
class Promotion extends pddUnionGateWay
{

    /**
     * @param int $page
     * @param int $pageSize
     * @param array $ext
     * @return mixed|string
     * @throws \Exception
     * @api  查询已经生成的推广位信息
     * @link https://open.pinduoduo.com/#/apidocument/port?id=104
     */
    public function queryPid($page = 1, $pageSize = 50, $ext = [])
    {
        $params = [
            'page' => $page,
            'page_size' => $pageSize
        ];
        foreach (array_filter($ext) as $k => $v) {
            $params[$k] = $v;
        }
        return $this->send('pdd.ddk.goods.pid.query', $params);
    }

    /**
     * @param int $number 要生成的推广位数量
     * @param array $p_id_name_list 推广位名称，例如["1","2"]
     * @param array $ext
     * @return mixed|string
     * @throws \Exception
     * @api 创建多多进宝推广位
     */
    public function createPid($number = 10, $p_id_name_list = [], $ext = [])
    {
        $params = [
            'number' => $number,
            'p_id_name_list' => $p_id_name_list
        ];
        foreach (array_filter($ext) as $k => $v) {
            $params[$k] = $v;
        }
        return $this->send('pdd.ddk.goods.pid.generate', $params);
    }

    /**
     * 查询推广订单
     *
     * @param $start_update_time
     * @param $end_update_time
     * @param int $page
     * @param int $page_size
     * @param array $ext
     * @return mixed|string
     * @throws \Exception
     */
    public function queryOrder($start_update_time, $end_update_time, $page = 1, $page_size = 50, $ext = [])
    {
        $params = [
            'start_update_time' => $start_update_time,
            'end_update_time' => $end_update_time,
            'page' => $page,
            'page_size' => $page_size
        ];
        foreach (array_filter($ext) as $k => $v) {
            $params[$k] = $v;
        }
        return $this->send('pdd.ddk.order.list.increment.get', $params);
    }

    /**
     * 查询订单详情
     *
     * @param string $orderId 订单ID号
     * @param array $ext
     * @return mixed|string
     * @throws \Exception
     */
    public function queryOrderDetail($orderId, $ext = [])
    {
        $params = [
            'order_sn' => $orderId
        ];
        foreach (array_filter($ext) as $k => $v) {
            $params[$k] = $v;
        }
        return $this->send('pdd.ddk.order.detail.get', $params);
    }
}