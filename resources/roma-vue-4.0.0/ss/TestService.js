const process = require('./Process');
const TestService = {
    do(client,message) {
        let action = message.action;
        switch (action) {
            case 'test-spawn':
                process.spawn(client,'ls',['-la'])
                return true;
            case 'test-exec':
                process.exec(client,'ls',['-la'])
                return true;
        }
        return false;
    }
}
module.exports = TestService;
