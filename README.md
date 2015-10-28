# Google Map Static

## Installation

composer require vlobchuk/google-static-map

## Here's an example:

```
$map = new StaticMap();
$map->setZoom(16);
$map->setType(StaticMap::T_SATELLITE);

$urlGenerator = new UrlGenerator();

$map->addMarker(new Marker(new Coordinate(59.9386300, 30.3141300), new MarkerStyle()));

$url = $urlGenerator->generate($map);
```
