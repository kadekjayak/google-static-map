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

    $urlInfo = parse_url($urlGenerator->generate($map));
    parse_str($urlInfo['query'], $queryParameters);

    $this->assertEquals('16', $queryParameters['zoom']);
    $this->assertEquals('600x300', $queryParameters['size']);
    $this->assertEquals('roadmap', $queryParameters['maptype']);
  }

  public function testMarkersUrl()
  {
    $map = new StaticMap();
    $map
      ->setZoom(16)
      ->setType(StaticMap::T_SATELLITE)
    ;

    $map->addMarker(new Marker(new Coordinate(59.93863, 30.31413), new MarkerStyle()));

    $urlGenerator = new UrlGenerator();

    $urlInfo = parse_url($urlGenerator->generate($map));
    parse_str($urlInfo['query'], $queryParameters);

    $this->assertEquals('size:mid|label:|59.93863000,30.31413000', $queryParameters['markers']);
    $this->assertEquals('59.93863000,30.31413000', $queryParameters['center']);
    $this->assertEquals('16', $queryParameters['zoom']);
    $this->assertEquals('600x300', $queryParameters['size']);
    $this->assertEquals('satellite', $queryParameters['maptype']);
  }

  public function testMarkersCustomIconUrl()
  {
    $map = new StaticMap();
    $map
      ->setZoom(16)
      ->setType(StaticMap::T_SATELLITE)
    ;

    $markerStyle = new MarkerStyle();
    $markerStyle->setIcon('http://localhost/images/page/map_pin_icon.png');

    $map->addMarker(new Marker(new Coordinate(59.9386300, 30.3141300), $markerStyle));

    $urlGenerator = new UrlGenerator();

    $urlInfo = parse_url($urlGenerator->generate($map));
    parse_str($urlInfo['query'], $queryParameters);

    $this->assertEquals('size:mid|label:|icon:http://localhost/images/page/map_pin_icon.png|59.93863000,30.31413000', $queryParameters['markers']);
    $this->assertEquals('59.93863000,30.31413000', $queryParameters['center']);
    $this->assertEquals('16', $queryParameters['zoom']);
    $this->assertEquals('600x300', $queryParameters['size']);
    $this->assertEquals('satellite', $queryParameters['maptype']);
  }

  public function testScale()
  {
    $map = new StaticMap();
    $map
      ->setCenter(new Coordinate(59.93863, 30.31413))
      ->setScale(2)
    ;

    $urlGenerator = new UrlGenerator();

    $urlInfo = parse_url($urlGenerator->generate($map));
    parse_str($urlInfo['query'], $queryParameters);

    $this->assertEquals('http', $urlInfo['scheme']);
    $this->assertEquals('maps.googleapis.com', $urlInfo['host']);
    $this->assertEquals('59.93863000,30.31413000', $queryParameters['center']);
    $this->assertEquals('8', $queryParameters['zoom']);
    $this->assertEquals('2', $queryParameters['scale']);
    $this->assertEquals('600x300', $queryParameters['size']);
    $this->assertEquals('roadmap', $queryParameters['maptype']);
  }
}
