<?php

namespace App\Controller;

use App\Entity\Price;
use DateTimeInterface;
use JsonStreamingParser\Listener\InMemoryListener;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;


class CardController extends AbstractController
{

    private $normalizer;

    public function __construct(NormalizerInterface $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    /**
     * @Route("/card", name="card")
     */
    public function index()
    {
       // ini_set('display_errors',true);
        print_r('opit20<br>');


//        $stream = fopen('/volume1/web/cardmarket11/public/AllPrices.json', 'r');
//        $listener = new InMemoryListener();
//        try {
//            $parser = new \JsonStreamingParser\Parser($stream, $listener);
//            $parser->parse();
//            fclose($stream);
//        } catch (Exception $e) {
//            fclose($stream);
//            throw $e;
//        }
//        var_dump($parser);

//        set_time_limit(300);
//        $listener = new \JsonStreamingParser\Listener\InMemoryListener();
//        $stream = fopen('/volume1/web/cardmarket11/public/AllPrices.json', 'r');
//        try {
//            $parser = new \JsonStreamingParser\Parser($stream, $listener);
//            $parser->parse();
//            fclose($stream);
//        } catch (Exception $e) {
//            fclose($stream);
//            throw $e;
//        }
//        var_dump($listener->getJson());

//        $file = file_get_contents('/volume1/web/cardmarket11/public/AllPrices.json');
//        //$pe = normalizer_normalize($file, 'json');
//        $pr = $this->normalizer->normalize($file,'json');
//        $pt = json_decode($pr,true);
//
//        foreach ($pt['data'] as $card=>$info){
//            print_r($card."<br>");
//            //print_r($info."<br><br>");
//        }






//        $dir = '/volume1/web/cardmarket11/allCards';
//        $files1 = scandir($dir);
//        $files = strval($files1[3]);
//
        $counter = 343;
//        foreach ($files1 as $file){
//    $handle = @fopen("/volume1/web/cardmarket11/allCards/".$file, "r");
//    if ($handle) {
//        while (($buffer = fgets($handle, 4096)) !== false) {
//            echo $buffer;
//        }
//        if (!feof($handle)) {
//            echo "Error: unexpected fgets() fail\n";
//        }
//        fclose($handle);
//    }
//    $counter++;
//}


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
