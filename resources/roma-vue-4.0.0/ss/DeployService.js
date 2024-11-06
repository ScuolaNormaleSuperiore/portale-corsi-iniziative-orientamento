var conf = require('./conf');
const {spawn,execSync} = require("child_process");
var fs = require('fs');
const process = require("./Process");

const DeployService = {
    do(client,message) {
        let action = message.action;
        switch (action) {
            case 'publish':
                process.spawn(client,'sh',["deploy.sh"])
                return true;
            case 'translate':
                process.spawn(client,"sh",["deploy.sh","translate"])
                return true;
            case 'save-config':
                this.saveConfig(client,message.data);
                return true;
            case 'genera-templates':
                process.spawn(client,"sh",["deploy.sh","templates"])
                return true;
        }
        return false;
    },


    stream(command,client) {
        command.stdout.on("data", data => {
            console.log(`stdout: ${data}`);
            let out = {action : 'stdout', data : data.toString()};
            client.send(JSON.stringify(out));

        });

        command.stderr.on("data", data => {
            console.log(`stderr: ${data}`);
            let out = {action : 'stderr', data : data.toString()};
            client.send(JSON.stringify(out));
        });

        command.on('error', (error) => {
            console.log(`error: ${error.message}`);
            error.action = 'error';
            client.send(JSON.stringify(error));
        });

        command.on("close", code => {
            console.log(`child process exited with code ${code}`);
            client.send(JSON.stringify({close:code}));
        });
    },

    publish(client,clientData) {
        const publish = spawn("sh",["deploy.sh"])
        publish.stdout.on("data", data => {
            console.log(`stdout: ${data}`);
            let out = {action : 'stdout', data : data.toString()};
            client.send(JSON.stringify(out));

        });

        publish.stderr.on("data", data => {
            console.log(`stderr: ${data}`);
            let out = {action : 'stderr', data : data.toString()};
            client.send(JSON.stringify(out));
        });

        publish.on('error', (error) => {
            console.log(`error: ${error.message}`);
            error.action = 'error';
            client.send(JSON.stringify(error));
        });

        publish.on("close", code => {
            console.log(`child process exited with code ${code}`);
            client.send(JSON.stringify({close:code}));
        });

    },
    translate(client,metadata) {
        const translate = spawn("sh",["deploy.sh","translate"]);
        this.stream(translate,client);

        //console.debug('mv ', conf.LARAVELDIR + "public/js/\*\-translations.json",conf.WORKDIR + "crud/")
        //const mv = execSync("mv",['"' + conf.LARAVELDIR + 'public/js/\*\-translations.json" "' + conf.WORKDIR + 'crud/"']);
        //console.log('translate',translate.Buffer.toString())
        //metadata.resultCommand = translate.toString(); //JSON.parse(translate).data.toString();
        //client.send(JSON.stringify(metadata));
    },
    saveConfig(client,data) {
        var json = JSON.stringify(data);
        console.log('saveConfig',json);
        fs.writeFile('../src/data/template-config.json', json, 'utf8', function (err) {
            if (err) {
                console.error(err);
                let errObj = {action : 'stderr', data : data.toString()};
                client.send(JSON.stringify(errObj))
                return;
            };
            client.send(JSON.stringify({result:'ok'}))
        });
    },
    generateTemplates(client,data) {

    }
}

module.exports = DeployService;
