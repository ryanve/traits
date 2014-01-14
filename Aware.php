<?php
/**
 * @link https://github.com/ryanve/traits
 */
namespace traits;
use \ReflectionClass;

trait Aware {
  /** 
   * @return ReflectionClass
   */
  static function reflect($class = null) {
    return new ReflectionClass(null === $class ? get_called_class() : $class);
  }

  /** 
   * @description Create a new instance of the current class.
   * @return object
   */
  static function instantiate() {
    return static::reflect()->newInstanceArgs(func_get_args());
  }

  /**
   * @description Get or set the current context. For this to work, the calling
   * class must call `static::context($this)` in its constructor or elsewhere.
   * @return object
   */
  static function context($ob = null) {
    static $curr;
    $class = __CLASS__;
    return $curr = null === $ob ? ($curr ?: new $class) : ($ob instanceof $class ? $ob : new $class($ob));
  }
}