<?php

namespace GoogleMapStatic\Generators;

use GoogleMapStatic\Elements\Marker\Marker;
use GoogleMapStatic\Elements\Marker\MarkerGroup;
use GoogleMapStatic\StaticMap;

class UrlGenerator
{
  const GOOGLE_MAP_URL = 'http://maps.googleapis.com/maps/api/staticmap';

  private static $STYLE_PROPERTIES = ['size', 'color', 'label', 'icon'];

  public function generate(StaticMap $map)
  {
    $parameters = [];
    $parameters['markers'] = [];

    foreach ($map->getMarkers() as $marker) {

      if ($marker instanceof MarkerGroup) {

        $groupStyle = $this->buildMarkerStyleQuery($marker);
        $groupLocations = [];

        foreach ($marker->getMarkers() as $groupMarker) {
          $groupLocations[] = $this->buildMarkerLocationQuery($groupMarker);
        }

        $parameters['markers'][] = $groupStyle . '|' . implode('|', $groupLocations);

      } else {

        $markerStyle = $this->buildMarkerStyleQuery($marker);
        $markerLocation = $this->buildMarkerLocationQuery($marker);

        $parameters['markers'][] = $markerStyle . '|' . $markerLocation;
      }

    }

    if (($center = $map->getCenter()) !== null) {
      $parameters['center'] = $center->getLatitude() . ',' . $center->getLongitude();
    }

    if ($map->isAutoScale()) {
      $parameters['autoscale'] = 1;
    } else {
      $parameters['zoom'] = $map->getZoom();
    }

    if (($scale = $map->getScale()) !== null) {
      $parameters['scale'] = $scale;
    }

    $parameters['size'] = $map->getSize()->getWidth() . 'x' . $map->getSize()->getHeight();
    $parameters['maptype'] = $map->getType();
    $parameters['key'] = $map->getKey();

    /* Parse Styles parameters */
    foreach ( $map->getStyles() as $style ) {
      if ( count($style->getStyles()) == 0 ) continue;

      $scope = [
        'feature' => $style->getFeature(),
        'element' => $style->getElement()
      ];

      $queryString = http_build_query(array_merge( $scope, $style->getStyles() ), null, '|');

      $queryString = str_replace('=', ':', $queryString);
      $parameters['style'][] = $queryString;
      
    }


    $query =  http_build_query($parameters, '', '&');


    $query = str_replace('%2F', '/', $query);
    $query = str_replace('%3A', ':', $query);
    $query = str_replace('%7C', '|', $query);
    $query = str_replace('%2C', ',', $query);

    //Multiple Key Index fix for style
    $query = preg_replace('/%5B(?:[0-9]|[1-9][0-9]+)%5D=/', '=', $query); 

    return self::GOOGLE_MAP_URL . '?' . $query;
  }

  private function buildMarkerStyleQuery(Marker $marker)
  {
    $parts = [];

    foreach (self::$STYLE_PROPERTIES as $styleProperty) {

      $getter = 'get' . ucfirst($styleProperty);

      $style = $marker->getStyle();

      if (($value = $style->{$getter}()) !== null && !empty($value) && $value !== '') {
        $parts[] = $styleProperty . ':' . $value;
      }
    }

    return implode('|', $parts);
  }

  private function buildMarkerLocationQuery(Marker $marker)
  {
    return $marker->getLatitude() . ',' . $marker->getLongitude();
  }
}
