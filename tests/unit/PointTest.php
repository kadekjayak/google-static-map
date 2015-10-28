<?php

namespace GoogleMapStatic\Tests\Unit;


use GoogleMapStatic\UnitMeasures\Point;

class PointTest extends AbstractTest
{
  public function testPoint()
  {
    $coordinate1 = (new Point(0, 0))->toCoordinate();

    $this->assertEquals(85.05112878, $coordinate1->getLatitude());
    $this->assertEquals(-180, $coordinate1->getLongitude());
  }
}
