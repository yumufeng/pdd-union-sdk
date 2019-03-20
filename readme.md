**京东联盟SDK**

京东联盟SDK，基于新版的

PHP =>7.0

`composer require yumufeng/pdd-union-sdk`

如果是在swoole 扩展下使用，支持协程并发，需要在编译swoole扩展的时候开启，系统会自动判断是否采用swoole

```./configure --enable-coroutine --enable-openssl```

### 使用示例

```php
error_reporting(E_ALL);
require 'vendor/autoload.php';

header("content-type: application/json;charset=UTF-8");

$config = [
    'appId' => '', // 拼多多开放平台 client_id
    'appSk' => '', // 拼多多开放平台 client_secret
    'ddkId' => '' // 多多客ID
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
| pdd.ddk.goods.search (多多进宝商品查询搜索)     | \$client->goods->search() |
| pdd.ddk.goods.search (多多进宝商品查询搜索)     | \$client->goods->search() |
## License

MIT



