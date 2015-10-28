<?php

namespace GoogleMapStatic;

class Mercator
{
  const OFFSET = 268435456;
  const RADIUS = 85445659.44705395;

  public static function longitudeToX($longitude) {
    return round(self::OFFSET + self::RADIUS * $longitude * pi() / 180);
  }

  public static function latitudeToY($latitude) {
    return round(self::OFFSET - self::RADIUS * log((1 + sin($latitude * pi() / 180)) / (1 - sin($latitude * pi() / 180))) / 2);
  }

  public static function xToLongitude($x) {
    return ((round($x) - self::OFFSET) / self::RADIUS) * 180/ pi();
  }

  public static function yToLatitude($y) {
    return (pi() / 2 - 2 * atan(exp((round($y) - self::OFFSET) / self::RADIUS))) * 180 / pi();
  }

  public static function adjustLongitudeByPixels($longitude, $delta, $zoom) {
    return self::xToLongitude(self::longitudeToX($longitude) + ($delta << (21 - $zoom)));
  }

  public static function adjustLatByPixels($latitude, $delta, $zoom) {
    return self::YToLatitude(self::latitudeToY($latitude) + ($delta << (21 - $zoom)));
  }

}
