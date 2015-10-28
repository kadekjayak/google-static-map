<?php

namespace GoogleMapStatic\UnitMeasures;

class MapSize
{
  /**
   * @var int
   */
  private $width;
  /**
   * @var int
   */
  private $height;

  /**
   * MapSize constructor.
   * @param int $width
   * @param int $height
   */
  public function __construct($width, $height)
  {
    $this->width = $width;
    $this->height = $height;
  }

  /**
   * @return int
   */
  public function getWidth()
  {
    return $this->width;
  }

  /**
   * @return int
   */
  public function getHeight()
  {
    return $this->height;
  }

}
