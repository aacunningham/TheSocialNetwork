<?php
namespace phpunit\Test;

use phpunit\Baseball;
//require_once "../Layout/phpunitalt/Baseball.php";
require_once "../phpunit/Test/Baseball.php";

class BaseballTest extends \PHPUnit_Framework_TestCase
{
    public function testCalcAvgEquals()
	{
		$atbats = 389;
		$hits = 129;
		$baseball = new Baseball();
		$result = $baseball->calc_avg($atbats,$hits);
		$expectedresult = $hits/$atbats;
		$formatexpectedresult = number_format($hits/$atbats,3);
		$this->assertEquals($formatexpectedresult, $result);
	}
    
}