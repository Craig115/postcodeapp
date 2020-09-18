<?php

namespace App\Tests\Repository;

use App\Entity\Postcode;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PostcodeRepositoryTest extends KernelTestCase
{
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testNullSearch()
    {
        $postcode = $this->entityManager
        ->getRepository(Postcode::class)
        ->findPostcode("E1 7AA");
        
        $this->assertEmpty($postcode);
    }

    public function testSearch()
    {
        $postcode = $this->entityManager
        ->getRepository(Postcode::class)
        ->findPostcode("E1 6AN");

        $this->assertContains("E1 6AN", $postcode[0]);
    }


    protected function tearDown(): void
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null;
    }
}