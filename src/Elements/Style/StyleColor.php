<?php

namespace GoogleMapStatic\Elements\Style;

class StyleFeature
{
  const S_TINY = 'tiny';
  const S_MID = 'mid';
  const S_SMALL = 'small';

  /**
   * @var HEX
   */
  private $color;
  /**
   * @var string
   */
  private $size;
  /**
   * @var string
   */
  private $icon;
  /**
   * @var string
   */
  private $label;

  /**
   * MarkerStyle constructor.
   * @param $size
   * @param $label
   */
  public function __construct($size = self::S_MID, $label = '')
  {
    $this->size = $size;
    $this->label = $label;
  }

  /**
   * @return HEX
   */
  public function getColor()
  {
    return $this->color;
  }

  /**
   * @param HEX $color
   * @return $this
   */
  public function setColor($color)
  {
    $this->color = $color;
    return $this;
  }

  /**
   * @return string
   */
  public function getSize()
  {
    return $this->size;
  }

  /**
   * @param string $size
   * @return $this
   */
  public function setSize($size)
  {
    $this->size = $size;
    return $this;
  }

  /**
   * @return string
   */
  public function getIcon()
  {
    return $this->icon;
  }

  /**
   * @param string $icon
   * @return $this
   */
  public function setIcon($icon)
  {
    $this->icon = $icon;
    return $this;
  }

  /**
   * @return string
   */
  public function getLabel()
  {
    return $this->label;
  }

  /**
   * @param string $label
   * @return $this
   */
  public function setLabel($label)
  {
    $this->label = $label;
    return $this;
  }

}
