<?php
/**
 * Desc: 数据单位格式化
 * Created by PhpStorm.
 * User: xuanskyer | <furthestworld@icloud.com>
 * Date: 2016-12-29 10:33:51
 */
namespace FurthestWorld\UnitFormat\Src;


class UnitFormat {


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
    public static function formatDataUnit($origin_data, $mod = UnitMod::MOD_COUNT, $units = UnitMod::UNITS_COUNT, $number_format = []) {
        $formatted_data = [];

        $decimals      = isset($number_format[0]) ? intval($number_format[0]) : 0;
        $dec_point     = isset($number_format[1]) ? $number_format[1] : '.';
        $thousands_sep = isset($number_format[2]) ? $number_format[2] : ',';
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
                    $new_val = number_format($new_val, $decimals, $dec_point, $thousands_sep);
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
                    $new_val = number_format($new_val, $decimals, $dec_point, $thousands_sep);
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

    /**
     * @node_name 直接在源数据中格式化
     * @param        $origin_data
     * @param string $key
     * @param int    $mod
     * @param array  $units
     * @param array  $number_format
     */
    public static function updateDataUnit(&$origin_data, $key, $mod = UnitMod::MOD_COUNT, $units = UnitMod::UNITS_COUNT, $number_format = []) {
        if (empty($origin_data) || empty($key) || !is_string($key)) {
            return;
        }
        $formatted_data      = self::formatDataUnit($origin_data[$key], $mod, $units, $number_format);
        $origin_data[$key]   = $formatted_data['data'];
        $origin_data['unit'] = $formatted_data['unit'];
    }

    /**
     * @node_name 直接在源数据中格式化
     * @param        $origin_data
     * @param array  $keys
     */
    public static function updateMultiDataUnit(&$origin_data, $keys = []) {
        if (empty($origin_data) || empty($keys) || !is_array($keys)) {
            return;
        }
        foreach ($keys as $key => $rule) {
            $mod               = isset($rule['mod']) ? intval($rule['mod']) : UnitMod::MOD_COUNT;
            $units             = isset($rule['units']) ? $rule['units'] : UnitMod::UNITS_COUNT;
            $number_format     = isset($rule['number_format']) ? $rule['number_format'] : [];
            $formatted_data    = self::formatDataUnit($origin_data[$key], $mod, $units, $number_format);
            $origin_data[$key] = $formatted_data;
        }
    }
}