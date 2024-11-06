if [ -z "$1" ]; then
    echo "-------------------------------------------"
    echo "ERRORE!!!! inserire la versione da rilasciare es: 1.0.2"
    echo "-------------------------------------------"
    exit;
fi
date=`date +%Y%m%d`
branchName="release/v"$1
#echo $1 A $cupparisMsg U $cupparisJSMsg
#exit

echo "--- new branch ---"
git checkout -b $branchName develop &&
#php artisan coreinstall:changeversion --branch=$branchName --appversion=$1 &&
git add . &&
git commit -am "switched to new "$branchName" branch" &&
git push -u origin $branchName

echo "switched to new "$branchName" branch"
