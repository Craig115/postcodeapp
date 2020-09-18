<?php

namespace App\Controller;

use App\Entity\Postcode;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PostcodeController extends AbstractController
{
    /**
     * @Route("/search/{name}", name="search")
     */
    public function search(string $name)
    {
        $postcode = $this->getDoctrine()
        ->getRepository(Postcode::class)
        ->findPostcode($name);

        if (!$postcode) {
            return $this->json(['Could not find any records for: ' . $name]);
        } else {
            return $this->json($postcode);    
        }
    }

    /**
     * @Route("/location/{lat}/{lng}", name="location")
     */
    public function location(float $lat, float $lng)
    {        
        $postcode = $this->getDoctrine()
        ->getRepository(Postcode::class)
        ->findLocation($lat, $lng);
        
        if (!$postcode) {
            return $this->json(['Could not find any records for lat: ' . $lat . "lng: " . $lng ]);
        } else {
            return $this->json($postcode);    
        }
    }

}
