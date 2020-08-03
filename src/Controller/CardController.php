<?php

namespace App\Controller;

use App\Entity\Price;
use DateTimeInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class CardController extends AbstractController
{
    /**
     * @Route("/card", name="card")
     */
    public function index()
    {
        $dir = '/volume1/web/cardmarket11/allCards';
        $files1 = scandir($dir);
        $files = strval($files1[3]);

        $counter = 0;

foreach ($files1 as $file){
    $handle = @fopen("/volume1/web/cardmarket11/allCards/".$file, "r");
    if ($handle) {
        while (($buffer = fgets($handle, 4096)) !== false) {
            echo $buffer;
        }
        if (!feof($handle)) {
            echo "Error: unexpected fgets() fail\n";
        }
        fclose($handle);
    }
    $counter++;
}






        // print_r($files1);

        //   var_dump();
    //    $currentFile = fopen("/volume1/web/cardmarket11/allCards/2ED.json",'r');
        //$string = file_get_contents("/volume1/web/cardmarket11/allCards/2ED.json");
//
      //  print_r($currentFile);
        //print_r($string);
//        $entityManager = $this->getDoctrine()->getManager();
//
//        $jsonStream = \JsonMachine\JsonMachine::fromFile("AllPrices.json", "/data" /* <- Json Pointer */);

//        foreach ($jsonStream as $name => $data) {
//            foreach ($data as $datum => $datun) {
//                foreach ($datun as $item => $value) {
//                    foreach ($value as $pesho => $gosho) {
//                        foreach ($gosho as $minka => $penka) {
//                            foreach ($penka as $date => $price) {
//                                $product = new Price();
//                                $product->setUuid($name);
//                                $product->setCardFormat($datum);
//                                $product->setProvider($item);
//                                $product->setPriceType($pesho);
//                                $product->setCardType($minka);
//                                $date = \DateTime::createFromFormat('Y-m-d', $date);
//                                $product->setDate($date);
//                                $product->setPrice($price * 100);
//                                $entityManager->persist($product);
//                                $counter++;
//                            }
//                        }
//                    }
//                }
//            }
//        }
//        $entityManager->flush();
        return $this->render('card/index.html.twig', [
            'controller_name' => 'CardController',
            'counter' => $counter
        ]);
    }
}
