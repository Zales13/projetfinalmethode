<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiTest extends WebTestCase
{

    public function testDefault(): void
    {
        $client = static::createClient();
        // Request a specific page
        $client->jsonRequest('GET', '/');
        $response = $client->getResponse();
        $this->assertResponseIsSuccessful();
        $this->assertJson($response->getContent());
        $responseData = json_decode($response->getContent(), true);
        $this->assertEquals(['message' => "Hello"], $responseData);
    }

    public function testApiAddition(): void
    {
        $client = static::createClient();
        // Request a specific page
        $client->jsonRequest('GET', '/api/');
        $response = $client->getResponse();
        $this->assertResponseIsSuccessful();
        $this->assertJson($response->getContent());
        $responseData = json_decode($response->getContent(), true);
        $this->assertEquals(['message' => "Hello world"], $responseData);
    }

    public function testGetProduct(): void
    {
        $client = static::createClient();
        $client->jsonRequest('GET', '/api/products/2');
        $response = $client->getResponse();
        $this->assertResponseIsSuccessful();
        $this->assertJson($response->getContent());
        $responseData = json_decode($response->getContent(), true);
        $this->assertEquals([
            "id"=> 2,
            "name"=> "Morty Smith",
            "price"=> 16.50,
            "quantity"=> 5,
            "image"=> "https://rickandmortyapi.com/api/character/avatar/2.jpeg"
        ],
        $responseData);
    }

    public function testAddToCart(): void
    {
    $client = static::createClient();
    $product = [
        "id"=> 2,
        "name"=> "Morty Smith",
        "price"=> 16.50,
        "quantity"=> 5,
        "image"=> "https://rickandmortyapi.com/api/character/avatar/2.jpeg"
    
    ];
    
        $client->jsonRequest('POST', '/api/cart/2', [
        'quantity' => 1,
    
    ]);
    $response = $client->getResponse();
    $this->assertResponseIsSuccessful();
    $this->assertJson($response->getContent());
    $responseData = json_decode($response->getContent(), true);
    $this->assertEquals($responseData, [
        "id" => 1,
        "products" => 
        [[
        "id"=> 2,
        "name"=> "Morty Smith",
        "price"=> 16.50,
        "quantity"=> 5,
        "image"=> "https://rickandmortyapi.com/api/character/avatar/2.jpeg"
    
    ]],
    
    ]);
    
    }

    public function testDeleteCart(): void
    {
        $client = static::createClient();
        $client->jsonRequest('DELETE', '/api/cart/2');
        $response = $client->getResponse();
        $this->assertResponseIsSuccessful();
        $this->assertJson($response->getContent());
        $responseData = json_decode($response->getContent(), true);
        $this->assertEquals($responseData, [
            "id"=> 1,
            "products" => []
        ]);
    }

    public function testAddToCartFail(): void
    {
        $client = static::createClient();
        $product = [
            'id' => 2,
            "name" => "Morty Smith",
            "price" => 16.50,
            "quantity" => 5,
            "image" => "https://rickandmortyapi.com/api/character/avatar/2.jpeg"
        ];
        $client->jsonrequest('POST', 'api/cart/2',[
            "quantity" => 100,
        ]);
        $response = $client->getResponse();
        $this->assertEquals(200,$response->getStatusCode());
        $this->assertResponseIsSuccessful();
        $this->assertJson($response->getContent());
        $responseData = json_decode($response->getContent(), true);
        $this->assertEquals(["error"=> "too many"], $responseData);
        }

    
}
