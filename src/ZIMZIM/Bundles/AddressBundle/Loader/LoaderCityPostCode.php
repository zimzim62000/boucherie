<?php

namespace ZIMZIM\Bundles\AddressBundle\Loader;


use Doctrine\Common\Persistence\ObjectManager;
use ZIMZIM\Bundles\AddressBundle\Entity\CityPostCode;

class LoaderCityPostCode
{
    private $file;

    public function __construct(){

        if(!file_exists(dirname(__FILE__).'/../Resources/france.csv')){
            throw new \InvalidArgumentException('The resource france.csv is required');
        }

        $this->file = fopen(dirname(__FILE__).'/../Resources/france.csv', 'r');

    }

    public function load(ObjectManager $om){

        $i = 0;
        while(($data = fgetcsv($this->file, 2048, ",")) !== false){

            if($i !== 0){
                $citypostcode = new CityPostCode();
                $citypostcode->setCp($data[0]);
                $citypostcode->setCity($data[6]);
                $citypostcode->setCounty($data[10]);
                $citypostcode->setRegion($data[8]);
                $citypostcode->setLatitude($data[12]);
                $citypostcode->setLongitude($data[11]);
                $om->persist($citypostcode);
            }

            if($i % 10000 == 0){
                $om->flush();
            }

            $i++;
        }
        $om->flush();

        fclose($this->file);

    }
}