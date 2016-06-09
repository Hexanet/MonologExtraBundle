# MonologExtraBundle

[![Build Status](https://api.travis-ci.org/Hexanet/MonologExtraBundle.svg)](http://travis-ci.org/Hexanet/MonologExtraBundle) 	[![Total Downloads](https://poser.pugx.org/hexanet/monolog-extra-bundle/downloads.png)](https://packagist.org/packages/hexanet/monolog-extra-bundle) [![Latest Unstable Version](https://poser.pugx.org/hexanet/monolog-extra-bundle/v/unstable.png)](https://packagist.org/packages/hexanet/monolog-extra-bundle)

Symfony2 bundle with extra processors and logger to log request/response.

## Installation

```
composer require hexanet/monolog-extra-bundle
```

## Configuration reference

```
hexanet_monolog_extra:

    # add data to extra in each records of log
    processor:

        # add the username of the current user
        user: true

        # add the session id
        session_id: false

        # add Unique Identification Number
        uid: true

        # add symfony environnement
        environment: true

        # add static data ( by default it add type => symfony )
        additions:
            application: symfony application
            extra_info: blabla

    logger:
        # log each request
        on_request: true

        # log console exception
        on_console_exception: true

        # add uid in the headers of responses
        add_uid_to_response: true

    # you can change the provider for uid, user and session_id
    provider:
        uid: hexanet_monolog_extra.logger.provider.uid.apache_unique_id

        user: hexanet_monolog_extra.logger.provider.user.symfony

        session_id: hexanet_monolog_extra.logger.provider.session.symfony
```


### Apache Unique ID

This module add an unique id to each request.

```
a2enmod unique_id
```

## Credits

Developed by the [Web Team](https://teamweb.hexanet.fr/) of [Hexanet](http://www.hexanet.fr/).

## License

[MonologExtraBundle](https://github.com/Hexanet/MonologExtraBundle) is licensed under the [MIT license](LICENSE).
