<?php

/*
 * This file is part of Country Code Helper.
 *
 * (c) Bert van der Genugten <bertvandergenugten@gmail.com>
 *
 * This source file is subject to the BSD-3-Clause License that is bundled
 * with this source code in the file LICENSE.
 */

namespace Graftak;

use Graftak\CountryCodeHelper\CountryCodes;

/**
 * Class CountryCodeHelper
 *
 * See README.md file for usage instructions/examples.
 */
class CountryCodeHelper
{
    /**
     * @var CountryCodeHelper
     */
    private static $instance;

    /**
     * CountryCodeHelper constructor.
     *
     * Note: Call static method to use this class.
     */
    private function __construct()
    {
        // Prevent direct instantiation (Singleton).
    }

    /**
     * Returns mapped country code in given type.
     *
     * Note: Refer to documentation (or CountryCodes.php) for type constants
     * you can use.
     *
     * @param int|string $input
     * @param int $toType
     * @param int $fromType (optional) Will guess the type when not set.
     * @return string
     * @throws CountryCodeHelper\Exception
     */
    public static function map($input, $toType, $fromType = null)
    {
        // Use lazy loading.
        if (!self::$instance instanceof CountryCodeHelper) {
            // Create new instance.
            self::$instance = new CountryCodeHelper();
        }

        // Validate input.
        self::$instance->validateType($toType);

        if ($fromType) {
            self::$instance->validateType($fromType);
        } else {
            // Try to determine type of input.
            $fromType = self::$instance->guessType($input);
        }

        // Find the right column numbers to map from/to.
        $columnNumberFrom = array_search($fromType, CountryCodes::$columnIndex);
        $columnNumberTo = array_search($toType, CountryCodes::$columnIndex);

        // Find the row number of the country.
        $rowNumber = array_search($input, array_column(CountryCodes::$codes,
            $columnNumberFrom));

        // In case the country was not found return null.
        if (false === $rowNumber) {
            return null;
        }

        // Return found value.
        return CountryCodes::$codes[$rowNumber][$columnNumberTo];
    }

    /**
     * Determines and returns country code type of the given value.
     *
     * @param int|string $val
     * @return int
     * @throws CountryCodeHelper\Exception
     */
    private function guessType($val)
    {
        // Get lenght of the string.
        $len = strlen($val);

        switch (true) {
            case is_numeric($val):
                return CountryCodes::NUMERIC;
            case $len === 2:
                return CountryCodes::ALPHA_2;
            case $len === 3:
                return CountryCodes::ALPHA_3;
            default:
                throw new CountryCodeHelper\Exception(
                    'Could not determine code type, please supply `from type` argument.'
                );
        }
    }

    /**
     * Throws exception if given type is invalid.
     *
     * @param int $type
     * @throws CountryCodeHelper\Exception
     */
    private function validateType($type)
    {
        if (is_int($type) && !in_array($type, CountryCodes::$types)) {
            $msg = sprintf('Type (%d) not does not exist.'
                . ' Please use a constant defined in CountryCodes class.', $type);

            throw new CountryCodeHelper\Exception($msg);
        }
    }
}