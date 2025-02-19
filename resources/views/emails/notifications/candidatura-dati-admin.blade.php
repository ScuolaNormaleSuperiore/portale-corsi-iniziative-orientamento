
                <strong>Nome:</strong> {{$candidato->nome}}<br/>
                <strong>Cognome:</strong> {{$candidato->cognome}}<br/>
                <strong>Nazione:</strong> {{$candidato->nazione?->nome}}<br/>
                <strong>Provincia:</strong> {{$candidato->provincia?->nome}}<br/>
                <strong>Scuola di provenienza:</strong> {{$candidato->scuola ? $candidato->scuola->denominazione : $candidato->scuola_estera}}<br/>
                <strong>Classe:</strong> {{$candidato->classe}}<br/>
                <strong>Sezione:</strong> {{$candidato->sezione}}<br/>
                <strong>Email:</strong> {{$candidato->emails}}<br/>

