<?php

namespace Accordous\FluxousClient\Services\Endpoints;

class AccountsEndpoint extends Endpoint
{
    private const BASE_URI = '/accounts';

    /**
     * @param array $attributes
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     */
    public function store(array $attributes)
    {
        return $this->client()->post(self::BASE_URI, $this->validate($attributes));
    }

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:50',
            'type' => 'nullable|string|in:checking,saving,other',
            'description' => 'nullable|string|max:150',
            'opening_balance' => 'required|integer',
            'bank_id' => 'required_if:type,checking,saving|string',
        ];
    }

    protected function messages(): array
    {
        return [

        ];
    }
}
