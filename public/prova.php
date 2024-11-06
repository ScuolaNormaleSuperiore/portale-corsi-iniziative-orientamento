<html>
<head>
    <title>Test</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<button onclick="javascript:api()">api</button>

<script type="text/javascript">
    function api() {
        $.ajax({
            type:"POST",
            url:"https://api.livesignage.xyz/v2/museivolterra/actions/addVisit",
            data: {
                api_key: 'testvisit',
                id: 1743,
                data:{
                    nazionalita : 'ita',
                    provenienza : 'firenze',
                    target : 'famiglia',
                    numero : 2,
                    pernottamento : 'no',
                    museo: 'museo1'
                }
            }
        }).done(function(data){
            console.log(data);
        });
    }
</script>
</body>
</html>
