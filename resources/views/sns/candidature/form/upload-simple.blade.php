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

    @foreach($candidatura->attachments as $attachment)
    <li class="upload-file success">
        <svg class="icon icon-sm" aria-hidden="true">
            <use href="{{Theme::url('svg/sprites.svg')}}#it-file"></use>
        </svg>
        <p>
            <span class="visually-hidden">File caricato:</span>
            {{$attachment->nome}} <span class="upload-file-weight">{{$attachment->dim}}</span>
        </p>
        <button type="button" class="remove-attachment">
            <span class="visually-hidden">Elimina file caricato {{$attachment->dim}}</span>
            <svg class="icon" aria-hidden="true">
                <use href="{{Theme::url('svg/sprites.svg')}}#it-close"></use>
            </svg>
        </button>
        <input type="hidden" name="attachments-id[]" value="{{$attachment->id}}"/>
        <input type="hidden" name="attachments-status[]" value=""/>
        <input type="hidden" name="attachments-resource[]" value="{{json_encode($attachment->resource)}}"/>
        <input type="hidden" name="attachments-nome[]" value="{{$attachment->nome}}"/>

    </li>
    @endforeach
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

        var removeButtons = document.querySelectorAll('.remove-attachment');
        if (removeButtons.length > 0) {
            for (var i in removeButtons) {
                (removeButtons.item(i)).addEventListener('click', function (e) {
                    removeAttachment(e.target)
                });
            }
        }

        var inputFile = document.getElementById('{{$field}}');
        inputFile.addEventListener('change', function (e, v) {
            var uploadList = document.getElementById('upload-file-list-candidatura-{{$field}}');
            // uploadList.innerHTML = '';

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
            }).then(function (j) {

                console.log("RESULT:::", j);
                var json = j.data;
                var res = json.result;


                const dFrag = createUploadAttachment(res);

                uploadList.appendChild(dFrag);

                console.log("FILE SUCCESS", j);
            }).catch(function (e) {
                console.log("FILE ERROR", e);
            });
        })

        function createUploadAttachment(json, id) {
            const dFrag = document.createDocumentFragment();

            const li = document.createElement('li');
            li.classList.add('upload-file', 'success')
            li.id = json.id;

            let svg = document.getElementById('svg-{{$field}}').cloneNode(true);
            svg.classList.remove('d-none');
            li.appendChild(svg);

            const p = document.createElement('p');
            p.innerHTML = '<span class="visually-hidden">File caricato:</span>' +
                json.filename + '<span class="upload-file-weight">' + json.dim + '</span>';

            li.appendChild(p);

            const button = document.createElement('button');
            button.innerHTML =
                '<span class="visually-hidden">Elimina file caricato ' + json.filename + '</span>';
            button.setAttribute('type', 'button');

            let svgClose = document.getElementById('svg-close-{{$field}}').cloneNode(true);
            svgClose.classList.remove('d-none');
            button.appendChild(svgClose);

            li.appendChild(button);
            dFrag.appendChild(li);

            let input1 = document.createElement('input');
            input1.setAttribute('name', 'attachments-id[]');
            input1.setAttribute('type', 'hidden');
            if (id) {
                input1.value = id;
            }
            let input2 = document.createElement('input');
            input2.setAttribute('name', 'attachments-status[]');
            input2.setAttribute('type', 'hidden');
            input2.value = 'created';
            let input3 = document.createElement('input');
            input3.setAttribute('name', 'attachments-resource[]');
            input3.value = JSON.stringify(json);
            input3.setAttribute('type', 'hidden');
            let input4 = document.createElement('input');
            input4.setAttribute('name', 'attachments-nome[]');
            input4.setAttribute('type', 'hidden');
            input4.value = json.filename;

            li.appendChild(input1);
            li.appendChild(input2);
            li.appendChild(input3);
            li.appendChild(input4);

            button.addEventListener('click', function (e) {
                removeAttachment(e.target)
            });

            return dFrag;
        }

        function removeAttachment(el) {
            var li = el.closest('li');
            li.remove();
        }
    })

</script>