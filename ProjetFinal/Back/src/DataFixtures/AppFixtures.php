<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Product;
use App\Service\RickAndMortyApiService;



class AppFixtures extends Fixture
{
    private RickAndMortyApiService $rickAndMortyService;
    private $prices = ["8", "9,99", "15", "16.50", "20"];
    private $quantites = [0, 2,5,20,30,70];

    public function __construct(RickAndMortyApiService $rickAndMortyService)
    {
        $this->rickAndMortyService = $rickAndMortyService;
    }

    public function load(ObjectManager $manager): void
    {
        $data = $this->rickAndMortyService->loadApi();
        foreach ($data as $model){
            $product = new Product();
            $product->setName($model->getName());
            $product->setPrice(15);
            $product->setQuantity(30);
            $product->setImage($model->getImage());
            $manager->persist($product);
        }
      
        $manager->flush();
    }
}
