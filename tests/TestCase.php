<?php

namespace Imv\Sso\Tests;

use Imv\Sso\SsoServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            SsoServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('sso.base_url', config('sso.base_url'));
        config()->set('sso.client_id', config('sso.client_id'));
        config()->set('sso.client_secret', config('sso.client_secret'));
    }
}
