<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

use Postcodes\Downloader;

class DownloadPostcodeCommand extends Command
{
    protected static $defaultName = 'app:download-postcode';

    protected function configure()
    {
        $this
        ->setDescription('Downloads UK Postcodes')
        ->setHelp('This command will download UK Postcodes')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        
        try {
            $url = "https://api.os.uk/downloads/v1/products/CodePointOpen/downloads?area=GB&format=CSV&redirect&codepo_gb.zip";
            $file = "/tmp/postcodes.zip";

            Downloader::downloadFile($url, $file);
            Downloader::unzipFile($file);
            
            $io->success('Successfully downloaded and unzipped file!');

            return 1;
        } catch (Exception $e) {
            $io->error('Error: ' . $e->getMessage());

           return 0;
        }
    }
}