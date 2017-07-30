# Country Code Helper - Easily map ISO 3166-1 country codes

Simple package to assist you in converting/mapping ISO 3166-1 Alpha-2, Alpha-3, and Numeric Country Codes.

## Installation

Install the latest version with

```bash
$ composer require graftak/country-code-helper
```

## Usage

Include these two classes:
```php
use Graftak\CountryCodeHelper;
use Graftak\CountryCodes;
```

Then, in your code, just use the static method `map`:

```php
CountryCodeHelper::map($value, $toType);
```

The first parameter `$value` is the country code (string) you want to map **from**. For example:
- `'NL'` (2-letter country code for The Netherlands)
- `'BRA'` (3-letter country code for Brazil)
- `'024'` (numeric country code for Angola)

The second parameter `$toType` is the type you want to map **to**. These types are supported:
```
CountryCodes::ALPHA_2
CountryCodes::ALPHA_3
CountryCodes::NUMERIC
CountryCodes::SHORT_NAME_ENGLISH
CountryCodes::SHORT_NAME_FRENCH
```

Optionally you can supply the third parameter to explicitly define the type of the given `$value` (you can use any of the constants above).

### Examples
```php
<?php

use Graftak\CountryCodeHelper;
use Graftak\CountryCodeHelper\CountryCodes;

// Example 1 (The Netherlands): Two-letter to three-letter code.
print CountryCodeHelper::map('NL', CountryCodes::ALPHA_3);
// Output: 'NLD'

// Example 2 (Philippines): Numeric to two-letter code.
print CountryCodeHelper::map(608, CountryCodes::ALPHA_2);
// Output: 'PH'

// Example 3 (Virgin Islands): Two-letter to English name.
print CountryCodeHelper::map('VG', CountryCodes::SHORT_NAME_ENGLISH);
// Output: 'Virgin Islands (British)'
```

## About

### Requirements

- PHP 5.6 or up

### Country Codes - ISO 3166

What is ISO 3166?
ISO 3166 is the International Standard for country codes and codes for their subdivisions.

The purpose of ISO 3166 is to define internationally recognised codes of letters and/or numbers that we can use when we refer to countries and subdivisions. However, it does not define the names of countries – this information comes from United Nations sources (Terminology Bulletin Country Names and the Country and Region Codes for Statistical Use maintained by the United Nations Statistics Divisions).

Using codes saves time and avoids errors as instead of using a country's name (which will change depending on the language being used) we can use a combination of letters and/or numbers that are understood all over the world.

For example, all national postal organizations throughout the world exchange international mail in containers identified with the relevant country code. Internet domain name systems use the codes to define top level domain names such as '.fr' for France, '.au' for Australia. In addition, in machine readable passports, the codes are used to determine the nationality of the user and when we send money from one bank to another the country codes are a way to identify where the bank is based.

Excerpt from: https://www.iso.org/iso-3166-country-codes.html

### Submitting bugs and feature requests

Bugs and feature request are tracked on [GitHub](https://github.com/graftak/country-code-helper/issues)

### Author

Bert van der Genugten

### License

Country Code Helper is licensed under the BSD-3-Clause License - see the `LICENSE` file for details

### Acknowledgements
Data source: https://www.iso.org/obp/ui/#search/code/

More information about ISO 3166 can be found on the official website of ISO (International Organization for Standardization):
https://www.iso.org/iso-3166-country-codes.html