<?php 

require_once __DIR__ . '/mixin.php';
require_once __DIR__ . '/reflect.php';

class T {
    use \traits\Mixin;
    use \traits\Reflect;
}

print_r((new T)->methods());