# Moved to: https://github.com/reactphp-parallel/future-to-promise-converter


# ReactPHP ext-parallel Future to Promise converter

[![Build Status](https://travis-ci.com/WyriHaximus/reactphp-parallel-future-to-promise-converter.svg?branch=master)](https://travis-ci.com/WyriHaximus/reactphp-parallel-future-to-promise-converter)
[![Latest Stable Version](https://poser.pugx.org/WyriHaximus/react-parallel-future-to-promise-converter/v/stable.png)](https://packagist.org/packages/WyriHaximus/react-parallel-future-to-promise-converter)
[![Total Downloads](https://poser.pugx.org/WyriHaximus/react-parallel-future-to-promise-converter/downloads.png)](https://packagist.org/packages/WyriHaximus/react-parallel-future-to-promise-converter)
[![Code Coverage](https://scrutinizer-ci.com/g/WyriHaximus/reactphp-parallel-future-to-promise-converter/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/WyriHaximus/reactphp-parallel-future-to-promise-converter/?branch=master)
[![License](https://poser.pugx.org/WyriHaximus/react-parallel-future-to-promise-converter/license.png)](https://packagist.org/packages/WyriHaximus/react-parallel-future-to-promise-converter)
[![PHP 7 ready](http://php7ready.timesplinter.ch/WyriHaximus/reactphp-http-middleware-clear-body/badge.svg)](https://travis-ci.org/WyriHaximus/reactphp-http-middleware-clear-body)

# Install

To install via [Composer](http://getcomposer.org/), use the command below, it will automatically detect the latest version and bind it with `^`.

```
composer require wyrihaximus/react-parallel-future-to-promise-converter
```

# Usage

```php
use React\EventLoop\Factory;
use React\EventLoop\LoopInterface;
use WyriHaximus\React\Parallel\FutureToPromiseConverter;

$loop = Factory::create();
$converter = new FutureToPromiseConverter($loop);

$runtime = new Runtime('vendor/autoload.php');

/** @var Future $future */
$future = $runtime->run(function () {
    sleep(3);

    return 3;
});

$converter->convert($future)->then(function ($value) {
    // $value will be 3 here
});
```

# License

The MIT License (MIT)

Copyright (c) 2019 Cees-Jan Kiewiet

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

