<?php

namespace Accordous\FluxousClient\Services;

use Accordous\FluxousClient\Services\Endpoints\AccountsEndpoint;
use Accordous\FluxousClient\Services\Endpoints\AuthEndpoint;
use Accordous\FluxousClient\Services\Endpoints\CategoriesEndpoint;
use Accordous\FluxousClient\Services\Endpoints\TransactionsEndpoint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class FluxousService
{
    private const TOKEN_TIME = 1296000;

    /**
     * @var \Illuminate\Http\Client\PendingRequest
     */
    private $http;

    /**
     * @var AuthEndpoint
     */
    private $auth;

    /**
     * @var AccountsEndpoint
     */
    private $accounts;

    /**
     * @var CategoriesEndpoint
     */
    private $categories;

    /**
     * @var TransactionsEndpoint
     */
    private $transactions;

    /**
     * FluxousService constructor.
     */
    public function __construct($clientId, $clientSecret, $token = null)
    {
        $this->http = Http::withoutVerifying()
            ->baseUrl(Config::get('fluxous.host') . Config::get('fluxous.api'))
            ->withHeaders([
                'Cache-Control' => 'no-cache',
            ]);

        $this->auth = new AuthEndpoint($this->http);
        $this->accounts = new AccountsEndpoint($this->http);
        $this->categories = new CategoriesEndpoint($this->http);
        $this->transactions = new TransactionsEndpoint($this->http);

        if ($token === null) {
            $tokenKey = 'token_' . $clientId;

            $token = cache()->remember($tokenKey, self::TOKEN_TIME, fn () => $this->getToken($clientId, $clientSecret));
        }

        $this->http->withToken($token);
    }

    /**
     * @return AuthEndpoint
     */
    public function auth(): AuthEndpoint
    {
        return $this->auth;
    }

    /**
     * @return AccountsEndpoint
     */
    public function accounts(): AccountsEndpoint
    {
        return $this->accounts;
    }

    /**
     * @return CategoriesEndpoint
     */
    public function categories(): CategoriesEndpoint
    {
        return $this->categories;
    }

    /**
     * @return TransactionsEndpoint
     */
    public function transactions(): TransactionsEndpoint
    {
        return $this->transactions;
    }

    private function getToken($clientId, $clientSecret)
    {
        return $this->auth->token([
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
        ])->json('access_token');
    }
}
