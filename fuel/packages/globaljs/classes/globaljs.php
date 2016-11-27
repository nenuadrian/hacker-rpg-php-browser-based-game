<?php
namespace GlobalJs;

class GlobalJs {
  private static $js = array();
  private static $include_js = array();

  public static function add($js) {
    static::$js[] = $js;
  }

  public static function include_js($js) {
    static::$include_js[] = $js;
  }

  public static function render() {
    $output = "";
    foreach(static::$include_js as $js) {
      $output .= \Asset::js($js);
    }
    return $output . '<script type="text/javascript">' . implode('', static::$js) . '</script>';
  }

}
