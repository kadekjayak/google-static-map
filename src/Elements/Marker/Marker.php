<?php

namespace GoogleMapStatic\Elements\Marker;

use GoogleMapStatic\UnitMeasures\Coordinate;

class Marker
{
  /**
   * @var Coordinate
   */
  private $coordinate;
  /**
   * @var MarkerStyle
   */
  private $style;

  /**
   * Marker constructor.
   * @param $coordinate
   * @param $style
   */
  public function __construct(Coordinate $coordinate, MarkerStyle $style)
  {
    $this->coordinate = $coordinate;
    $this->style = $style;
  }

  /**
   * @return Coordinate
   */
  public function getCoordinate()
  {
    return $this->coordinate;
  }

  /**
   * @return float
   */
  public function getLatitude()
  {
    return $this->coordinate->getLatitude();
  }

  /**
   * @return float
   */
  public function getLongitude()
  {
    return $this->coordinate->getLongitude();
  }

  /**
   * @return MarkerStyle
   */
  public function getStyle()
  {
    return $this->style;
  }

}
