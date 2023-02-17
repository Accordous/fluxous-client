<?php

namespace Accordous\FluxousClient\Services\Endpoints;

class TransactionsEndpoint extends Endpoint
{
    private const BASE_URI = '/transactions';

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
            'description' => 'required|string|max:150',
            'amount' => 'required|integer',
            'billing_date' => 'required|string', // formato YYYY-MM-DD
            'paid' => 'required|boolean', // sempre true
            'is_recurring' => 'required|boolean', // sempre false
            'type' => 'required|string|in:credit,debit,transference',
            'target_account_id' => 'required_if:type,credit|string',
            'origin_account_id' => 'required_if:type,debit|string',
            'category_id' => 'required|string', //UUID
        ];
    }

    protected function messages(): array
    {
        return [

        ];
    }
}
