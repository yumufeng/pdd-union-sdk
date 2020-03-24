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
 *
 * @package pddUnionSdk\Api
 */
class Theme extends pddUnionGateWay
{
    /**
     * @param int $page
     * @param int $page_size
     * @param array $ext
     * @return mixed|string
     * @throws \Exception
     * @api 多多进宝主题列表查询
     */
    public function lists($page = 1, $page_size = 20, $ext = [])
    {
        $params = [
            'page' => $page,
            'page_size' => $page_size
        ];
        foreach (array_filter($ext) as $k => $v) {
            $params[$k] = $v;
        }
        return $this->send('pdd.ddk.theme.list.get', $params);
    }

    /**
     * @param $themeId
     * @param array $ext
     * @return mixed|string
     * @throws \Exception
     * @api 多多进宝主题商品查询
     */
    public function getListsDetail($themeId, $ext = [])
    {
        $params = [
            'theme_id' => $themeId
        ];
        foreach (array_filter($ext) as $k => $v) {
            $params[$k] = $v;
        }
        return $this->send('pdd.ddk.theme.goods.search', $params);
    }
}