<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/20
 * Time: 10:27
 */

namespace pddUnionSdk\Api;

use pddUnionSdk\pddUnionGateWay;

class Goods extends pddUnionGateWay
{
    /**
     * 运营频道商品查询
     * @param $p_id
     * @param int $channel_type
     * @param int $page
     * @param int $pageSize
     * @return mixed|string
     * @throws \Exception
     */
    public function recommend($channel_type = 1, $page = 1, $pageSize = 100, $p_id = '')
    {
        $params = [
            'pid' => $p_id,
            'offset' => ($page - 1) * $pageSize,
            'limit' => $pageSize,
            'channel_type' => $channel_type
        ];
        if (empty($p_id)) {
            $params['pid'] = $this->pid;
        }
        return $this->send('pdd.ddk.goods.recommend.get', $params);
    }

    /**
     * 商品标准类目接口
     * @link https://open.pinduoduo.com/#/apidocument/port?id=pdd.goods.cats.get
     * @param int $parent_cat_id
     * @return mixed|string
     * @throws \Exception
     */
    public function category($parent_cat_id = 0)
    {
        $params = [
            'parent_cat_id' => $parent_cat_id
        ];
        return $this->send('pdd.goods.cats.get', $params);
    }

    /**
     * @param $mall_id
     * @param int $page_number
     * @param int $page_size
     * @return mixed|string
     * @throws \Exception
     * @api 查询店铺商品
     */
    public function mall($mall_id, $page_number = 1, $page_size = 20)
    {
        $params = [
            'mall_id' => $mall_id,
            'page_number' => $page_number,
            'page_size' => $page_size
        ];

        return $this->send('pdd.ddk.mall.goods.list.get', $params);
    }

    /**
     * @param $skuID
     * @return mixed|string
     * @throws \Exception
     * @api 多多进宝商品详情查询
     */
    public function detail($skuID)
    {
        if (is_string($skuID)) {
            $params['goods_id_list'] = [$skuID];
        } else {
            $params['goods_id_list'] = $skuID;
        }
        $result = $this->send('pdd.ddk.goods.detail', $params);
        if (!$result) {
            return $result;
        }
        return \current(\current($result));
    }

    /**
     * 多多进宝商品查询
     * @param array $params
     * @return mixed|string
     * @throws \Exception
     * @link
     */
    public function search(array $params = [])
    {
        if (!isset($params['page_size'])) {
            $params['page_size'] = 20;
        }
        return $this->send('pdd.ddk.goods.search', $params);
    }

    /**
     *  查询定向推广商品（仅查询关于自己的）
     */
    public function direct($page = 1, $page_size = 20)
    {
        $params = [
            'page' => $page,
            'page_size' => $page_size
        ];
        return $this->send('pdd.ddk.direct.goods.query', $params);
    }

    /**
     * 获取热销商品列表
     * @param $p_id
     * @param int $page
     * @param int $pageSize
     * @param int $sort_type
     * @return mixed|string
     * @throws \Exception
     */
    public function top($p_id = '', $page = 1, $pageSize = 100, $sort_type = 1)
    {
        $params = [
            'p_id' => $p_id,
            'offset' => ($page - 1) * $pageSize,
            'limit' => $pageSize,
            'sort_type' => $sort_type
        ];
        if (empty($p_id)) {
            $params['p_id'] = $this->pid;
        }
        return $this->send('pdd.ddk.top.goods.list.query', $params);
    }
}