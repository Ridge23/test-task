# Test task

For now, to run application:

- clone this repository in your local dir;
- run ``composer install``;
- run ``docker-compose up``, this will build and run docker required containers;
- create ``.env`` file in root folder of project, with contents of ``.env.dist``;
- access project via ``http://localhost:81/api/appointments`` or for admin panel: ``http://localhost:81/admin/``