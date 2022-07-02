# My Profile

[![Continuous Integration][ci_badge]][ci_link]
[![Continuous Deploy][cd_badge]][cd_link]
[![PhpStan][phpstan_badge]][phpstan_link]
[![codecov][test_badge]][test_link] 
[![License: GPL v3][licence_badge]][licence_link]

## Getting Started

  ["My Profile"](https://www.myprofile.pro/) has the goal to help people to create their **Curriculum** and a **profile page**!
  
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
[phpstan_badge]: https://img.shields.io/badge/PHPStan-level%206-brightgreen.svg?style=flat
[phpstan_link]: phpstan.neon
[test_badge]: https://codecov.io/gh/eerison/myprofile/branch/2.x/graph/badge.svg?token=ZIW9RTWH1B
[test_link]: https://codecov.io/gh/eerison/myprofile
[licence_badge]: https://img.shields.io/badge/License-GPLv3-blue.svg
[licence_link]: https://github.com/eerison/myprofile/blob/master/LICENSE

