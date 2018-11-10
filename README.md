# Greek Social Insurance Number (ΑΜΚΑ - AMKA)

[![Build Status](https://travis-ci.org/phpgr/greek_social_insurance_number_amka.svg?branch=master)](https://travis-ci.org/phpgr/greek_social_insurance_number_amka)
[![Software License][ico-license]](LICENSE.md)

This package contains a value object class about Greek Social Insurance Number. You can also use the same class
to validate a social insurance number with a static method. 

## Install

Via Composer

``` bash
$ composer require phpgr/greek_social_insurance_number
```

## Usage

``` php
$number = new \GreekSocialInsuranceNumber\GreekSocialInsuranceNumber('number');
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [George Mponos](gmponos@gmail.com)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
