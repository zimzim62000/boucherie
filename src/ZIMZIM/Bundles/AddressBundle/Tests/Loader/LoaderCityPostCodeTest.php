<?php

namespace ZIMZIM\Bundles\AddressBundle\Tests\Loader;

use ZIMZIM\Bundles\AddressBundle\Loader\LoaderCityPostCode;
use ZIMZIM\Test\ZimzimWebTestCase;

class LoaderCityPostCodeTest extends ZimzimWebTestCase
{
    public $client;
    public $router;

    public function setUp()
    {
        $this->client = static::createClient(array(), $this->users['SuperAdmin']);
        $this->router = $this->client->getContainer()->get('router');
    }

    public function testWithGoodData()
    {

        $mockCityPostCode = $this->getMock('ZIMZIM\Bundles\AddressBundle\Entity\CityPostCode');

        $mockObjectManager = $this->getMock('Doctrine\Common\Persistence\ObjectManager');
        $mockObjectManager->expects($this->exactly(3))
            ->method('persist');
        $mockObjectManager->expects($this->once())
            ->method('flush');

        $datas = array(
            array(
                "code postal",
                "insee",
                "article",
                "ville",
                "ARTICLE",
                "VILLE",
                "libelle",
                "region",
                "nom region",
                "dep",
                "nom dep",
                "longitude",
                "latitude",
                "codex",
                "metaphone"
            ),
            array(
                "01500",
                "01004",
                "",
                "Ambérieu-en-Bugey",
                "",
                "AMBERIEU-EN-BUGEY",
                "AMBERIEU EN BUGEY",
                "82",
                "RHONE-ALPES",
                "01",
                "Ain",
                "45.979851",
                "5.33689",
                "A516",
                "AMPRNPJ"
            ),
            array(
                "01330",
                "01005",
                "",
                "Ambérieux-en-Dombes",
                "",
                "AMBERIEUX-EN-DOMBES",
                "AMBERIEUX EN DOMBES",
                "82",
                "RHONE-ALPES",
                "01",
                "Ain",
                "45.998057",
                "4.902498",
                "A516",
                "AMPRKSNTMPS"
            ),
            array(
                "01300",
                "01006",
                "",
                "Ambléon",
                "",
                "AMBLEON",
                "AMBLEON",
                "82",
                "RHONE-ALPES",
                "01",
                "Ain",
                "45.74987",
                "5.601326",
                "A514",
                "AMPLN"
            )
        );

        $filename = 'Resources/test.csv';
        $filetest = fopen(dirname(__FILE__) . '/../' . $filename, 'w+');
        foreach ($datas as $data) {
            fputcsv($filetest, $data, ",");
        }
        fclose($filetest);

        $Loader = new LoaderCityPostCode($filename, $mockCityPostCode);

        $Loader->load($mockObjectManager);

        unlink(dirname(__FILE__) . '/../' . $filename);

    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testWithoutValidFile()
    {

        $mockCityPostCode = $this->getMock('ZIMZIM\Bundles\AddressBundle\Entity\CityPostCode');

        $mockObjectManager = $this->getMock('Doctrine\Common\Persistence\ObjectManager');

        $filename = 'Resources\failtest.csv';

        $Loader = new LoaderCityPostCode($filename, $mockCityPostCode);

        $Loader->load($mockObjectManager);

    }

    public function testWithErrorAndGoodData()
    {

        $mockCityPostCode = $this->getMock('ZIMZIM\Bundles\AddressBundle\Entity\CityPostCode');

        $mockObjectManager = $this->getMock('Doctrine\Common\Persistence\ObjectManager');
        $mockObjectManager->expects($this->once())
            ->method('persist');
        $mockObjectManager->expects($this->once())
            ->method('flush');

        $datas = array(
            array(
                "code postal",
                "insee",
                "article",
                "ville",
                "ARTICLE",
                "VILLE",
                "libelle",
                "region",
                "nom region",
                "dep",
                "nom dep",
                "longitude",
                "latitude",
                "codex",
                "metaphone"
            ),
            array(
                "01500",
                "01004",
                "",
                "Ambérieu-en-Bugey",
                "",
                "AMBERIEU-EN-BUGEY",
                "AMBERIEU EN BUGEY",
                "82",
                "",
                "01",
                "Ain",
                "45.979851",
                "5.33689",
                "A516",
                "AMPRNPJ"
            ),
            array(
                "01330",
                "01005",
                "",
                "Ambérieux-en-Dombes",
                "",
                "AMBERIEUX-EN-DOMBES",
                "AMBERIEUX EN DOMBES",
                "82",
                "RHONE-ALPES",
                "01",
                "Ain",
                "45.998057",
                "4.902498",
                "A516",
                "AMPRKSNTMPS"
            ),
            array(
                "01300",
                "01006",
                "",
                "Ambléon",
                "",
                "AMBLEON",
                "AMBLEON",
                "82",
                "RHONE-ALPES",
                "01",
                "Ain",
                "",
                "5.601326",
                "A514",
                "AMPLN"
            )
        );

        $filename = 'Resources/test.csv';
        $filetest = fopen(dirname(__FILE__) . '/../' . $filename, 'w+');
        foreach ($datas as $data) {
            fputcsv($filetest, $data, ",");
        }
        fclose($filetest);

        $Loader = new LoaderCityPostCode($filename, $mockCityPostCode);

        $Loader->load($mockObjectManager);

        unlink(dirname(__FILE__) . '/../' . $filename);

    }

}
