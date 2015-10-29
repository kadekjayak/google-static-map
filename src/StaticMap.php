<?php

namespace GoogleMapStatic;

use GoogleMapStatic\Elements\Marker\Marker;
use GoogleMapStatic\Elements\Marker\MarkerGroup;
use GoogleMapStatic\UnitMeasures\Coordinate;
use GoogleMapStatic\UnitMeasures\MapSize;

class StaticMap
{
  const T_ROADMAP = 'roadmap';
  const T_SATELLITE = 'satellite';
  const T_TERRAN = 'terrain';
  const T_HYBRID = 'hybrid';

  const MIN_ZOOM = 1;
  const MAX_ZOOM = 21;

  const URL_MAX_LENGTH = 2046;

  private $center;
  private $zoom = 8;
  private $size;
  private $scale;
  private $autoScale = false;
  private $type = self::T_ROADMAP;
  private $markers = [];
  private $language = 'en';
  private $key;

  /**
   * @param array $markers
   * @return array
   */
  private function calculateLatLongAvgWithMarkers(array $markers)
  {
    $longitudeSum = 0;
    $latitudeSum = 0;

    $markerCount = sizeof($markers);

    foreach ($markers as $marker) {

      if ($marker instanceof MarkerGroup) {

        $latlngSum = $this->calculateLatLongAvgWithMarkers($marker->getMarkers());

        $latitudeSum += $latlngSum[0];
        $longitudeSum += $latlngSum[1];

        continue;
      }

      $latitudeSum += $marker->getLatitude();
      $longitudeSum += $marker->getLongitude();

    }

    return [$latitudeSum / $markerCount, $longitudeSum / $markerCount];
  }

  /**
   * @return Coordinate
   */
  public function calculateCenter()
  {
    list($latitudeAvg, $longitudeAvg) = $this->calculateLatLongAvgWithMarkers($this->getMarkers());
    return new Coordinate($latitudeAvg, $longitudeAvg);
  }

  /**
   * @return Coordinate
   */
  public function getCenter()
  {
    if (null === $this->center) {
      if (($markers = $this->getMarkers())) {
        $this->center = $this->calculateCenter();
      }
    }

    return $this->center;
  }

  /**
   * @param mixed $center
   * @return $this
   */
  public function setCenter(Coordinate $center)
  {
    $this->center = $center;
    return $this;
  }

  /**
   * @return int
   */
  public function getZoom()
  {
    return $this->zoom;
  }

  /**
   * @param int $zoom
   * @return $this
   */
  public function setZoom($zoom)
  {
    $this->zoom = $zoom;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getSize()
  {
    if (null === $this->size) {
      $this->size = new MapSize(600, 300);
    }
    return $this->size;
  }

  /**
   * @param MapSize $size
   * @return $this
   */
  public function setSize(MapSize $size)
  {
    $this->size = $size;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getScale()
  {
    return $this->scale;
  }

  /**
   * @param mixed $scale
   * @return $this
   */
  public function setScale($scale)
  {
    $this->scale = $scale;
    return $this;
  }

  /**
   * @return boolean
   */
  public function isAutoScale()
  {
    return $this->autoScale;
  }

  /**
   * @param boolean $autoScale
   * @return $this
   */
  public function setAutoScale($autoScale)
  {
    $this->autoScale = $autoScale;
    return $this;
  }

  /**
   * @return \GoogleMapStatic\Elements\Marker\Marker[]
   */
  public function getMarkers()
  {
    return $this->markers;
  }

  /**
   * @param array $markers
   * @return $this
   */
  public function setMarkers($markers)
  {
    $this->markers = $markers;
    return $this;
  }

  /**
   * @param Marker $marker
   * @return $this
   */
  public function addMarker(Marker $marker)
  {
    $this->markers[] = $marker;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getType()
  {
    return $this->type;
  }

  /**
   * @param mixed $type
   * @return $this
   */
  public function setType($type)
  {
    $this->type = $type;
    return $this;
  }

  /**
   * @return string
   */
  public function getLanguage()
  {
    return $this->language;
  }

  /**
   * @param string $language
   * @return $this
   */
  public function setLanguage($language)
  {
    $this->language = $language;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getKey()
  {
    return $this->key;
  }

  /**
   * @param mixed $key
   * @return $this
   */
  public function setKey($key)
  {
    $this->key = $key;
    return $this;
  }

}
