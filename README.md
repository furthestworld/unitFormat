# unitFormat
一个数据单位格式化的PHP组件

# 功能
提供数据的自动进位、格式化，并匹配单位

# 安装

* 在项目的composer.json文件中的require项中添加：
```
"furthestworld/unitformat": "~1.0"
```
并更新composer依赖：`composer update`

* 在需要使用的地方添加：

```
require_once __ROOT__ . '/vendor/autoload.php';
use FurthestWorld\UnitFormat\Src\UnitFormat;
```

# 用法

```
$origin_data    = [
    '2345124332',
    '3433443432',
    '12243433332',
    '7852323436'
];
$formatted_data = UnitFormat::formatDataUnit($origin_data, 10000, ['次', '万次', '亿次'], [1]);
var_dump($formatted_data);
```

输出结果：

```
array(2) {
  ["unit"]=>
  string(6) "亿次"
  ["data"]=>
  array(4) {
    [0]=>
    string(4) "23.5"
    [1]=>
    string(4) "34.3"
    [2]=>
    string(5) "122.4"
    [3]=>
    string(4) "78.5"
  }
}
```

# 参数说明

## `formatDataUnit` 方法

* $origin_data ：原始数据。可以是单个值，或者是一个数值数组列表

* $mod ：单位进位的模

* $units ：单位列表

* $number_format ：使用PHP的number_format函数自定义参数数组，对应number_format的后三个参数列表
