<?php

/*
 * This file is part of the Michiel\Geocoder package.
 *
 * (c) Michiel van der Geest <michiel@mileswebmedia.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Michiel\Geocoder\Provider;

interface GeocodeProvider {

	/**
	 * Setup a query to the Geocoder service with an address
	 *
	 * @param  string $address
	 * @return Michiel\Geocoder\GeocodeParser
	 */
	public function queryAddress($address);

	/**
	 * Setup a query to the Geocoder service with coordinates
	 *
	 * @param  float $lat
	 * @param  float $lng
	 * @return  Michiel\Geocoder\GeocodeParser
	 */
	public function queryCoordinates($lat, $lng);

}
