<?php

namespace GoogleMapStatic;

use GoogleMapStatic\Elements\Marker\Marker;
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
  private $autoScale = false;
  private $type = self::T_ROADMAP;
  private $markers = [];
  private $language = 'en';
  private $key;

  public function calculateCenter()
  {
    $longitudeSum = 0;
    $latitudeSum = 0;

    foreach ($this->getMarkers() as $marker) {
      $latitudeSum += $marker->getLatitude();
      $longitudeSum += $marker->getLongitude();
    }

    $markersCount = sizeof($this->getMarkers());

    $latitudeAvg = $latitudeSum / $markersCount;
    $longitudeAvg = $longitudeSum / $markersCount;

    return new Coordinate($latitudeAvg, $longitudeAvg);
  }

  /**
   * @return Coordinate
   */
  public function getCenter()
  {
    if(null === $this->center) {
      if(($markers = $this->getMarkers())) {
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
    if(null === $this->size) {
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
   * @return boolean
   */
  public function isAutoScale()
  {
    return $this->autoScale;
  }

  /**
   * @param boolean $autoScale
   */
  public function setAutoScale($autoScale)
  {
    $this->autoScale = $autoScale;
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
  public function addMarker(Marker $marker) {
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
   */
  public function setType($type)
  {
    $this->type = $type;
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
   */
  public function setLanguage($language)
  {
    $this->language = $language;
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
   */
  public function setKey($key)
  {
    $this->key = $key;
  }

}
