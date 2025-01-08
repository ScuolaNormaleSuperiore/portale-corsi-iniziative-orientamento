import cupparisPrimevue from 'cupparis-primevue';

export default {
    inject: ['store'],
    install() {
        let routes = cupparisPrimevue.routeConfs;
        let prefix = ''; //cupparisSakai.CrudVars.useApi?'/api':''
        routes['menu'] = {
            url: prefix + '/crud/menu',
            method: 'get',
            resultType: 'list',
            protocol: 'record'
        }

        routes['csv-exporta'] = {
            url: prefix + '/foormaction/csv-export/{foorm}/{foormtype}', // {foormpk?}',
            method: 'post',
            resultType: 'record'
        }

        routes['pdf-exporta'] = {
            url: prefix + '/foormaction/pdf-export/{foorm}/{foormtype}', // {foormpk?}',
            method: 'post',
            resultType: 'record'
        }

        routes['xls-exporta'] = {
            url: prefix + '/foormaction/xls-export/{foorm}/{foormtype}', // {foormpk?}',
            method: 'post',
            resultType: 'record'
        }
        routes['media-export'] = {
            url: prefix + '/foormaction/media-download/{foorm}/{foormtype}/{foormpk}', // {foormpk?}',
            method: 'post',
            resultType: 'record'
        }

        routes['multi-delete'].url = '/foormaction/multi-delete/{modelName}/list'
        routes['uploadfile'].url = '/foormaction/uploadfile/{modelName}/edit'

        routes.set.url = '/foormaction/set/{modelName}/list'

        routes['autocomplete'].url = '/foormaction/autocomplete/{foormName}/{viewType}'
        routes['autocomplete'].method = 'post'

        routes['list-constraint'] = {
            url: prefix + '/foormc/{modelName}/{constraintKey}/{constraintValue}',
            resultType: 'list',
            protocol: 'list',
            method: 'get'
        }

        routes['edit-constraint'] = {
            url: prefix + '/foormc/{modelName}/{pk}/edit/{constraintKey}/{constraintValue}',
            resultType: 'record',
            protocol: 'record',
            method: 'get'
        }

        routes['insert-constraint'] = {
            url: prefix + '/foormc/{modelName}/new/{constraintKey}/{constraintValue}',
            resultType: 'record',
            protocol: 'record',
            method: 'get'
        }

        routes['wizard'] = {
            url: prefix + '/test-passo/{passo}',
            method: 'get',
            type: 'record',
            protocol: 'record'
        }


        // routes['list'].url =              '/api/foorm/{modelName}'
        // routes['uploadfile'].url =        '/api/uploadfile'
        // routes['upload'].url =            '/api/upload'
        // routes['insert'].url =            '/api/foorm/{modelName}/new'
        // routes['edit'].url =              '/api/foorm/{modelName}/{pk}/edit'
        //
        // routes['update'].url =            '/api/foorm/{modelName}/{pk}'
        // routes['create'].url =            '/api/foorm/{modelName}'
        //
        // routes['search'].url =            '/api/foorm/{modelName}/search'
        // routes['view'].url =              '/api/foorm/{modelName}/{pk}/view'
        // routes['delete'].url =            '/api/foormaction/{modelName}/list'
        // routes['multi-delete'].url =      '/api/foorm/{modelName}/multi-delete'
        //
        // routes['autocomplete'].url =      '/api/foormaction/autocomplete/{foormName}/{viewType}'
        // routes['set'].url =               '/api/foormaction/set/{modelName}/list'
        //
        // routes['pages'].url =             '/crud/page/{path}'
        //
        // routes['load_datafile'].url =     '/api/queue/add/datafile/load';
        // routes['status_queue'].url =      '/api/queue/status/{id}';
        // routes['status-queue'].url =      '/api/queue/status/{id}';
        // routes['add-queue'].url =         '/api/queue/add/{queueName}';
        // routes['save_datafile'].url =     '/api/queue/add/datafile/save';
        // routes['datafile_data'].url =     '/api/foormc/{modelName}/datafile_id/{jobId}';
        // routes['datafile_insert'].url =   '/api/foorm/{modelName}/new';
        // routes['datafile_import'].url =   '/api/foorm/{modelName}/import/{jobId}';
        //console.log('api routes',routes);
    }
}

