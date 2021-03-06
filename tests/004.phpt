--TEST--
Check for integer serialisation
--SKIPIF--
--FILE--
<?php
if(!extension_loaded('swoole_serialize')) {
    dl('swoole_serialize.' . PHP_SHLIB_SUFFIX);
}

function test($type, $variable) {
    $serialized = swoole_serialize($variable);
    $unserialized = swoole_unserialize($serialized);

    echo $type, PHP_EOL;
    var_dump($unserialized);
    echo $unserialized === $variable ? 'OK' : 'ERROR', PHP_EOL;
}

test('zero: 0', 0);
test('small: 1',  1);
test('small: -1',  -1);
test('medium: 1000', 1000);
test('medium: -1000', -1000);
test('large: 100000', 100000);
test('large: -100000', -100000);
?>
--EXPECT--
zero: 0
int(0)
OK
small: 1
int(1)
OK
small: -1
int(-1)
OK
medium: 1000
int(1000)
OK
medium: -1000
int(-1000)
OK
large: 100000
int(100000)
OK
large: -100000
int(-100000)
OK
