#!/bin/bash

set -x
set -e

. ~/.nvm/nvm.sh
. ~/.profile
. ~/.bashrc

echo start update source code

git pull

npm run build

echo finish update source code
