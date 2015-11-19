# MonologExtraBundle

[![Build Status](https://api.travis-ci.org/Hexanet/MonologExtraBundle.svg)](http://travis-ci.org/Hexanet/MonologExtraBundle)

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

    #  the bundle come with a gelf publisher that handle communication error with the remote server
    gelf:
        host: '%graylog_host%'
        port: '%graylog_port%'
```


## Apache Unique ID

This module add an unique id to each request.

```
a2enmod unique_id
```