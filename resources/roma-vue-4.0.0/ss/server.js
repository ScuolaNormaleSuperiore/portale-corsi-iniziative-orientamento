const WebSocket = require('ws');
const wss = new WebSocket.Server({ port: 7071 });
const clients = new Map();
const { exec, spawn, execSync} = require("child_process");
let tmp = execSync('pwd').toString();
tmp = tmp.substring(0,tmp.length -1);
const path = tmp;
tmp = execSync('which sh').toString();
tmp = tmp.substring(0,tmp.length -1);
const SH = tmp;
const projectDir = path + '/..';

const ModelService = require("./ModelService");
const DeployService = require('./DeployService');
const TestService = require('./TestService');
const ConfigService = require('./ConfigService');

const conf = require('./conf');
wss.on('connection', (ws) => {
    const id = uuidv4();
    const color = Math.floor(Math.random() * 360);
    const metadata = { id, color};
    const services = [DeployService,ModelService,ConfigService,TestService]; //[ModelService,DeployService,TestService];

    clients.set(ws, metadata);
    console.log('metadata',clients.values())
    ws.on('message', (messageAsString) => {
        const message = JSON.parse(messageAsString);
        console.log('message',messageAsString)
        let client = Array.from(clients.keys())[0];
        const metadata = clients.get(ws);
        for(let i in services) {
            let service = services[i];
            if (service.do(client,message)) {
                return ;
            }
        }
        const outbound = JSON.stringify({
            error : true,
            msg : 'action ' + message.action + ' not found'
        });
        client.send(outbound)


        //
        // switch (message.action) {case 'list-models':
        //         message.result = ModelService.list();
        //         break;
        //     case 'load-model':
        //         message.result = btoa(ModelService.read(message.modelName));
        //         break;
        //     case 'load-template-conf':
        //         message.result = btoa(ModelService.readTemplate(message.confName));
        //         break;
        //     case 'save-model':
        //         ModelService.put(message.filename,atob(message.body));
        //         ModelService.generateImport();
        //         message.result = 'ok';
        //         break;
        //     case 'publish':
        //         message.result = message.action + ' action trovata';
        //         DeployService.publish(client,metadata);
        //         break;
        //     case 'translate':
        //         message.result = message.action + ' action trovata';
        //         DeployService.translate(client,message);
        //         break;
        //     case 'generate-import':
        //         ModelService.generateImport();
        //         message.result = 'ok';
        //         break;
        //     case 'save-config':
        //         DeployService.saveConfig(client,message.data);
        //         break;
        //     case 'genera-templates':
        //         DeployService.generaTemplates(client,message.data);
        //         break;
        //     default:
        //         message.result = message.action + " -> action non trovata"
        // }
      // message.sender = metadata.id;
      // message.color = metadata.color;
      // const outbound = JSON.stringify(message);
      //
      //   [...clients.keys()].forEach((client) => {
      //     client.send(outbound);
      //   });
    });

    ws.on("close", () => {
        clients.delete(ws);
    });

});


function uuidv4() {
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
      var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
      return v.toString(16);
    });
}

function getByValue(map, searchValue) {
    for (let [key, value] of map.entries()) {
        if (value.id === searchValue)
            return key;
    }
}
console.log("wss up2",path);

setInterval(function() {
    let outbound = JSON.stringify({
      channel : "ping",
      number : Math.floor(Math.random() * 1000),
    });
    console.log('ping2');
    [...clients.keys()].forEach((client) => {
      client.send(outbound);
    });
},5000)


