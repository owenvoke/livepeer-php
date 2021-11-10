<?php

declare(strict_types=1);

namespace OwenVoke\Livepeer;

use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin\AddHostPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Client\Common\Plugin\RedirectPlugin;
use Http\Discovery\Psr17FactoryDiscovery;
use OwenVoke\Livepeer\Api\AbstractApi;
use OwenVoke\Livepeer\Api\Session;
use OwenVoke\Livepeer\Api\Stream;
use OwenVoke\Livepeer\Exception\BadMethodCallException;
use OwenVoke\Livepeer\Exception\InvalidArgumentException;
use OwenVoke\Livepeer\HttpClient\Builder;
use OwenVoke\Livepeer\HttpClient\Plugin\Authentication;
use OwenVoke\Livepeer\HttpClient\Plugin\PathPrepend;
use Psr\Http\Client\ClientInterface;

/**
 * @method Session session()
 * @method Session sessions()
 * @method Stream stream()
 * @method Stream streams()
 */
final class Client
{
    public const AUTH_ACCESS_TOKEN = 'access_token_header';

    private ?string $enterpriseUrl = null;
    private Builder $httpClientBuilder;

    public function __construct(Builder $httpClientBuilder = null, ?string $enterpriseUrl = null)
    {
        $this->httpClientBuilder = $builder = $httpClientBuilder ?? new Builder();

        $builder->addPlugin(new RedirectPlugin());
        $builder->addPlugin(new AddHostPlugin(Psr17FactoryDiscovery::findUriFactory()->createUri('https://livepeer.com')));
        $builder->addPlugin(new HeaderDefaultsPlugin([
            'User-Agent' => 'livepeer-php (https://github.com/owenvoke/livepeer-php)',
        ]));

        $builder->addHeaderValue('Accept', 'application/json');
        $builder->addPlugin(new PathPrepend('/api'));

        if ($enterpriseUrl) {
            $this->setEnterpriseUrl($enterpriseUrl);
        }
    }

    public static function createWithHttpClient(ClientInterface $httpClient): self
    {
        $builder = new Builder($httpClient);

        return new self($builder);
    }

    /** @throws InvalidArgumentException */
    public function api(string $name): AbstractApi
    {
        switch ($name) {
            case 'session':
            case 'sessions':
                return new Session($this);

            case 'stream':
            case 'streams':
                return new Stream($this);

            default:
                throw new InvalidArgumentException(sprintf('Undefined api instance called: "%s"', $name));
        }
    }

    public function authenticate(string $tokenOrLogin, ?string $password = null, ?string $authMethod = null): void
    {
        if (null === $password && null === $authMethod) {
            throw new InvalidArgumentException('You need to specify authentication method!');
        }

        if (null === $authMethod && $password === self::AUTH_ACCESS_TOKEN) {
            $authMethod = $password;
            $password = null;
        }

        $this->getHttpClientBuilder()->removePlugin(Authentication::class);
        $this->getHttpClientBuilder()->addPlugin(new Authentication($tokenOrLogin, $password, $authMethod));
    }

    private function setEnterpriseUrl(string $enterpriseUrl): void
    {
        $this->enterpriseUrl = $enterpriseUrl;

        $builder = $this->getHttpClientBuilder();
        $builder->removePlugin(AddHostPlugin::class);
        $builder->removePlugin(PathPrepend::class);

        $builder->addPlugin(new AddHostPlugin(Psr17FactoryDiscovery::findUriFactory()->createUri($this->getEnterpriseUrl())));
        $builder->addPlugin(new PathPrepend('/api'));
    }

    public function getEnterpriseUrl(): ?string
    {
        return $this->enterpriseUrl;
    }

    public function __call(string $name, array $args): AbstractApi
    {
        try {
            return $this->api($name);
        } catch (InvalidArgumentException $e) {
            throw new BadMethodCallException(sprintf('Undefined method called: "%s"', $name), $e->getCode(), $e);
        }
    }

    public function getHttpClient(): HttpMethodsClientInterface
    {
        return $this->getHttpClientBuilder()->getHttpClient();
    }

    protected function getHttpClientBuilder(): Builder
    {
        return $this->httpClientBuilder;
    }
}
