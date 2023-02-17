<?php

namespace Accordous\FluxousClient\Services\Endpoints;

class AuthEndpoint extends Endpoint
{
    private const BASE_URI = '/auth';

    /**
     * @param array $attributes
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     */
    public function token(array $attributes)
    {
        return $this->client()->post(self::BASE_URI . '/token', $this->validate($attributes));
    }

    protected function rules(): array
    {
        return [
            'client_id' => 'required',
            'client_secret' => 'required',
        ];
    }

    protected function messages(): array
    {
        return [
            'client_id' => 'Id do cliente é obrigatório.',
            'client_secret' => 'Segredo do cliente é obrigatório.',
        ];
    }
}
