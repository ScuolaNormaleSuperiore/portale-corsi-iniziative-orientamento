<html>
@include("includes.head")
<style>
    .py-5 {
        padding-top : 5px;
        padding-bottom : 5px;
    }
    .py-10 {
        padding-top : 10px;
        padding-bottom : 10px;
    }
    .pt-20 {
        padding-top : 10px;
    }
    .text-center {
        text-align: center;
    }
</style>
<body>
    <div class="text-center">
        <h3>{{$nome}}</h3>
    </div>

    @foreach($ingredienti as $ingrediente)
        <div class="py-5">
            {{$ingrediente['ingrediente_data']['nome']}}
        </div>
    @endforeach
    <div class="py-10">
        Lotto n: ________________________
    </div>
    <div class="py-10">
        Data:    ________________________
    </div>
    <div class="pt-20 text-center">
        <img src="data:image/png;base64,{{$qrcode}}">
    </div>
</body>

</html>

