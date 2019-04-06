<?php

namespace App\Proxies\Passport;

use GuzzleHttp\Client;
use Illuminate\Contracts\Support\Arrayable;

class PasswordProxy implements Arrayable
{
    protected $attributes = [];

    protected $httpClient;

    private $grantType = 'password';

    public function __construct(Client $client)
    {
        $this->httpClient = $client;
    }

    public function tokens(array $credentials, string $scope = '*'): self
    {
        $data = array_merge($credentials, [
            'scope' => $scope,
            'grant_type' => $this->grantType,
        ]);

        return $this->post($this->setFormData($data, $scope));
    }

    public function refresh(string $refreshToken, string $scope = ''): self
    {
        $data = [
            'refresh_token' => $refreshToken,
            'scope' => $scope,
            'grant_type' => 'refresh_token',
        ];

        return $this->post($this->setFormData($data));
    }

    public function toArray(): array
    {
        return $this->attributes;
    }

    private function post(array $data): self
    {
        $response = $this->httpClient->post($this->getRequestUrl(), [
            'form_params' => $data,
        ]);

        $this->setAttributes(json_decode((string)$response->getBody(), true));

        return $this;
    }

    private function setAttributes(array $data): void
    {
        $this->attributes = $data;
    }

    private function setFormData(array $data): array
    {
        $passportConfig = config('passport');

        return array_merge($data, [
            'client_id' => $passportConfig['client_id'],
            'client_secret' => $passportConfig['client_secret'],
        ]);
    }

    private function getRequestUrl(): string
    {
        return url('api/oauth/token');
    }

    public function __get(string $attribute): string
    {
        return $this->attributes[$attribute] ?? null;
    }
}