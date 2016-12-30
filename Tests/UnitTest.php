<?php

/**
 * 测试用例
 * 这是一个很不规范的测试用例，请不要在意这些细节~~
 */

include_once(dirname(__DIR__) . '/Src/UnitFormat.php');
use FurthestWorld\UnitFormat\Src\UnitFormat;

class UnitTest extends \PHPUnit_Framework_TestCase {

    public function tester() {
        $origin_data    = [
            '2345124332',
            '3433443432',
            '12243433332',
            '7852323436'
        ];
        $formatted_data = UnitFormat::formatDataUnit($origin_data, 10000, ['次', '万次', '亿次'], [1]);
        var_dump($formatted_data);


        $origin_data    = [
            '234514332',
            '343343432',
            '1224333332',
            '785223436'
        ];
        $formatted_data = UnitFormat::formatDataUnit($origin_data, 1024, ['Kb', 'Mb', 'Gb'], [1]);
        var_dump($formatted_data);

        $origin_data = [
            'data'  => [
                '35435253234',
                '43563463',
                '646778833'
            ],
            'data2' => [
                '35435253234',
                '43563463',
                '646778833'
            ],
            'other' => [
                //xxx
            ]
        ];



        UnitFormat::updateDataUnit($origin_data, 'data');
        var_dump($origin_data);

        UnitFormat::updateMultiDataUnit(
            $origin_data,
            [
                'data'  => ['mod' => 10000, 'units' => ['次', '万次', '亿次'], 'number_format' => [2, '.', ',']],
                'data2' => ['units' => ['个', '万个', '亿个']]
            ]
        );
        var_dump($origin_data);
    }

}

