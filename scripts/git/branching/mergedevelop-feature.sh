#!/bin/bash
branch=$(git branch | sed -n -e 's/^\* \(.*\)/\1/p')
version=$(echo $branch | cut -c9-)

git checkout develop
git merge --no-ff $branch
echo "merge develop from release branch "$branch": check conflicts and run finishbranch-feature.sh"
