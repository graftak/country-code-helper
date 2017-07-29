<?php

namespace Graftak;

use CountryCodeException;

class CountryCodeHelper
{
    /**
     * @var CountryCodeHelper
     */
    private static $instance;

    private function __construct()
    {
        // Prevent direct instantiation (Singleton).
    }

    /**
     * Returns mapped country code in given format.
     *
     * Note: Refer to documentation (or CountryCodes.php) for format constants
     * you can use.
     *
     * @param int|string $input
     * @param int $toFormat
     * @return int|string
     * @throws CountryCodeException
     */
    public static function map($input, $toFormat)
    {
        // Use lazy loading.
        if (!self::$instance instanceof CountryCodeHelper) {
            // Create new instance.
            self::$instance = new CountryCodeHelper();
        }

        // Validate input.
        self::$instance->validateFormat($toFormat);

        // Determine format of input.
        $fromFormat = self::$instance->guessFormat($input);

        // Find the right column indexes to map from/to.
        $columnIndexFrom = array_search($fromFormat, CountryCodes::$mapIndex);
        $columnIndexTo = array_search($toFormat, CountryCodes::$mapIndex);

        // Find the key of the country.
        $key = array_search($input, array_column(CountryCodes::$map, $columnIndexFrom));

        // In case the country was not found return null.
        if (false === $key) {
            return null;
        }

        // Return code of the found country.
        return CountryCodes::$map[$key][$columnIndexTo];
    }

    /**
     * Determines and returns country code format of the given value.
     *
     * @param int|string $val
     * @return int
     * @throws CountryCodeException
     */
    private function guessFormat($val)
    {
        // Get lenght of the string.
        $len = strlen($val);

        switch (true) {
            case is_numeric($val):
                return CountryCodes::ISO_NUMERICAL_UN_M49;
            case $len === 2:
                return CountryCodes::ISO_ALPHA_2;
            case $len === 3:
                return CountryCodes::ISO_ALPHA_3;
            case $len > 3:
                return CountryCodes::FULL_TEXT;
            default:
                throw new CountryCodeException('Invalid input.');
        }
    }

    /**
     * Throws exception if given format is invalid.
     *
     * @param int $format
     * @throws CountryCodeException
     */
    private function validateFormat($format)
    {
        if (is_int($format) && !in_array($format, CountryCodes::$formats)) {
            $msg = sprintf('Format (%d) not does not exist.'
                . ' Please use a constant defined in CountryCodes class.', $format);

            throw new CountryCodeException($msg);
        }
    }
}