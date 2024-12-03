@include('candidature.form.select',['field' => 'gen1_titolo_studio_id','label' => 'Titolo di studio del genitore 2'])

@include('candidature.form.select',['field' => 'gen2_titolo_studio_id','label' => 'Titolo di studio del genitore 2'])

@include('candidature.form.select',['field' => 'gen1_professione_id','label' => 'Professione del genitore 1'])

@include('candidature.form.input-icon',[
    'field' => 'gen1_professione_altro','label' => 'Professione del genitore 1 (specificare se "Altro")',
    'cssForm' => 'd-none',
   ])

@include('candidature.form.select',['field' => 'gen2_professione_id','label' => 'Professione del genitore 2'])

@include('candidature.form.input-icon',['field' => 'gen2_professione_altro','label' => 'Professione del genitore 2 (specificare se "Altro")',
   'cssForm' => 'd-none',
   ])


<script>


    document.addEventListener("DOMContentLoaded", function () {
        var select = document.getElementById('gen1_professione_id');
        select.addEventListener('change', function (e,v) {
            var div = document.getElementById('form-group-candidature-gen1_professione_altro');
            if (e.target.value) {
                if (parseInt(e.target.value) ===  2)
                    div.classList.remove('d-none');
                else
                    div.classList.add('d-none');
            }
        })

        var select2 = document.getElementById('gen2_professione_id');
        select2.addEventListener('change', function (e,v) {
            var div = document.getElementById('form-group-candidature-gen2_professione_altro');
            if (e.target.value) {
                if (parseInt(e.target.value) ===  2)
                    div.classList.remove('d-none');
                else
                    div.classList.add('d-none');
            }
        })

    });
</script>