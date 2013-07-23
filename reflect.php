<?php 
/**
 * @package airve/traits
 * @version 0.4.0
 * @link    http://github.com/airve/traits
 * @author  Ryan Van Etten
 * @license MIT
 */

namespace traits;

trait Reflect {

    /** 
     * Create a new instance of the current class.
     * @return object
     */
    public static function reflect($class = null) {
        return new \ReflectionClass(null === $class ? \get_called_class() : $class);
    }

    /** 
     * Create a new instance of the current class.
     * @return object
     */
    public static function instantiate() {
        return static::reflect()->newInstanceArgs(\func_get_args());
    }

    /**
     * Get or set the current context. For this to work, the calling class
     * must call `static::context($this)` in its constructor or elsewhere.
     * @return object
     */
    public static function context($ob = null) {
        static $curr;
        $class = __CLASS__;
        return $curr = null === $ob ? ($curr ?: new $class) : ($ob instanceof $class ? $ob : new $class($ob));
    }
}