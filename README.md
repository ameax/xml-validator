# A class to validate a xml file with a local xsd schema

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ameax/xml-validator.svg?style=flat-square)](https://packagist.org/packages/ameax/xml-validator)
[![Tests](https://img.shields.io/github/actions/workflow/status/ameax/xml-validator/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/ameax/xml-validator/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/ameax/xml-validator.svg?style=flat-square)](https://packagist.org/packages/ameax/xml-validator)

## Installation

You can install the package via composer:

```bash
composer require ameax/xml-validator
```

## Usage

```php

$skeleton = new Ameax\XmlValidator();
echo $skeleton->echoPhrase('Hello, Ameax!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Michael Schmidt | ameax](https://github.com/ameax)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
