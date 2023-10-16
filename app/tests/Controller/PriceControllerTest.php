<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PriceControllerTest extends WebTestCase
{
    public function testRequest(): void
    {
        $data = [
            'product'    => 1,
            'taxNumber'  => "DE123456789",
            'couponCode' => "D15"
        ];
        $client = static::createClient();
        $client->request(
            'POST',
            '/calculate-price',
            content: json_encode($data)
        );

        $content = $client->getResponse()->getContent();

        $this->assertResponseIsSuccessful();
        $this->assertJson($content);

        $decodedContent = json_decode($content, true);

        $this->assertArrayHasKey('success', $decodedContent);
        $this->assertArrayHasKey('data', $decodedContent);
        $this->assertArrayHasKey('basePrice', $decodedContent['data']);
        $this->assertArrayHasKey('price', $decodedContent['data']);
        $this->assertArrayHasKey('tax', $decodedContent['data']);
        $this->assertArrayHasKey('discount', $decodedContent['data']);
        $this->assertArrayHasKey('priceWithDiscount', $decodedContent['data']);
        $this->assertIsInt($decodedContent['data']['basePrice']);
        $this->assertIsFloat($decodedContent['data']['price']);
    }
}
