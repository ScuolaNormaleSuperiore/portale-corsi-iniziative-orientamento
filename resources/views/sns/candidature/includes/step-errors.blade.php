{{--@dump($errors);--}}
@if ($errors->any())
    <div class="row mb-4">
        <div class="col-12">
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {!! $error !!}
                </div>
            @endforeach
        </div>
    </div>
@endif

