<?php

namespace App\Tests\Processing;

use App\Processing\GlobalFunction;
use PHPUnit\Framework\TestCase;

class GlobalFunctionTest extends TestCase
{

    public function testConvertDateExcel()
    {
        $conversion = new GlobalFunction();

        // Test conversion avec choix = true
        $dateExcel = 44519; // 01/01/2021 en format Excel
        $expectedResult = "11/2021";
        $actualResult = $conversion->convertDateExcel($dateExcel, true);
        $this->assertEquals($expectedResult, $actualResult);

        // Test conversion avec choix = false
        $dateExcel = 44519; // 01/01/2021 en format Excel
        $expectedResult = "19/11/2021";
        $actualResult = $conversion->convertDateExcel($dateExcel, false);
        $this->assertEquals($expectedResult, $actualResult);
    }

    public function testGetFormatedDate()
    {
        $example = new GlobalFunction();
        $dateString = $example->getFormatedDate(1);
        $this->assertIsString($dateString);
        $this->assertEquals(date("m/Y", strtotime("-1 month")), $dateString);
    }
}
