# My Profile

| [Api](api/README.md)         | [![CI/api][ci_api_badge]][ci_api_link]  | [![CD/api][cd_api_badge]][cd_api_link] | [![codecov][ci_api_test_badge]][test_link]|
|-------------|----|----|----------|
| Client      | [![CI/client][ci_client_badge]][ci_client_link]  | [![CD/client][cd_client_badge]][cd_client_link]| [![codecov][ci_client_test_badge]][test_link] |
| Admin       | | |

[![Join the chat at https://gitter.im/myprofile_pro/Lobby][gitter_badge]][gitter_link]
[![License: GPL v3][licence_badge]][licence_link]

## Getting Started

  ["My Profile"](https://www.myprofile.pro/) has the goal to help people to create your own web profile and CV!
  
## Important

this branch (master) has used to release the new version [3.0](https://github.com/eerison/myprofile/milestone/2)

## Setup
we are assuming that you installed [docker](https://docs.docker.com/engine/install/ubuntu/) and [docker-compose](https://docs.docker.com/compose/install/) in your computer.

**Install the applications and dependencies**

```shell
make install
```
Note: in case you are using windows please consider to use [WSL](https://docs.microsoft.com/en-us/windows/wsl/install) or run the commands from [Makefile](Makefile) manually one by one.

**After run the command above you can access:**

> api: http://localhost:8000
> 
> client: http://localhost:3000

after you install the application you can use `docker-compose` commands.

[ci_api_badge]: https://github.com/eerison/myprofile/actions/workflows/ci_api.yml/badge.svg?branch=master
[ci_api_link]: https://github.com/eerison/myprofile/actions/workflows/ci_api.yml?query=branch%3Amaster++
[cd_api_badge]: https://github.com/eerison/myprofile/actions/workflows/cd_api.yml/badge.svg
[cd_api_link]: https://github.com/eerison/myprofile/actions/workflows/cd_api.yml
[ci_api_test_badge]: https://codecov.io/gh/eerison/myprofile/branch/master/graph/badge.svg?flag=api

[ci_client_badge]: https://github.com/eerison/myprofile/actions/workflows/ci_client.yml/badge.svg?branch=master
[ci_client_link]: https://github.com/eerison/myprofile/actions/workflows/ci_client.yml?query=branch%3Amaster++
[cd_client_badge]: https://github.com/eerison/myprofile/actions/workflows/cd_client.yml/badge.svg?branch=master
[cd_client_link]: https://github.com/eerison/myprofile/actions/workflows/cd_client.yml?query=branch%3Amaster++
[ci_client_test_badge]: https://codecov.io/gh/eerison/myprofile/branch/master/graph/badge.svg?flag=client

[test_link]: https://codecov.io/gh/eerison/myprofile
[gitter_badge]: https://badges.gitter.im/Join%20Chat.svg
[gitter_link]: https://gitter.im/myprofile_pro/Lobby?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge
[licence_badge]: https://img.shields.io/badge/License-GPLv3-blue.svg
[licence_link]: https://github.com/eerison/myprofile/blob/master/LICENSE

