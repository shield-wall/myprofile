# My Profile

[![Continuous Integration][ci_badge]][ci_link]
[![Continuous Deploy][cd_badge]][cd_link]
[![codecov][test_badge]][test_link]
[![Join the chat at https://gitter.im/myprofile_pro/Lobby][gitter_badge]][gitter_link] 
[![License: GPL v3][licence_badge]][licence_link]

## Getting Started

  ["My Profile"](https://www.myprofile.pro/) is a project to goal of help people to create your professional website and CV!
  
## Important

this branch (master) has used for release the new version [3.0](https://github.com/eerison/myprofile/milestone/2)

the main idea is use

- api platform as API rest
- nuxtJS as client

## Run the API

to start the api you just need to run the command bellow

```shell
make up
```

after that you can open the api on `localhost:8000/api`

## Run the client

1 - to start the client you need to comment the entrypoint in `docker-composer.yml`

```yaml
client:
  ....
  #entrypoint: yarn dev
```

2 - install the dependencies

```shell
docker-compose run --rm client npm install
```

3 - remove the comment that you added in `docker-composer.yml`

```yaml
client:
  ....
  entrypoint: yarn dev
```

4 - run the command bellow

```shell
docker-compose up -d
```

Note: there is an [issue](https://github.com/eerison/myprofile/issues/410) to fix this setup for the client, if you wish to contribute to fix it fell free :) 


  
[ci_badge]: https://github.com/eerison/myprofile/actions/workflows/continuous_integration.yml/badge.svg?branch=master
[ci_link]: https://github.com/eerison/myprofile/actions/workflows/continuous_integration.yml?query=workflow%3AContinuous+Integration
[cd_badge]: https://github.com/eerison/myprofile/actions/workflows/continuous_deploy.yml/badge.svg
[cd_link]: https://github.com/eerison/myprofile/actions/workflows/continuous_deploy.yml?query=workflow%3AContinuous+Deploy
[test_badge]: https://codecov.io/gh/eerison/myprofile/branch/master/graph/badge.svg?token=ZIW9RTWH1B
[test_link]: https://codecov.io/gh/eerison/myprofile
[gitter_badge]: https://badges.gitter.im/Join%20Chat.svg
[gitter_link]: https://gitter.im/myprofile_pro/Lobby?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge
[licence_badge]: https://img.shields.io/badge/License-GPLv3-blue.svg
[licence_link]: https://github.com/eerison/myprofile/blob/master/LICENSE

