<?php

namespace GoogleMapStatic\UnitMeasures;

use GoogleMapStatic\Mercator;

class Point
{
  /**
   * @var int
   */
  private $x;
  /**
   * @var int
   */
  private $y;

  /**
   * Point constructor.
   * @param int $x
   * @param int $y
   */
  public function __construct($x, $y)
  {
    $this->x = $x;
    $this->y = $y;
  }

  /**
   * @return Coordinate
   */
  public function toCoordinate()
  {
    return new Coordinate(Mercator::yToLatitude($this->y), Mercator::xToLongitude($this->x));
  }

  /**
   * @return int
   */
  public function getX()
  {
    return $this->x;
  }

  /**
   * @return int
   */
  public function getY()
  {
    return $this->y;
  }
}
