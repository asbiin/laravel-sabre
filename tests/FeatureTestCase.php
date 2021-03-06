<?php

namespace LaravelSabre\Tests;

use Orchestra\Testbench\TestCase;
use LaravelSabre\LaravelSabreServiceProvider;
use Illuminate\Contracts\Auth\Authenticatable;

class FeatureTestCase extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            LaravelSabreServiceProvider::class,
        ];
    }

    protected function resolveApplicationCore($app)
    {
        parent::resolveApplicationCore($app);

        $app->detectEnvironment(function () {
            return 'testing';
        });
    }

    /**
     * Create a user and sign in as that user. If a user
     * object is passed, then sign in as that user.
     *
     * @param null $user
     * @return mixed
     */
    public function signIn($user = null)
    {
        if (is_null($user)) {
            $user = new Authenticated();
            $user->email = 'john@doe.com';
        }

        $this->be($user);

        return $user;
    }
}

class Authenticated implements Authenticatable
{
    public $email;

    public function getAuthIdentifierName()
    {
        return 'Identifier name';
    }

    public function getAuthIdentifier()
    {
        return 'auth-identifier';
    }

    public function getAuthPassword()
    {
        return 'secret';
    }

    public function getRememberToken()
    {
        return 'token';
    }

    public function setRememberToken($value)
    {
    }

    public function getRememberTokenName()
    {
    }
}
