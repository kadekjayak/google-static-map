<?php

namespace GoogleMapStatic\UnitMeasures;

use GoogleMapStatic\Mercator;

class Coordinate
{
  /**
   * @var float
   */
  private $longitude;
  /**
   * @var float
   */
  private $latitude;

  /**
   * Coordinate constructor.
   * @param float $latitude
   * @param float $longitude
   */
  public function __construct($latitude, $longitude)
  {
    $this->latitude = $latitude;
    $this->longitude = $longitude;
  }

  public function toPoint()
  {
    return new Point(Mercator::longitudeToX($this->longitude), Mercator::latitudeToY($this->latitude));
  }

  /**
   * @param string $format
   * @return float
   */
  public function getLongitude($format = '%01.8f')
  {
    return sprintf($format, $this->longitude);
  }

  /**
   * @param string $format
   * @return float
   */
  public function getLatitude($format = '%01.8f')
  {
    return sprintf($format, $this->latitude);
  }
}
