### \\[airve](https://github.com/airve)\\[Mixin](https://github.com/airve/mixin/blob/master/mixin.php)
=====

[`traits`](../) is a collection of opensource [PHP traits](http://php.net/manual/en/language.oop5.traits.php).

- [`Mixin`](mixin.php) is for making extensible [classes](http://php.net/manual/en/language.oop5.php).
- [`Reflect`](reflect.php) includes instantiation and context helpers.

### Usage 

#### import into a class

```php
class Example {
    use \traits\Mixin;
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