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
 * @package pddUnionSdk\Api
 */
class Promotion extends pddUnionGateWay
{

    /**
     * @api  查询已经生成的推广位信息
     * @link https://open.pinduoduo.com/#/apidocument/port?id=104
     * @param int $page
     * @param int $pageSize
     * @return mixed|string
     * @throws \Exception
     */
    public function queryPid($page = 1, $pageSize = 50)
    {
        $params = [
            'page' => $page,
            'page_size' => $pageSize
        ];
        return $this->send('pdd.ddk.goods.pid.query', $params);
    }

    /**
     * @api 创建多多进宝推广位
     * @param int $number 要生成的推广位数量
     * @param array $p_id_name_list 推广位名称，例如["1","2"]
     * @return mixed|string
     * @throws \Exception
     */
    public function createPid($number = 10, $p_id_name_list = [])
    {
        $params = [
            'number' => $number,
            'p_id_name_list' => $p_id_name_list
        ];
        return $this->send('pdd.ddk.goods.pid.generate', $params);
    }

    /**
     * 查询推广订单
     * @param $start_update_time
     * @param $end_update_time
     * @param int $page
     * @param int $page_size
     * @return mixed|string
     * @throws \Exception
     */
    public function queryOrder($start_update_time, $end_update_time, $page = 1, $page_size = 50)
    {
        $params = [
            'start_update_time' => $start_update_time,
            'end_update_time' => $end_update_time,
            'page' => $page,
            'page_size' => $page_size
        ];
        return $this->send('pdd.ddk.order.list.increment.get', $params);
    }

    /**
     * 查询订单详情
     * @param $orderId 订单ID号
     * @return mixed|string
     * @throws \Exception
     */
    public function queryOrderDetail($orderId)
    {
        $params = [
            'order_sn' => $orderId
        ];
        return $this->send('pdd.ddk.order.detail.get', $params);
    }
}