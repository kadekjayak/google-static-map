<?php

namespace GoogleMapStatic\Elements\Marker;

use GoogleMapStatic\UnitMeasures\Coordinate;

class MarkerGroup extends Marker
{
  /**
   * @var array
   */
  private $markers = [];

  public function __construct(MarkerStyle $style)
  {
    parent::__construct(new Coordinate(0, 0), $style);
  }

  /**
   * @return Marker[]
   */
  public function getMarkers()
  {
    return $this->markers;
  }

  /**
   * Add marker to cluster
   *
   * @param Marker $marker
   * @return $this
   */
  public function addMarker(Marker $marker)
  {
    $this->markers[] = $marker;
    return $this;
  }

  /**
   * Remove marker from cluster
   *
   * @param Marker $marker
   * @return bool|int
   */
  public function removeMarker(Marker $marker)
  {
    $markers = array();

    foreach ($this->markers as $index => $target) {
      if ($marker === $target) {
        unset($this->markers[$index]);
        return sizeof($markers);
      }
    }

    return false;
  }

}
