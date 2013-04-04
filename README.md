### \\[airve](https://github.com/airve)\\[Mixin](https://github.com/airve/mixin/blob/master/mixin.php)
=====

[`Mixin`](https://github.com/airve/mixin/blob/master/mixin.php) is an opensource PHP [trait](http://php.net/manual/en/language.oop5.traits.php) for making extensible [classes](http://php.net/manual/en/language.oop5.php).

### Usage 

#### import into a class

```php
class Example {
    use \airve\Mixin;
}
```

#### static mixins

Add via key/value:

```php
Example::mixin('foo', function() {
    return 'bar';
});
```

Or via array:

```php
Example::mixin(array(
    'foo' => function() {
        return 'bar';
    }
));
```

Call:

```php
Example::foo(); # 'bar'
```

#### instance mixins

Specify instance methods by passing `true`:

```php
Example::mixin('foo', function() {
    return 'bar';
}, true);
```

Or:

```php
Example::mixin(array(
    'foo' => function() {
        return 'bar';
    }
), true);
```

Call:

```php 
$example = new Example;
Example->foo(); # 'bar'
```

### License: [MIT](http://opensource.org/licenses/MIT)

Copyright (C) 2013 by [Ryan Van Etten](https://github.com/ryanve)