<?php
/**
 * Desc: 数据单位格式化
 * Created by PhpStorm.
 * User: xuanskyer | <furthestworld@icloud.com>
 * Date: 2016-12-29 10:33:51
 */
namespace FurthestWorld\UnitFormat\Src;


class UnitFormat {

    const UNITS_COMPUTER  = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
    const UNITS_TIMES     = ['次', '万次', '亿次'];
    const UNITS_MONEY_RMB = ['元', '万元', '亿元'];
    const UNITS_COUNT     = ['个', '万个', '亿个'];
    const UNITS_PV        = ['PV', '万PV', '亿PV'];
    const UNITS_UV        = ['UV', '万UV', '亿UV'];
    const UNITS_BPS       = ['Mbps', 'Gbps', 'Tbps'];

    const MOD_COMPUTER  = 1024;
    const MOD_TIMES     = 10000;
    const MOD_MONEY_RMB = 10000;
    const MOD_COUNT     = 10000;
    const MOD_PV        = 10000;
    const MOD_UV        = 10000;
    const MOD_BPS       = 1000;

    /**
     * 格式化数据和单位
     * @param       $origin_data
     *  说明：可以是单个值，或者是一个数值数组列表
     *  转换结果：
     *  12345 => [ 'data' => 1.2, 'unit' => '万']
     *  [12345, 56789] => ['data' => [1.2, 5.6], 'unit' => '万']
     * @param int   $mod
     * @param array $units
     * @param array $number_format
     * @return array
     */
    public static function formatDataUnit($origin_data, $mod = self::MOD_COUNT, $units = self::UNITS_COUNT, $number_format = [2, '.', ',']) {
        $formatted_data = [];
        if (is_array($origin_data)) {
            $sort_data = [];
            $new_data  = [];
            foreach ($origin_data as $k => $v) {
                $v > 0 && $sort_data[] = $v;
            }
            $min = min($sort_data);
            $i   = min(count($units) - 1, intval(floor(log($min, $mod))));
            foreach ((array)$origin_data as $key => $val) {
                $new_val = round($val / pow($mod, $i), 1);
                if (!empty($number_format) && is_array($number_format)) {
                    $decimals      = isset($number_format[0]) ? intval($number_format[0]) : 0;
                    $dec_point     = isset($number_format[1]) ? $number_format[1] : '.';
                    $thousands_sep = isset($number_format[2]) ? $number_format[2] : ',';
                    $new_val       = number_format($new_val, $decimals, $dec_point, $thousands_sep);
                }
                $new_data[$key] = $new_val;
            }
            $formatted_data['unit'] = $units[$i];
            $formatted_data['data'] = $new_data;
        } else {
            if ($origin_data > 0) {
                $i       = min(count($units) - 1, intval(floor(log($origin_data, $mod))));
                $new_val = round($origin_data / pow($mod, $i), 1);
                if (!empty($number_format) && is_array($number_format)) {
                    $decimals      = isset($number_format[0]) ? intval($number_format[0]) : 0;
                    $dec_point     = isset($number_format[1]) ? $number_format[1] : '.';
                    $thousands_sep = isset($number_format[2]) ? $number_format[2] : ',';
                    $new_val       = number_format($new_val, $decimals, $dec_point, $thousands_sep);
                }
                $formatted_data['data'] = $new_val;
                $formatted_data['unit'] = $units[$i];
            } else {
                $formatted_data['data'] = 0;
                $formatted_data['unit'] = $units[0];
            }

        }
        return $formatted_data;
    }
}