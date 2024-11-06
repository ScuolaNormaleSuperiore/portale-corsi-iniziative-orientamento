var fs = require("file-system");
var conf = require('./conf');
const process = require("./Process");
const ModelService = {
    do(client,message) {
        let action = message.action;
        switch (action) {
            case 'list-models':
                message.result = this.list();
                client.send(JSON.stringify(message));
                return true;
            case 'load-model':
                message.result = btoa(this.read(message.modelName));
                client.send(JSON.stringify(message));
                return true;
            case 'load-template-conf':
                message.result = btoa(this.readTemplate(message.confName));
                client.send(JSON.stringify(message));
                return true;
            case 'save-model':
                this.put(message.filename,atob(message.body));
                this.generateImport();
                message.result = 'ok';
                client.send(JSON.stringify(message));
                return true;
            case 'generate-import':
                this.generateImport();
                message.result = 'ok';
                client.send(JSON.stringify(message));
                return true;
        }
        return false;
    },


    list() {
        let deploy = fs.readFileSync(conf.WORKDIR+'data/modelsConfs/app/deploy.json',
            { encoding: 'utf8', flag: 'r' });
        deploy = JSON.parse(deploy);
        return deploy;
    },
    put(filename,body) {
        try {
            console.log('put',filename);
            fs.writeFileSync(conf.WORKDIR+'data/modelsConfs/app/' + filename + '.js',
                    body, function(err) {})
            let deploy = fs.readFileSync(conf.WORKDIR+'data/modelsConfs/app/deploy.json',
                { encoding: 'utf8', flag: 'r' });
            deploy = JSON.parse(deploy);
            if (deploy.enabled.indexOf(filename) < 0) {
                deploy.enabled.push(filename)
            }

            fs.writeFileSync(conf.WORKDIR+'data/modelsConfs/app/deploy.json',
                JSON.stringify(deploy), function(err) {})
        } catch (e) {
            throw e;
            // response.writeHead(404, {"Content-Type": "text/json"});
            // response.write(e);
            // response.end();
        }
    },
    read(modelName) {
        console.debug('read file ',conf.WORKDIR+'data/modelsConfs/app/' + modelName + '.js')
        let data = fs.readFileSync(conf.WORKDIR+'data/modelsConfs/app/' + modelName + '.js',
            { encoding: 'utf8', flag: 'r' });
        return data || '';
    },
    readTemplate(templateName) {
        console.debug('read file ',conf.WORKDIR+'data/modelsConfs/templates/' + templateName + '.js')
        let data = fs.readFileSync(conf.WORKDIR+'data/modelsConfs/templates/' + templateName + '.js',
            { encoding: 'utf8', flag: 'r' });
        return data || '';
    },
    generateImport() {
        let indexTemplate = fs.readFileSync(conf.WORKDIR+'data/modelsConfs/app/index.js.template',
            { encoding: 'utf8', flag: 'r' });
        let deploy = fs.readFileSync(conf.WORKDIR+'data/modelsConfs/app/deploy.json',
            { encoding: 'utf8', flag: 'r' });
        deploy = JSON.parse(deploy);
        let importBody = ""
        let installBody = "";
        for (let i in deploy.enabled) {
            // import ModelUser from './ModelUser.js'
            let modelName = deploy.enabled[i];
            importBody += `import ${modelName} from './${modelName}.js';\n`;
            installBody += `cs.CrudVars.modelConfs.${modelName} = ${modelName};\n`;
        }
        indexTemplate = indexTemplate.replace('{importModels}',importBody);
        indexTemplate = indexTemplate.replace('{installModels}',installBody);
        fs.writeFileSync(conf.WORKDIR+'data/modelsConfs/app/index.js',
            indexTemplate, function(err) {})
    }
}

module.exports = ModelService;
