#!/bin/bash
branch=$(git branch | sed -n -e 's/^\* \(.*\)/\1/p')
version=$(echo $branch | cut -c9-)


#php artisan coreinstall:changeversion --branch=master &&
git commit -am "changed branch to master"
git push
git checkout master &&
git pull &&
git merge --no-ff $branch &&
git push
git tag -a $version -m "Versione "$version
git push origin $version
git checkout $branch
echo "finished branch "$branch" and merged to master with tag "$version