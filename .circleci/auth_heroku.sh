#!/bin/bash

cat > ~/.netrc <<EOF
machine api.heroku.com
    login ${1}
    password ${2}
machine git.heroku.com
    login ${1}
    password ${2}
EOF
chmod 600 ~/.netrc
