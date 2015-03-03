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

class GoogleGeocodeParser implements GeocodeParser {

	/**
	 * Result from Google's Geocoder service
	 *
	 * @var array
	 */
	private $geocoderResults;

	/**
	 * Google's Geocoder service can return multiple results for one query. By default
	 * the first result is set as the active result. Other results can be set as active
	 * by using first(), second(), third() etc.
	 *
	 * @var array
	 */
	private $result;

	/**
	 * Instantiates parser object and sets results from Google's Geocoder service
	 *
	 * @param array $geocoderResult
	 */
	public function __construct($geocoderResults)
	{

		$this->geocoderResults = $geocoderResults;

		$this->first();

	}

	/**
	 * Returns the number for the address
	 *
	 * @param  string $type - valid types: long | short - defaults to long
	 * @return string
	 */
	public function number($type = 'long')
	{

		$element = $this->getElementWhereType('street_number', $this->result['address_components']);

		return $this->getName($element, $type);

	}

	/**
	 * Alias for number('short')
	 * Returns the short version of the number for the address
	 *
	 * @return string
	 */
	public function shortNumber()
	{

		return $this->number('short');

	}

	/**
	 * Returns the street for the address
	 *
	 * @param  string $type - valid types: long | short - defaults to long
	 * @return string
	 */
	public function street($type = 'long')
	{

		$element = $this->getElementWhereType('route', $this->result['address_components']);

		return $this->getName($element, $type);

	}

	/**
	 * Alias for street('short')
	 * Returns the short version of the street for the address
	 *
	 * @return string
	 */
	public function shortStreet()
	{
		return $this->street('short');
	}

	/**
	 * Returns the city for the address
	 *
	 * @param  string $type - valid types: long | short - defaults to long
	 * @return string
	 */
	public function city($type = 'long')
	{

		$element = $this->getElementWhereType('locality', $this->result['address_components']);

		return $this->getName($element, $type);

	}

	/**
	 * Alias for city('short')
	 * Returns the short version of the city for the address
	 *
	 * @return string
	 */
	public function shortCity()
	{
		return $this->city('short');
	}

	/**
	 * Returns the state for the address
	 *
	 * @param  string $type - valid types: long | short - defaults to long
	 * @return string
	 */
	public function state($type = 'long')
	{

		$element = $this->getElementWhereType('administrative_area_level_1', $this->result['address_components']);

		return $this->getName($element, $type);

	}

	/**
	 * Alias for state('short')
	 * Returns the short version of the state for the address
	 *
	 * @return string
	 */
	public function shortState()
	{
		return $this->state('short');
	}

	/**
	 * Returns the country for the address
	 *
	 * @param  string $type - valid types: long | short - defaults to long
	 * @return string
	 */
	public function country($type = 'long')
	{

		$element = $this->getElementWhereType('locality', $this->result['address_components']);

		return $this->getName($element, $type);

	}

	/**
	 * Alias for country('short')
	 * Returns the short version of the country for the address
	 *
	 * @return string
	 */
	public function shortCountry()
	{
		return $this->country('short');
	}

	/**
	 * Returns the full address
	 *
	 * @return string
	 */
	public function address()
	{

		return $this->result['formatted_address'];

	}

	/**
	 * Returns the latitude coordinate
	 *
	 * @return float
	 */
	public function lat()
	{
		return $this->result['geometry']['location']['lat'];
	}

	/**
	 * Returns the longitude coordinate
	 *
	 * @return float
	 */
	public function lng()
	{
		return $this->result['geometry']['location']['lng'];
	}

	/**
	 * Returns the viewport coordinates
	 *
	 * @return array
	 */
	public function viewport()
	{
		return [
			'ne_lat' => $this->result['geometry']['viewport']['northeast']['lat'],
			'ne_lng' => $this->result['geometry']['viewport']['northeast']['lng'],
			'sw_lat' => $this->result['geometry']['viewport']['southwest']['lat'],
			'sw_lng' => $this->result['geometry']['viewport']['southwest']['lng'],
		];
	}

	/**
	 * Magic call method to enable selecting the active result, using friendly names such as
	 * first(), second(), third() etc.
	 *
	 * @param  string $name
	 * @param  array $arguments
	 * @return self
	 */
	public function __call($name, $arguments)
	{

		$numberNames = ['first', 'second', 'third', 'fourth', 'fifth', 'sixt', 'seventh', 'eight', 'ninth', 'tenth'];

		$index = array_search($name, $numberNames);

		if($index !== false)
		{
			$this->result = isset($this->geocoderResults['results'][$index]) ? $this->geocoderResults['results'][$index] : false;
		}

		return $this;
	}

	/**
	 * Returns the info element for a given type
	 *
	 * @param  string $type
	 * @param  array $array
	 * @return array
	 */
	private function getElementWhereType($type, $array)
	{

		foreach($array as $element)
		{

			if(in_array($type, $element['types']))
			{
				return $element;
				break;
			}

		}

		return false;

	}

	/**
	 * Returns either the short name or long name for an element
	 * @param  array $element
	 * @param  string $type  ('long' or 'short')
	 * @return string
	 */
	private function getName($element, $type)
	{

		if($type == 'short')
		{
			return $element['short_name'];
		}
		else if($type == 'long')
		{
			return $element['long_name'];
		}
		else
		{
			// throw exception
		}

	}

}
