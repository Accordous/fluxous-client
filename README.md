# Fluxous

Esse pacote auxilia no consumo da API do Fluxous utilizando Laravel.

Documentação: [Fluxous - Manual API](https://documenter.getpostman.com/view/4094324/2s8YswSs2f#intro).

## Instalação
```shell
composer require accordous/fluxous-client
```

## Configuração

- Publique o arquivo de configuração caso tenha interesse em alterar algum dos valores pré-definidos
```shell
php artisan vendor:publish --tag=Fluxous
```

- Altere as configurações no arquivo `.env` do seu projeto Laravel
```.dotenv
FLUXOUS_HOST='https://api.fluxous.com.br'
FLUXOUS_API='/v1'
```

## Recursos
- Autenticação `/auth/token`

```php
use Accordous\FluxousClient\Services\FluxousService;

$service = new FluxousService();

$data = [
    'client_id' => '',
    'client_secret' => '',
];

$response = $service->auth()->token($data);

$result = $response->json();
```

- Categorias `/categories`

get
```php
use Accordous\FluxousClient\Services\FluxousService;

$service = new FluxousService($clientId, $clientSecret);

$response = $service->categories()->index();

$result = $response->json();
```

post
```php
use Accordous\FluxousClient\Services\FluxousService;

$service = new FluxousService($clientId, $clientSecret);

$attributes = [
    '' => '',
];

$response = $service->categories()->store($attributes);

$result = $response->json();
```

- Contas `/accounts`

```php
use Accordous\FluxousClient\Services\FluxousService;

$service = new FluxousService($clientId, $clientSecret);

$attributes = [
    '' => '',
];

$response = $service->accounts()->store($attributes);

$result = $response->json();
```

- Transações

```php
use Accordous\FluxousClient\Services\FluxousService;

$service = new FluxousService($clientId, $clientSecret);

$attributes = [
    '' => '',
];

$response = $service->transactions()->store($attributes);

$result = $response->json();
```
