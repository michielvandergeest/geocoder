<?php

/*
 * This file is part of the Michiel\Geocoder package.
 *
 * (c) Michiel van der Geest <michiel@mileswebmedia.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Michiel\Geocoder\Parser;

interface GeocodeParser {

	/**
	 * Instantiates parser object and sets results from Geocoder service
	 *
	 * @param array $geocoderResult
	 */
	public function __construct($geocoderResult);

	/**
	 * Returns the number for the address
	 *
	 * @param  string $type - valid types: long | short - defaults to long
	 * @return string
	 */
	public function number($type);

	/**
	 * Alias for number('short')
	 * Returns the short version of the number for the address
	 *
	 * @return string
	 */
	public function shortNumber();

	/**
	 * Returns the street for the address
	 *
	 * @param  string $type - valid types: long | short - defaults to long
	 * @return string
	 */
	public function street($type);

	/**
	 * Alias for street('short')
	 * Returns the short version of the street for the address
	 *
	 * @return string
	 */
	public function shortStreet();

	/**
	 * Returns the city for the address
	 *
	 * @param  string $type - valid types: long | short - defaults to long
	 * @return string
	 */
	public function city($type);

	/**
	 * Alias for city('short')
	 * Returns the short version of the city for the address
	 *
	 * @return string
	 */
	public function shortCity();

	/**
	 * Returns the state for the address
	 *
	 * @param  string $type - valid types: long | short - defaults to long
	 * @return string
	 */
	public function state($type);

	/**
	 * Alias for state('short')
	 * Returns the short version of the state for the address
	 *
	 * @return string
	 */
	public function shortState();

	/**
	 * Returns the country for the address
	 *
	 * @param  string $type - valid types: long | short - defaults to long
	 * @return string
	 */
	public function country($type);

	/**
	 * Alias for country('short')
	 * Returns the short version of the country for the address
	 *
	 * @return string
	 */
	public function shortCountry();

	/**
	 * Returns the full address
	 *
	 * @return string
	 */
	public function address();

	/**
	 * Returns the latitude coordinate
	 *
	 * @return float
	 */
	public function lat();

	/**
	 * Returns the longitude coordinate
	 *
	 * @return float
	 */
	public function lng();

	/**
	 * Returns the viewport coordinates
	 *
	 * @return array
	 */
	public function viewport();

}
