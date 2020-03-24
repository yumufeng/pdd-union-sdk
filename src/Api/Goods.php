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
     *
     * @param int $channel_type
     * @param int $page
     * @param int $pageSize
     * @param string $p_id
     * @param array $ext
     * @return mixed|string
     * @throws \Exception
     */
    public function recommend($channel_type = 1, $page = 1, $pageSize = 100, $p_id = '', $ext = [])
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
        foreach (array_filter($ext) as $k => $v) {
            $params[$k] = $v;
        }
        return $this->send('pdd.ddk.goods.recommend.get', $params);
    }

    /**
     * 商品标准类目接口
     *
     * @link https://open.pinduoduo.com/#/apidocument/port?id=pdd.goods.cats.get
     * @param int $parent_cat_id
     * @param array $ext
     * @return mixed|string
     * @throws \Exception
     */
    public function category($parent_cat_id = 0, $ext = [])
    {
        $params = [
            'parent_cat_id' => $parent_cat_id
        ];
        foreach (array_filter($ext) as $k => $v) {
            $params[$k] = $v;
        }
        return $this->send('pdd.goods.cats.get', $params);
    }

    /**
     * pdd.goods.opt.get（查询商品标签列表）
     *
     * @param int $parent_cat_id
     * @param array $ext
     * @return mixed|string
     * @throws \Exception
     */
    public function opt($parent_cat_id = 0, $ext = [])
    {
        $params = [
            'parent_opt_id' => $parent_cat_id
        ];
        foreach (array_filter($ext) as $k => $v) {
            $params[$k] = $v;
        }
        return $this->send('pdd.goods.opt.get', $params);
    }

    /**
     * @param $mall_id
     * @param int $page_number
     * @param int $page_size
     * @param array $ext
     * @return mixed|string
     * @throws \Exception
     * @api 查询店铺商品
     */
    public function mall($mall_id, $page_number = 1, $page_size = 20, $ext = [])
    {
        $params = [
            'mall_id' => $mall_id,
            'page_number' => $page_number,
            'page_size' => $page_size
        ];

        foreach (array_filter($ext) as $k => $v) {
            $params[$k] = $v;
        }
        return $this->send('pdd.ddk.mall.goods.list.get', $params);
    }

    /**
     * @param $skuID
     * @param array $ext
     * @return mixed|string
     * @throws \Exception
     * @api 多多进宝商品详情查询
     */
    public function detail($skuID, $ext = [])
    {
        if (is_string($skuID)) {
            $params['goods_id_list'] = [$skuID];
        } else {
            $params['goods_id_list'] = $skuID;
        }
        foreach (array_filter($ext) as $k => $v) {
            $params[$k] = $v;
        }
        $result = $this->send('pdd.ddk.goods.detail', $params);
        if (!$result) {
            return $result;
        }
        return \current(\current($result));
    }

    /**
     * 多多进宝商品查询
     *
     * @param array $params
     * @param array $ext
     * @return mixed|string
     * @throws \Exception
     * @link
     */
    public function search(array $params = [], $ext = [])
    {
        if (!isset($params['page_size'])) {
            $params['page_size'] = 20;
        }
        foreach (array_filter($ext) as $k => $v) {
            $params[$k] = $v;
        }
        return $this->send('pdd.ddk.goods.search', $params);
    }

    /**
     *  查询定向推广商品（仅查询关于自己的）
     *
     * @param int $page
     * @param int $page_size
     * @param array $ext
     * @return mixed|string
     * @throws \Exception
     */
    public function direct($page = 1, $page_size = 20, $ext = [])
    {
        $params = [
            'page' => $page,
            'page_size' => $page_size
        ];
        foreach (array_filter($ext) as $k => $v) {
            $params[$k] = $v;
        }
        return $this->send('pdd.ddk.direct.goods.query', $params);
    }

    /**
     * 获取热销商品列表
     *
     * @param string $p_id
     * @param int $page
     * @param int $pageSize
     * @param int $sort_type
     * @param array $ext
     * @return mixed|string
     * @throws \Exception
     */
    public function top($p_id = '', $page = 1, $pageSize = 100, $sort_type = 1, $ext = [])
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
        foreach (array_filter($ext) as $k => $v) {
            $params[$k] = $v;
        }
        return $this->send('pdd.ddk.top.goods.list.query', $params);
    }
}