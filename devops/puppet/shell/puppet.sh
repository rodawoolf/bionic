#!/usr/bin/env bash

echo "Ensure puppet is installed"
if ! which puppet > /dev/null; then
    echo "Installing puppet"
    sudo apt-get install puppet -y
    echo "ensure puppet service is running"
    sudo puppet resource service puppet ensure=running enable=true
fi
