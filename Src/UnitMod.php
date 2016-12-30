<?php
/**
 * Desc: 单位和进位模列表
 * Created by PhpStorm.
 * User: xuanskyer | <furthestworld@icloud.com>
 * Date: 2016-12-30 13:51:27
 */

namespace FurthestWorld\UnitFormat\Src;


class UnitMod {

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
}