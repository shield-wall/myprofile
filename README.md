# My Profile

[![Maintainability](https://api.codeclimate.com/v1/badges/b488b1b6032699ee3fbd/maintainability)](https://codeclimate.com/github/eerison/myprofile/maintainability)
[![Join the chat at https://gitter.im/myprofile_pro/Lobby](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/myprofile_pro/Lobby?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge) 
[![Deploy](https://img.shields.io/badge/heroku-deploy-BA55D3.svg)](https://heroku.com/deploy)

## Getting Started

  ["My Profile"](https://www.myprofile.pro/) is a project to goal of help people to create your professional web site and CV!
  
### Installing

  after to clone the project and configure the file : **app/config/parameters.yml** execute the command :

  ```
    docker run --name myprofile -p 5432:5432 -e POSTGRES_PASSWORD=myprofile -d postgres
  ```

  ```
  composer install
  ```

   ```
    bin/console assetic:dump
   ```
## License

  This project is licensed under the GPL-3.0 License - see the [LICENSE](LICENSE) file for details
