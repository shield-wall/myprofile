# My Profile

[![Continuous Integration][ci_badge]][ci_link]
[![Continuous Deploy][cd_badge]][cd_link]
[![PhpStan][phpstan_badge]][phpstan_link]
[![codecov][test_badge]][test_link]
[![Join the chat at https://gitter.im/myprofile_pro/Lobby][gitter_badge]][gitter_link] 
[![License: GPL v3][licence_badge]][licence_link]

The version 2.x is open for `bugfix` only, then please create branches from [2.x](https://github.com/eerison/myprofile/tree/2.x)

new `features` must be implemented in the next major [3.0.0](https://github.com/eerison/myprofile/milestone/2) (using [master](https://github.com/eerison/myprofile/tree/master)) 

## Getting Started

  ["My Profile"](https://www.myprofile.pro/) is a project to goal of help people to create your professional web site and CV!
  
### Installing

  ```
    make install
  ```

Open this link in your browser: [localhost:8000](http://localhost:8000)
  
  other commands:
   - `make restart`
   - `make build`
   - `make watch`
  
  
### Testing

```
    make test
```

### Xdebug


Xdebug is listening on port [10000](.docker/common.env)
  
[ci_badge]: https://github.com/eerison/myprofile/actions/workflows/continuous_integration.yml/badge.svg?branch=2.x
[ci_link]: https://github.com/eerison/myprofile/actions/workflows/continuous_integration.yml?query=workflow%3AContinuous+Integration
[cd_badge]: https://github.com/eerison/myprofile/actions/workflows/continuous_deploy.yml/badge.svg
[cd_link]: https://github.com/eerison/myprofile/actions/workflows/continuous_deploy.yml?query=workflow%3AContinuous+Deploy
[phpstan_badge]: https://img.shields.io/badge/PHPStan-level%204-brightgreen.svg?style=flat
[phpstan_link]: phpstan.neon
[test_badge]: https://codecov.io/gh/eerison/myprofile/branch/2.x/graph/badge.svg?token=ZIW9RTWH1B
[test_link]: https://codecov.io/gh/eerison/myprofile
[gitter_badge]: https://badges.gitter.im/Join%20Chat.svg
[gitter_link]: https://gitter.im/myprofile_pro/Lobby?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge
[licence_badge]: https://img.shields.io/badge/License-GPLv3-blue.svg
[licence_link]: https://github.com/eerison/myprofile/blob/master/LICENSE

