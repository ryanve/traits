<?php
/**
 * @link https://github.com/ryanve/traits
 */
namespace traits;

trait Emitter {
  protected $listeners = [];

  function listeners($name) {
    return empty($this->listeners[$name]) ? [] : $this->listeners[$name];
  }

  function on($name, $fn) {
    empty($this->listeners[$name]) ? $this->listeners[$name] = [$fn] : $this->listeners[$name][] = $fn;
    return $this;
  }

  function off($name = null, $fn = null) {
    if (!func_num_args()) $this->listeners = [];
    elseif (!empty($this->listeners[$name]))
      $this->listeners[$name] = null === $fn ? null : array_diff($this->listeners[$name], [$fn]);
    return $this;
  }

  function emit($name) {
    $i = 0;
    foreach ($this->listeners($name) as $fn) ++$i and call_user_func($fn);
    return $i;
  }
  
  function trigger($name) {
    $this->emit($name);
    return $this;
  }
}