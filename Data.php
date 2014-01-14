<?php
/**
 * @link https://github.com/ryanve/traits
 */
namespace traits;

trait Data {
  protected $data = [];

  public function data($key = null, $val = null) {
    $key instanceof \Closure and $key = $key($this->data);
    $has = 1 < \func_num_args();
    if (null === $key)
      return $has ? null : $this->data;
    if (\is_scalar($key))
      return $has ? $this->data[$key] = $val : (isset($this->data[$key]) ? $this->data[$key] : null);
    foreach ($key as $k => $v)
      $this->data[$k] = $v;
    return $this->data;
  }

  public function removeData($key = null) {
    if ( ! \func_num_args()) return $this->data = [];
    \is_scalar($key) and $key = \array_flip(\func_get_args());
    return $this->data = \array_diff_key($this->data, $key);
  }
}