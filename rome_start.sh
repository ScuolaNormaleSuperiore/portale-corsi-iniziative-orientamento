#!/bin/bash

MODE=$1
# trap ctrl-c and call ctrl_c()
trap ctrl_c INT

function ctrl_c() {
        echo "** Trapped CTRL-C"
        pkill -P $$
}

cd resources/roma-vue-4.0.0/
if [ -z "$MODE" ]; then
    npx vite &
else
    echo "La MODE contiene: $MODE"
    ENV_FILE=".env.$MODE" npx vite &
fi

cd ss
npm start
