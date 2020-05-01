#!/usr/bin/env bash

WORKING_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
DEVOPS_PATH="$WORKING_DIR/devops"
NETWORK_NAME='urlshortener'

export DEVOPS_PATH
export NETWORK_NAME

includeBuild() {
    FILE="$DEVOPS_PATH/builder.sh"
    if [ ! -x "$FILE" ]; then
        echo "$FILE does not exist or is not executable"
        exit 1
    fi
    source "$FILE"
}

envVars() {
    source <(sed -E -n 's/[^#]+/export &/ p' .env)
}

COMMAND=$1
shift
includeBuild

case "$COMMAND" in
    env)
        cp ./env.example .env
        ;;
    up)
        envVars
        up "$@"
        ;;
    install)
        envVars
        install
        ;;
    down)
        envVars
        down
        ;;
    login)
        envVars
        login "$1"
        ;;
    build)
        envVars
        build "$@"
        ;;
esac
