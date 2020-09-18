<?php

namespace App\DataFixtures;

use App\Entity\Postcode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Postcodes\CSVReader;

class PostcodeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {	
		$postcode = new Postcode();

		$postcode->setPostcode("E1 6AN");
		$postcode->setLatitude(51.518895);
		$postcode->setLongitude(-0.078378);

		$manager->persist($postcode);
		$manager->flush();

		// NULL lat/lng
		$postcode = new Postcode();

		$postcode->setPostcode("E1 7AA");
		$postcode->setLatitude(NULL);
		$postcode->setLongitude(NULL);

		$manager->persist($postcode);
		$manager->flush();
    }
}
