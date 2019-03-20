<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/20
 * Time: 12:28
 */

namespace pddUnionSdk\Api;


use pddUnionSdk\pddUnionGateWay;

/**
 * 主题
 * Class Theme
 * @package pddUnionSdk\Api
 */
class Theme extends pddUnionGateWay
{
    /**
     * @api 多多进宝主题列表查询
     * @param int $page
     * @param int $page_size
     * @return mixed|string
     * @throws \Exception
     */
    public function lists($page = 1, $page_size = 20)
    {
        $params = [
            'page' => $page,
            'page_size' => $page_size
        ];
        return $this->send('pdd.ddk.theme.list.get', $params);
    }

    /**
     * @api 多多进宝主题商品查询
     * @param $themeId
     * @return mixed|string
     * @throws \Exception
     */
    public function getListsDetail($themeId)
    {
        $params = [
            'theme_id' => $themeId
        ];
        return $this->send('pdd.ddk.theme.goods.search', $params);
    }
}