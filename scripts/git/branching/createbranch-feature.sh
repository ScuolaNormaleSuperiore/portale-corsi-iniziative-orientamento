if [ -z "$1" ]; then
    echo "-------------------------------------------"
    echo "ERRORE!!!! inserire il nome del branch feature"
    echo "-------------------------------------------"
    exit;
fi
date=`date +%Y%m%d`
branchName="feature/"$date"_"$1
#echo $1 A $cupparisMsg U $cupparisJSMsg
#exit

echo "--- new branch ---"
git checkout -b $branchName develop &&
#php artisan coreinstall:changeversion --branch=$branchName &&
git add . &&
git commit -am "switched to new "$branchName" branch" &&

if [ -z "$2" ]; then
    git push -u origin $branchName
fi

echo "switched to new "$branchName" branch"
