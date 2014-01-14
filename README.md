# [traits](../../) ([0.9](../../releases))
#### opensource [PHP traits](http://php.net/manual/en/language.oop5.traits.php)

- [`Data`](Data.php) includes data/removeData methods.
- [`Emitter`](Emitter.php) is an event emitter based on [EventEmitter](http://nodejs.org/api/events.html).
- [`Mixin`](Mixin.php) is for making extensible [classes](http://php.net/manual/en/language.oop5.php).
- [`Aware`](Aware.php) includes instantiation and context helpers.

## Usage 

### Import into a class

```php
class Example {
  use \traits\Mixin;
}
```

### Static mixins

#### static key/value mixin

```php
Example::mixin('foo', function() {
  return 'bar';
});
```

#### static array mixin

```php
Example::mixin([
  'foo' => function() {
    return 'bar';
  }
]);
```

#### static method call

```php
Example::foo(); # 'bar'
```

### Instance mixins

Specify instance methods by passing `true`

#### static key/value mixin

```php
Example::mixin('foo', function() {
  return 'bar';
}, true);
```

#### instance array mixin

```php
Example::mixin([
  'foo' => function() {
    return 'bar';
  }
], true);
```

#### instance method call

```php 
$example = new Example;
Example->foo(); # 'bar'
```

## License

[MIT](http://opensource.org/licenses/MIT)