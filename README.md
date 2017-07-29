# Country Code Helper - Easily map ISO country codes

Simple package to assist you in converting/mapping ISO Alpha-2, Alpha-3, and Numeric Country Codes.

## Installation

Install the latest version with

```bash
$ composer require graftak/country-code-helper
```

## Usage

```php
<?php

use Graftak\CountryCodeHelper;
use Graftak\CountryCodes;

// Example 1 (The Netherlands): Two-letter to three-letter code (outputs string 'NLD'):
print CountryCodeHelper::map('NL', CountryCodes::ISO_ALPHA_3);

// Example 2 (Philippines): Numeric to two-letter code (outputs string 'PH')
print CountryCodeHelper::map(608, CountryCodes::ISO_ALPHA_2);
```

## About

### Requirements

- PHP 5.6 or up

### Submitting bugs and feature requests

Bugs and feature request are tracked on [GitHub](https://github.com/graftak/country-code-helper/issues)


### Author

Bert van der Genugten

### License

Country Code Helper is licensed under the BSD-3-Clause License - see the `LICENSE` file for details

### Acknowledgements

Source of the used country codes and names:
<http://www.nationsonline.org/oneworld/country_code_list.htm>