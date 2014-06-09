<?php

namespace ZIMZIM\Bundles\AddressBundle\Loader;


use Doctrine\Common\Persistence\ObjectManager;

class LoaderCityPostCode
{
    private $file;
    private $cityPostCode;

    public function __construct($filename, $cityPostCode)
    {

        if (!file_exists(dirname(__FILE__) . '/../' . $filename)) {
            throw new \InvalidArgumentException('The resource file.csv is required');
        }

        $this->file = fopen(dirname(__FILE__) . '/../' . $filename, 'r');

        $this->cityPostCode = $cityPostCode;
    }

    public function load(ObjectManager $om)
    {
        $tabmain = array();
        $i = 0;
        while (($data = fgetcsv($this->file, 2048, ",")) !== false) {

            if ($i !== 0) {
                $citypostcode = clone $this->cityPostCode;
                if (isset($data)) {
                    if (!empty($data[0]) && !empty($data[6]) && !empty($data[10]) && !empty($data[8])
                        && !empty($data[12]) && !empty($data[11])
                    ) {
                        $citypostcode->setCp($data[0]);
                        $citypostcode->setCity($data[6]);
                        $citypostcode->setCounty($data[10]);
                        $citypostcode->setRegion($data[8]);
                        $citypostcode->setLatitude($data[12]);
                        $citypostcode->setLongitude($data[11]);
                        $citypostcode->setUnik(urlencode(strtolower($data[6].' '.$data[0].' '.$data[1])));

                        $main = false;
                        if(!in_array($data[0], $tabmain)){
                            if(preg_match("/^[0-9]{2}000$/i", $data[0])){
                                $main = true;
                                $tabmain[] = $data[0];
                            }
                        }
                        $citypostcode->setMain($main);
                        $om->persist($citypostcode);
                    }
                }
            }

            if ($i % 10000 == 0 && $i !== 0) {
                $om->flush();
            }

            $i++;
        }
        $om->flush();

        fclose($this->file);

    }
}