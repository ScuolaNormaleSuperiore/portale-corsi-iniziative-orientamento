const {spawn, execSync} = require("child_process");
const Process = {
    spawn(client,command,options) {
        const publish = spawn(command,options)
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
    exec(client,command,options) {
        const publish = execSync(command,options);
        let out = {action : 'stdout', data : publish.toString()};
        client.send(JSON.stringify(out));

        // publish.stdout.on("data", data => {
        //     console.log(`stdout: ${data}`);
        //     let out = {action : 'stdout', data : data.toString()};
        //     client.send(JSON.stringify(out));
        //
        // });
        //
        // publish.stderr.on("data", data => {
        //     console.log(`stderr: ${data}`);
        //     let out = {action : 'stderr', data : data.toString()};
        //     client.send(JSON.stringify(out));
        // });
        //
        // publish.on('error', (error) => {
        //     console.log(`error: ${error.message}`);
        //     error.action = 'error';
        //     client.send(JSON.stringify(error));
        // });
        //
        // publish.on("close", code => {
        //     console.log(`child process exited with code ${code}`);
        //     client.send(JSON.stringify({close:code}));
        // });

    }
}

module.exports = Process;
