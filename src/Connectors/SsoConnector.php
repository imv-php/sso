<?php

namespace Imv\Sso\Connectors;

use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Traits\Plugins\HasTimeout;

class SsoConnector extends Connector
{
    use AcceptsJson;
    use HasTimeout;

    protected int $connectTimeout = 60;

    protected int $requestTimeout = 120;

    public function __construct()
    {
        $this->connectTimeout = (int) config('sso.timeout.connect', 60);
        $this->requestTimeout = (int) config('sso.timeout.request', 120);
    }

    public function resolveBaseUrl(): string
    {
        return config('sso.base_url');
    }

    public function resolveConnectTimeout(): int
    {
        return (int) config('sso.timeout.connect', 60);
    }

    public function resolveRequestTimeout(): int
    {
        return (int) config('sso.timeout.request', 120);
    }

    protected function defaultHeaders(): array
    {
        return [
            'Authorization' => 'Basic '.base64_encode(config('sso.client_id').':'.config('sso.client_secret')),
        ];
    }
}
