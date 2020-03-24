**多多客SDK**

拼多多联盟SDK，多多客工具箱

PHP =>7.1

`composer require yumufeng/pdd-union-sdk`

如果是在swoole 扩展下使用，支持协程并发，需要在编译swoole扩展的时候开启，系统会自动判断是否采用swoole

```./configure --enable-coroutine --enable-openssl```

### fork说明

基于该包的基础上增加额外入参的参数

### 使用示例

```php
error_reporting(E_ALL);
require 'vendor/autoload.php';

header("content-type: application/json;charset=UTF-8");

$config = [
    'appId' => '', // 拼多多开放平台 client_id
    'appSk' => '', // 拼多多开放平台 client_secret
    'ddkId' => '', // 多多客ID,
    'pid' => '',
    'isCurl' => true // 是否强制使用curl ，设置false为强制使用curl，系统将会自动适配swoole 协程
];
$pdd = new \pddUnionSdk\pddUnionFactory($config);

$info = $pdd->goods->mall('918323727');

if ($info === false) {
    var_dump($pdd->getError());
}
var_dump($info);

```


## 说明文档

| 接口名称 | 对应方法  |
| --------   | ---- |
| pdd.ddk.mall.goods.list.get (查询店铺商品)     | \$client->goods->mall() |
| pdd.ddk.goods.detail (多多进宝商品详情查询)     | \$client->goods->detail() |
| pdd.goods.cats.get (商品标准类目接口)     | \$client->goods->category() |
| pdd.ddk.goods.search (多多进宝商品查询搜索)     | \$client->goods->search() |
| pdd.ddk.goods.direct (查询定向推广商品)     | \$client->goods->direct() |
| pdd.ddk.goods.top (获取热销商品列表)     | \$client->goods->top() |
| pdd.ddk.goods.promotion.url.generate (多多进宝推广链接生成)     | \$client->link->createCpsUrl() |
| pdd.ddk.rp.prom.url.generate (生成红包推广链接)     | \$client->link->createRedbaoUrl() |
| pdd.ddk.theme.prom.url.generate (多多进宝主题推广链接生成)     | \$client->link->createThemeUrl() |
| pdd.ddk.goods.zs.unit.url.gen (将其他推广者的推广链接转换成自己的)     | \$client->link->covertOtherToMyPidUrl() |
| pdd.ddk.goods.pid.query (查询已经生成的推广位信息)     | \$client->promotion->queryPid() |
| pdd.ddk.goods.pid.generate (创建多多进宝推广位)     | \$client->promotion->createPid() |
| pdd.ddk.order.list.increment.get (查询推广订单)     | \$client->promotion->queryOrder() |
| pdd.ddk.order.detail.get (查询订单详情)     | \$client->promotion->queryOrderDetail() |
| pdd.ddk.theme.list.get (多多进宝主题列表查询)     | \$client->theme->lists() |
| pdd.ddk.theme.goods.search (多多进宝主题商品查询)     | \$client->theme->getListsDetail() |

## License

MIT



