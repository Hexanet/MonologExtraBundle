# Configuration reference

```yaml
hexanet_monolog_extra:

    # add data to extra in each records of log
    processor:

        # add the username of the current user
        user: true

        # add the session id
        session_id: false

        # add Unique Identification Number
        uid: true

        # add static data
        additions:
            type: symfony
            application: symfony application
            extra_info: blabla
            environment:  "%kernel.environment%"

    logger:
        # log each request
        on_request: true

        # log each response
        on_response: true

        # log each command
        on_command: true

        # log console exception
        on_console_exception: true

        # add uid in the headers of responses
        add_uid_to_response: true

    # you can change the provider for uid, user and session_id
    provider:
        uid: Hexanet\Common\MonologExtraBundle\Provider\Uid\ApacheUniqueIdProvider

        user: Hexanet\Common\MonologExtraBundle\Provider\User\SymfonyUserProvider

        session_id: Hexanet\Common\MonologExtraBundle\Provider\Session\SymfonySessionIdProvider
```
