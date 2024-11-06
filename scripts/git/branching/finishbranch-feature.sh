#!/bin/bash
branch=$(git branch | sed -n -e 's/^\* \(.*\)/\1/p')

#php artisan coreinstall:changeversion --branch=develop &&
git commit -am "changed to branch develop"
git push

if [ "$1" = "d" ]; then
    git branch -d $branch
fi

echo "finished branch "$branch" and merged to develop"
