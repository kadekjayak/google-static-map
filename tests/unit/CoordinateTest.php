<?php

namespace GoogleMapStatic\Tests\Unit;

use GoogleMapStatic\UnitMeasures\Coordinate;

class CoordinateTest extends AbstractTest
{
  public function testCoordinate()
  {
    $point1 = (new Coordinate(-85.0511287798, 180))->toPoint();
    $this->assertEquals(536870912, $point1->getX());
    $this->assertEquals(536870912, $point1->getY());

    $point2 = (new Coordinate(24.5165921956, 58.3813335747))->toPoint();
    $this->assertEquals(355500011, $point2->getX());
    $this->assertEquals(230704001, $point2->getY());
  }
}
