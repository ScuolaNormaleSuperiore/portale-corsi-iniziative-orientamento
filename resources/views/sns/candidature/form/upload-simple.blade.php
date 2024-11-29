@php
    $fieldData = \Illuminate\Support\Arr::get($sectionData['fields'],$field,[]);
    $validation = \Illuminate\Support\Arr::get($fieldData,'validation',[]);
    $value = \Illuminate\Support\Arr::get($fieldData,'value',old($field));
@endphp

<input type="file" name="{{$field}}" id="{{$field}}" class="upload" multiple="multiple"/>
<label for="{{$field}}">
    <svg class="icon icon-sm" aria-hidden="true">
        <use href="{{Theme::url('svg/sprites.svg')}}#it-upload"></use>
    </svg>
    <span>Carica file</span>
</label>

<ul class="upload-file-list" id="upload-file-list-candidatura-{{$field}}">
{{--    <li class="upload-file success">--}}
{{--        <svg class="icon icon-sm" aria-hidden="true">--}}
{{--            <use href="{{Theme::url('svg/sprites.svg')}}#it-file"></use>--}}
{{--        </svg>--}}
{{--        <p>--}}
{{--            <span class="visually-hidden">File caricato:</span>--}}
{{--            nome-file-01.pdf <span class="upload-file-weight">68 MB</span>--}}
{{--        </p>--}}
{{--        <button>--}}
{{--            <span class="visually-hidden">Elimina file caricato nome-file-04.jpg</span>--}}
{{--            <svg class="icon" aria-hidden="true">--}}
{{--                <use href="{{Theme::url('svg/sprites.svg')}}#it-close"></use>--}}
{{--            </svg>--}}
{{--        </button>--}}

{{--    </li>--}}
{{--    <li class="upload-file error">--}}
{{--        <svg class="icon icon-sm" aria-hidden="true">--}}
{{--            <use href="{{Theme::url('svg/sprites.svg')}}#it-file"></use>--}}
{{--        </svg>--}}
{{--        <p>--}}
{{--            <span class="visually-hidden">Errore caricamento file:</span>--}}
{{--            nome-file-04.jpg <span class="upload-file-weight"></span>--}}
{{--        </p>--}}
{{--        <button>--}}
{{--            <span class="visually-hidden">Elimina file caricato nome-file-04.jpg</span>--}}
{{--            <svg class="icon" aria-hidden="true">--}}
{{--                <use href="{{Theme::url('svg/sprites.svg')}}#it-close"></use>--}}
{{--            </svg>--}}
{{--        </button>--}}
{{--    </li>--}}
</ul>

<svg class="d-none icon icon-sm" aria-hidden="true" id="svg-{{$field}}">
    <use href="{{Theme::url('svg/sprites.svg')}}#it-file"></use>
</svg>

<svg class="d-none icon icon-sm" aria-hidden="true" id="svg-close-{{$field}}">
    <use href="{{Theme::url('svg/sprites.svg')}}#it-close"></use>
</svg>

<script>


    {{--<button>--}}
    {{--    <span class="visually-hidden">Elimina file caricato nome-file-04.jpg</span>--}}
    {{--    <svg class="icon" aria-hidden="true">--}}
    {{--        <use href="{{Theme::url('svg/sprites.svg')}}#it-close"></use>--}}
    {{--    </svg>--}}
    {{--</button>--}}

    document.addEventListener("DOMContentLoaded", function () {
        var inputFile = document.getElementById('{{$field}}');
        inputFile.addEventListener('change', function (e, v) {
            var uploadList = document.getElementById('upload-file-list-candidatura-{{$field}}');
            uploadList.innerHTML = '';

            let formData = new FormData();
            formData.append("file", inputFile.files[0]);
            var token = document.getElementsByName('_token')[0];
            console.log("TOKEN", token);
            formData.append("_token", token.value);
            formData.append("field", 'attachments|resource');
            axios.post('/foormaction/uploadfile/candidato/edit/{{$candidatura->getKey()}}', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(
                function (j) {

                    console.log("RESULT:::", j);
                    var json = j.data;
                    var res = json.result;
                    const dFrag = document.createDocumentFragment();

                    const li = document.createElement('li');
                    li.classList.add('upload-file', 'success')
                    li.id = res.id;

                    let svg = document.getElementById('svg-{{$field}}').cloneNode(true);
                    svg.classList.remove('d-none');
                    li.appendChild(svg);

                    const p = document.createElement('p');
                    p.innerHTML = '<span class="visually-hidden">File caricato:</span>' +
                        res.filename + '<span class="upload-file-weight">' + res.dim + '</span>';

                    li.appendChild(p);

                    const button = document.createElement('button');
                    button.innerHTML =
                        '<span class="visually-hidden">Elimina file caricato ' + res.filename + '</span>';
                    button.setAttribute('type','button');

                    let svgClose = document.getElementById('svg-close-{{$field}}').cloneNode(true);
                    svgClose.classList.remove('d-none');
                    button.appendChild(svgClose);

                    li.appendChild(button);
                    dFrag.appendChild(li);

// Add fragment to a list:
                    uploadList.appendChild(dFrag);

                    console.log("FILE SUCCESS", j);
                }).catch(function (e) {
                console.log("FILE ERROR", e);
            });
        })
    })

</script>