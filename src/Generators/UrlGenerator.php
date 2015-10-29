<?php

namespace GoogleMapStatic\Generators;

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

      $parts = [];

      foreach (self::$STYLE_PROPERTIES as $styleProperty) {

        $getter = 'get' . ucfirst($styleProperty);

        $style = $marker->getStyle();

        if (($value = $style->{$getter}()) !== null) {
          $parts[] = $styleProperty . ':' . $value;
        }
      }


      $parts[] = $marker->getLatitude() . ',' . $marker->getLongitude();

      $parameters['markers'][] = implode('|', $parts);
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

    $query = preg_replace('/%5B(?:[0-9]|[1-9][0-9]+)%5D=/', '=', http_build_query($parameters, '', '&'));
    $query = str_replace('%2F', '/', $query);
    $query = str_replace('%3A', ':', $query);
    $query = str_replace('|', '%7C', $query);

    return self::GOOGLE_MAP_URL . '?' . $query;
  }
}
