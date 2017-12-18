# MonologExtraBundle

[![Build Status](https://api.travis-ci.org/Hexanet/MonologExtraBundle.svg)](http://travis-ci.org/Hexanet/MonologExtraBundle) 	[![Total Downloads](https://poser.pugx.org/hexanet/monolog-extra-bundle/downloads.png)](https://packagist.org/packages/hexanet/monolog-extra-bundle) [![Latest stable Version](https://poser.pugx.org/hexanet/monolog-extra-bundle/v/stable.png)](https://packagist.org/packages/hexanet/monolog-extra-bundle)

Symfony bundle with extra processors and logger to log request/response.

## Installation

```bash
composer require hexanet/monolog-extra-bundle
```

## Usage

### Processors

The bundle provides several processors:

* User
* Session ID
* UID
* Additions

#### User

The *UserProcessor* add data about the current user in each log entry.

```yaml
hexanet_monolog_extra:
    processor:
        user: true
```

The default provider returns:
* anonymous when no user is logged
* the username of the current logged user
* cli

You can create your own provider by creating a service that implements *Hexanet\Common\MonologExtraBundle\Provider\User\UserProviderInterface*.

```yaml
hexanet_monolog_extra:
    provider:
        user: your_own_provider_service_id
```

#### Session ID

Add the session id in each log entry.

```yaml
hexanet_monolog_extra:
    processor:
        session_id: true
```

You can create your own provider by creating a service that implements *Hexanet\Common\MonologExtraBundle\Provider\Session\SessionIdProviderInterface*.

```yaml
hexanet_monolog_extra:
    provider:
        session_id: your_own_provider_service_id
```

#### UID

Add an unique identifier for the request in each log entry.

```yaml
hexanet_monolog_extra:
    processor:
        uid: true
```

The bundle comes with 2 providers:

* UniqidProvider (default): use `uniqid`
* ApacheUniqueIdProvider: get from environment, need [*mod_unique_id*](https://httpd.apache.org/docs/2.4/mod/mod_unique_id.html) of Apache

You can create your own provider by creating a service that implements *Hexanet\Common\MonologExtraBundle\Provider\Uid\UidProviderInterface*.

```yaml
hexanet_monolog_extra:
    provider:
        uid: your_own_provider_service_id
```

#### Additions

Add custom data in each log entry.

```yaml
hexanet_monolog_extra:
    processor:
        additions:
            type: symfony
            application: the best symfony application
            locale: "%locale%"
            environment: "%kernel.environment%"
```

### Loggers

#### On request

Create a log entry with the request data.

#### On response

Create a log entry with the response data.

#### On console exception

Create a log entry when an exception occurs in console.

#### Add UID to response

Add the UID of the previous processor in the response headers.

```
HTTP/1.1 302 Found
X-UID: 57c5f5e842b10
```

## Configuration reference

[Configuration reference](doc/configuration_reference.md) for a reference on the available configuration options.

## Credits

Developed by the [Dev Team](http://teamdev.hexanet.fr) of [Hexanet](http://www.hexanet.fr/).

## License

[MonologExtraBundle](https://github.com/Hexanet/MonologExtraBundle) is licensed under the [MIT license](LICENSE).
