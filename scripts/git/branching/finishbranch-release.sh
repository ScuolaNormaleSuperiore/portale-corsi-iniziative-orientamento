#!/bin/bash
#php artisan coreinstall:changeversion --branch=develop &&
git add . &&
git commit -am "return to develop from release changing version" &&
git push

echo "return to develop from branch "$branch