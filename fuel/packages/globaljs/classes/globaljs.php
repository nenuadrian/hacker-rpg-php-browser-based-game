<?php
namespace GlobalJs;

class GlobalJs {
  private static $js = array();

  public static function add($js) {
    static::$js[] = $js;
  }

  public static function render() {
    return implode('', static::$js);
  }
}
