<?php

namespace App\Command;

use PHPCoord\OSRef;
use App\Entity\Postcode;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

use Postcodes\CSVReader;

class ImportPostcodeCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:import-postcode';
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();

        $this->em = $em;
    }

    protected function configure()
    {
        $this
        ->setDescription('Imports Postcodes into a Database')
        ->setHelp('This command will a CSV list of postcodes, into a database')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
		$io = new SymfonyStyle($input, $output);

        $records = CSVReader::loadData("/tmp/Data/CSV/");
        foreach ($records as $record) {

			// Convert Eastings and northings to lat/lng.
			$osref = new OSRef(intval($record[2]), intval($record[3]));
			$latlng = $osref->toLatLng();

			$postcode = (new Postcode())
                ->setPostcode($record['0'])
				->setLatitude($latlng->getLat())
				->setLongitude($latlng->getLng())
			;

			$this->em->persist($postcode);
			
			$this->em->flush();
        }
		
		$io->success('Successfully importer CSV data!');

        return 1;
    }
}