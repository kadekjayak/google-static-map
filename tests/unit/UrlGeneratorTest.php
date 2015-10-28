<?php

namespace GoogleMapStatic\Tests\Unit;

use GoogleMapStatic\Elements\Marker\Marker;
use GoogleMapStatic\Elements\Marker\MarkerStyle;
use GoogleMapStatic\Generators\UrlGenerator;
use GoogleMapStatic\StaticMap;
use GoogleMapStatic\UnitMeasures\Coordinate;

class UrlGeneratorTest extends AbstractTest
{
  public function testBasicUrl()
  {
    $map = new StaticMap();
    $map->setZoom(16);

    $urlGenerator = new UrlGenerator();

    $this->assertEquals(
      UrlGenerator::GOOGLE_MAP_URL . '?zoom=16&size=600x300&maptype=roadmap',
      $urlGenerator->generate($map)
    );

  }
  
  public function testMarkersUrl()
  {
    $map = new StaticMap();
    $map->setZoom(16);
    $map->setType(StaticMap::T_SATELLITE);

    $map->addMarker(new Marker(new Coordinate(59.9386300, 30.3141300), new MarkerStyle()));
    $map->addMarker(new Marker(new Coordinate(59.9386800, 30.3141300), new MarkerStyle()));
    $map->addMarker(new Marker(new Coordinate(60.9386800, 30.3141300), new MarkerStyle()));

    $urlGenerator = new UrlGenerator();

    $this->assertEquals(
      UrlGenerator::GOOGLE_MAP_URL . '?markers=size:mid%7Clabel:%7C59.93863000%2C30.31413000&markers=size:mid%7Clabel:%7C59.93868000%2C30.31413000&markers=size:mid%7Clabel:%7C60.93868000%2C30.31413000&center=60.27199667%2C30.31413000&zoom=16&size=600x300&maptype=satellite',
      $urlGenerator->generate($map)
    );

  }

  public function testMarkersCustomIconUrl()
  {
    $map = new StaticMap();
    $map->setZoom(16);
    $map->setType(StaticMap::T_SATELLITE);

    $markerStyle = new MarkerStyle();
    $markerStyle->setIcon('http://localhost/images/page/map_pin_icon.png');

    $map->addMarker(new Marker(new Coordinate(59.9386300, 30.3141300), $markerStyle));

    $urlGenerator = new UrlGenerator();

    $this->assertEquals(
      UrlGenerator::GOOGLE_MAP_URL . '?markers=size:mid%7Clabel:%7Cicon:http://localhost/images/page/map_pin_icon.png%7C59.93863000%2C30.31413000&center=59.93863000%2C30.31413000&zoom=16&size=600x300&maptype=satellite',
      $urlGenerator->generate($map)
    );

  }
}
