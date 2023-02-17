<?php

namespace Accordous\FluxousClient\Services\Endpoints;

class CategoriesEndpoint extends Endpoint
{
    private const BASE_URI = '/categories';

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->client()->get(self::BASE_URI);
    }

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
            'type' => 'required|string|in:checking,saving,other', // sempre other
            'description' => 'nullable|string|max:150',
            'opening_balance' => 'required|integer',
            'bank_id' => 'required_if:type,checking,saving|string', // UUID
        ];
    }

    protected function messages(): array
    {
        return [

        ];
    }
}
