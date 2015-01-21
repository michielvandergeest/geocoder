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

use Michiel\Geocoder\Parser\GoogleGeocodeParser;
use GuzzleHttp\Client;

class GoogleGeocodeProvider implements GeocodeProvider {

	/**
	 * Base Api Url to Google's Geocode service
	 * @var string
	 */
	private $apiBaseUrl = 'https://maps.googleapis.com/maps/api/geocode/json';

	/**
	 * Parser object for Google's Geocoder service
	 * @var Michiel\Geocoder\GoogleGeocodeParser
	 */
	private $parser;

	/**
	 * Setup a query to Google's Geocoder service with an address
	 *
	 * @param  string $address
	 * @return Michiel\Geocoder\GoogleGeocodeParser
	 */
	public function queryAddress($address)
	{

		$url = $this->apiBaseUrl.'?address='.$address;

		$results = $this->queryProvider($url);

		return $this->makeParser($results);

	}

	/**
	 * Setup a query to Google's Geocoder service with coordinates
	 *
	 * @param  float $lat
	 * @param  float $lng
	 * @return  Michiel\Geocoder\GoogleGeocodeParser
	 */
	public function queryCoordinates($lat, $lng)
	{

		$url = $this->apiBaseUrl.'?lat='.$lat.'&lng'.$lng;

		$results = $this->queryProvider($url);

		return $this->makeParser($results);

	}

	/**
	 * Executes the actual query to Google's Geocoder service
	 *
	 * @param  string $url
	 * @return json response
	 */
	private function queryProvider($url)
	{

		$client = new Client();
		$response = $client->get($url);

		return $response->json();
	}

	/**
	 * Creates a parser object and populates it with the results from the query
	 *
	 * @param  json $results
	 * @return Michiel\Geocoder\GoogleGeocodeParser
	 */
	private function makeParser($results)
	{

		return new GoogleGeocodeParser($results);

	}

}
