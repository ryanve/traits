<?php
/**
 * @link https://github.com/ryanve/traits
 */
namespace traits;
use \Closure;

trait Mixin {

  function __call($name, $params) {
    return static::resolve($name, $params, $this);
  }
  
  static function __callStatic($name, $params) {
    return static::resolve($name, $params);
  }
  
  /**
   * @param  string|int  $name
   * @param  array     $params
   * @param  object    $scope
   * @return mixed
   */
  static function resolve($name, array $params = null, $scope = null) {
    if ($fn = static::mixin((string) $name))
      return static::apply($fn, $scope, $params);
    if ('_e' === substr($name, -2))
      echo static::apply(static::method(substr($name, 0, -2), $scope), null, $params);
    else trigger_error(get_called_class() . " method '$name' is not callable.");
  }
  
  /**
   * @param  array|object|string|int  $name
   * @param  callable|string      $fn  
   * @param  int|bool         $chain
   * @return mixed
   */
  static function mixin($name, $fn = 0, $chain = 0) {
    static $mixins;
    $mixins = $mixins ?: [[], []];
    $name and $name = static::result($name);
    if (is_scalar($name)) {
      $chain = (int) $chain;
      $fn and $mixins[$chain][$name] = $fn;
      return empty($mixins[$chain][$name])
        ? null : $mixins[$chain][$name];
    }
    $chain = (int) $fn;
    if ($name)
      foreach ($name as $k => $v)
        $v and $mixins[$chain][$k] = $v;
    return $copy = $mixins[$chain];
  }
  
  /**
   * @param  mixed  $fn
   * @return mixed
   */
  static function result($fn) {
    return $fn instanceof Closure ? call_user_func_array($fn, array_slice(func_get_args(), 1)) : $fn;
  }
  
  /**
   * @param  callable $fn
   * @param  object   $scope
   * @return mixed
   */
  static function call(callable $fn, $scope = null) {
    return static::apply($fn, $scope, array_slice(func_get_args(), 2));
  }

  /**
   * @param  callable $fn
   * @param  object   $scope
   * @param  array  $params
   * @return mixed
   */
  static function apply(callable $fn, $scope = null, array $params = null) {
    null !== $scope && $fn instanceof Closure and $fn = Closure::bind($fn, $scope, get_class($scope));
    return call_user_func_array($fn, $params ?: []);
  }
  
  /**
   * @param  callable $fn
   * @return callable
   */
  static function curry($fn) {
    $curries = array_slice(func_get_args(), 1);
    return function() use ($fn, $curries) {
      return call_user_func_array($fn, array_merge($curries, func_get_args()));
    };
  }
  
  /**
   * @param  callable $fn
   * @return callable
   */
  static function partial($fn) {
    $curries = array_slice(func_get_args(), 1);
    return function() use ($fn, $curries) {
      $params = func_get_args();
      foreach ($curries as $i => $v)
        $params[$i] = null === $v && array_key_exists($i, $params) ? $params[$i] : $v;
      return call_user_func_array($fn, $params);
    };
  }
  
  /**
   * @param  string     $name
   * @param  string|object  $scope
   * @return callable
   */
  static function method($name, $scope = null) {
    return [null === $scope ? get_called_class() : $scope, $name];
  }
  
  /**
   * @param  string|object  $object
   * @return array
   */
  static function methods($object = null) {
    $result = [];
    null === $object and $object = get_called_class();
    foreach (get_class_methods($object) as $m)
      $result[$m] = [$object, $m];
    return $result;
  }
  
  /**
   * @param  object  $object
   * @return array
   */
  function vars($object = null) {
    return get_object_vars(null === $object ? $this : $object);
  }
}