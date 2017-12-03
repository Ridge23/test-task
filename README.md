# Test task

To run application:

- clone this repository in your local dir;
- run ``composer install``;
- run ``docker-compose up``, this will build and run docker required containers;
- create ``.env`` file in root folder of project, with contents of ``.env.dist``;
- access project via ``http://localhost:81/api/appointments`` or for admin panel: ``http://localhost:81/admin/``

For tests, run codeception commands:

``php vendor/bin/codecept run``

Or, for unit tests only:

``php vendor/bin/codecept run unit``

For api (acceptance) tests:

``php vendor/bin/codecept run api``