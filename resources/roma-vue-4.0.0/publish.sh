INCLUDE_DIR="../../resources/views/roma-vue/includes"
DASHBOARD="../../resources/views/roma-vue/dashboard.blade.php"
HTML_SOURCE="../../public/roma-vue/index.html"
mkdir -p ${INCLUDE_DIR}

echo "------------  build application in  ${INCLUDE_DIR} ---------------"
npm run build

echo "------------  sincronize public application ------------"
rsync -zvrah dist/* ../../public/roma-vue/

echo "------------  generazione head blade ------------"
echo "<head>\n" > ${INCLUDE_DIR}/head.blade.php
echo "<meta name="bearer-token" content="\{\{Session::get\(\'sanctum_token\'\)\}\}">\n" >> ${INCLUDE_DIR}/head.blade.php
#tr "\n" "|" < ${HTML_SOURCE} | grep -o '<head>.*</head>' >> ${INCLUDE_DIR}/head.blade.php
#tr "\n" "|" < ${HTML_SOURCE} | grep -o '<head>.*</head>' | sed -r 's/<script/\n <!-- /g'  | sed -r  's/<\/script>/ -->\n/g' >> ${INCLUDE_DIR}/head.blade.php
tr "\n" "|" < ${HTML_SOURCE} | grep -o '<head>.*</head>' | sed 's/\(<head>\|<\/head>\)//g;s/|/\n/g' >> ${INCLUDE_DIR}/head.blade.php
echo "</head>\n" >> ${INCLUDE_DIR}/head.blade.php

echo "------------  generazione dashboard blade ------------"
echo "@extends('app')\n" > ${DASHBOARD}
echo "@section('content')\n" >> ${DASHBOARD}
tr "\n" "|" < ${HTML_SOURCE} | grep -o '<body>.*</body>' | sed 's/\(<body>\|<\/body>\)//g;s/|/\n/g' >> ${DASHBOARD}
echo "@endsection\n" >> ${DASHBOARD}

