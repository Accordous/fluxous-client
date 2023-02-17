<?php

namespace Accordous\FluxousClient\Services\Endpoints;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Validator;

abstract class Endpoint
{
    protected $http;

    public function __construct(PendingRequest $http)
    {
        $this->http = $http;
    }

    protected function client(): PendingRequest
    {
        return $this->http;
    }

    protected function validate(array $attributes): array
    {
        return Validator::validate($attributes, $this->rules(), $this->messages());
    }

    abstract protected function rules(): array;

    abstract protected function messages(): array;
}
