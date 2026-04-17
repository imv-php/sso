<?php

namespace Imv\Sso\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class SignRequest extends Request
{
    public function __construct(
        protected string $doc_id,
        protected string $accessToken,
    ) {}

    /**
     * Define the HTTP method
     */
    protected Method $method = Method::GET;

    /**
     * Define the endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return 'e-imzo';
    }

    protected function defaultHeaders(): array
    {
        return [
            'Authorization' => 'Bearer ' . $this->accessToken,
        ];
    }

    protected function defaultQuery(): array
    {
        return [
            'key' => $this->doc_id,
        ];
    }
}
