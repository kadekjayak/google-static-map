<?php

namespace GoogleMapStatic\Tests\Unit;

use GoogleMapStatic\Mercator;

class MercatorTest extends AbstractTest
{
  public function testLatitudeToY()
  {
    $this->assertEquals(230704001, Mercator::latitudeToY(24.5165921956));
    $this->assertEquals(0, Mercator::latitudeToY(85.0511287798));
    $this->assertEquals(268435456, Mercator::latitudeToY(0));
    $this->assertEquals(536870912, Mercator::latitudeToY(-85.0511287798));
  }

  public function testLongitudeToX()
  {
    $this->assertEquals(355500011, Mercator::longitudeToX(58.3813335747));
    $this->assertEquals(268435456, Mercator::longitudeToX(0));
    $this->assertEquals(0, Mercator::longitudeToX(-180));
    $this->assertEquals(536870912, Mercator::longitudeToX(180));
  }

}
