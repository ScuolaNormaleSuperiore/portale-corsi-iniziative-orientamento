<p><button type="button" class="btn btn-primary" onClick="testAnimation()">Simula Upload</button></p>

    <div class="upload-dragdrop-image">
        <img src="{{Theme::url('assets/upload-drag-drop-icon.svg')}}" alt="descrizione immagine" aria-hidden="true">
        <div class="upload-dragdrop-loading">
            <div class="progress-donut" data-bs-progress-donut></div>
        </div>
        <div class="upload-dragdrop-success">
            <svg class="icon" aria-hidden="true"><use href="{{Theme::url('svg/sprites.svg')}}#it-check"></use></svg>
        </div>
    </div>
    <div class="upload-dragdrop-text">
        <p class="upload-dragdrop-weight">
            <svg class="icon icon-xs" aria-hidden="true"><use href="{{Theme::url('svg/sprites.svg')}}#it-file"></use></svg> PDF (3.7MB)
        </p>
        <h5 id="simTitle">Trascina il file per caricarlo</h5>
        <p id="simText">oppure <input type="file" name="upload8" id="upload8" class="upload-dragdrop-input" /><label for="upload8">selezionalo dal dispositivo</label></p>
    </div>
    <input value="Submit" type="submit" class="d-none" />

<script>
    //attiva tooltip esempio loading
    function testAnimation() {
        var element = bootstrap.UploadDragDrop.getOrCreateInstance(document.getElementById('candidaturaForm'));
        var title = document.getElementById('simTitle')
        var text = document.getElementById('simText')

        element.start();
        title.innerText = 'nome_file.pdf';
        text.innerText = 'Caricamento in corso...';

        setTimeout(function() {
            element.progress(0.33)
        }, 1000);

        setTimeout(function(){
            element.progress(0.66)
        }, 2000);

        setTimeout(function(){
            element.progress(0.99)
        }, 3000);

        setTimeout(function(){
            element.success()
            text.innerText = 'Caricamento completato'
        }, 4500);
    }
</script>