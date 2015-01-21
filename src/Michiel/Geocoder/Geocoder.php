<?php

/*
 * This file is part of the Michiel\Geocoder package.
 *
 * (c) Michiel van der Geest <michiel@mileswebmedia.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Michiel\Geocoder;

use Michiel\Geocoder\Provider\GoogleGeocodeProvider;

class Geocoder {

	/**
	 * Latitude coordinate
	 *
	 * @var float
	 */
	private $lat;

	/**
	 * Longitude coordinate
	 *
	 * @var float
	 */
	private $lng;

	/**
	 * Freeform address
	 *
	 * @var string
	 */
	private $address;

	/**
	 * Set the Geocode provider
	 */
	public function __construct()
	{
		$this->provider = new GoogleGeocodeProvider();
	}

	/**
	 * Set the address string
	 *
	 * @param string $address
	 */
	public function setAddress($address)
	{
		$this->address = urlencode($address);
		return $this;
	}

	/**
	 * Set latitude and longitude coordinates
	 *
	 * @param float $lat Latitude coordinate
	 * @param float $lng Longitude coordinate
	 */
	public function setCoordinates($lat, $lng)
	{
		$this->lat = $lat;
		$this->lng = $lng;
		return $this;
	}

	/**
	 * Lookup the Geocode object based on either the address or the coordinates
	 *
	 * @return Michiel\Geocoder\Parser\GeocodeParser
	 */
	public function lookup()
	{

		if(isset($this->address))
		{
			return $this->provider->queryAddress($this->address);
		}
		else if(isset($this->lat) && isset($this->lng))
		{
			return $this->provider->queryCoordinates($this->lat, $this->lng);
		}

	}

}
