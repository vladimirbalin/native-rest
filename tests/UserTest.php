<?php

namespace tests;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private Client $client;

    protected function setUp(): void
    {
        $this->client = new Client();
    }

    public function test_check_if_it_even_works()
    {
        $response = $this->client->get('http://native-rest.local/check');
        $body = $response->getBody();
        $json = json_decode($body, true);

        $this->assertStringContainsString(
            'application/json',
            $response->getHeader('Content-Type')[0]
        );
        $this->assertJson($body);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArrayHasKey('status', $json);
        $this->assertEquals('check passed', $json['status']);
    }

    public function test_user_can_be_created()
    {
        $user = [
            "username" => "New user",
            "password" => "new password",
            "password_confirm" => "new password"
        ];

        $response = $this->client->post('http://native-rest.local/check',
            ['body' => json_encode($user)]);
        $json = $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());

    }
}