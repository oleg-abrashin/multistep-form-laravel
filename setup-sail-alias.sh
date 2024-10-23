#!/bin/bash

# Function to create Sail alias
create_sail_alias() {
    if ! grep -q "alias sail=" ~/.bashrc ~/.zshrc 2>/dev/null; then
        echo "Creating sail alias..."
        if [[ "$SHELL" == *"zsh"* ]]; then
            echo "alias sail='bash vendor/bin/sail'" >> ~/.zshrc
            source ~/.zshrc
        elif [[ "$SHELL" == *"bash"* ]]; then
            echo "alias sail='bash vendor/bin/sail'" >> ~/.bashrc
            source ~/.bashrc
        fi
        echo "Alias 'sail' created."
    else
        echo "Sail alias already exists."
    fi
}

# Detect OS and create the Sail alias
case "$(uname -s)" in
    Linux*)     create_sail_alias;;
    Darwin*)    create_sail_alias;;  # macOS
    CYGWIN*|MINGW*)
        echo "Windows detected, please add 'alias sail=\"bash vendor/bin/sail\"' manually to your shell profile.";
        ;;
    *)
        echo "Unsupported OS"; exit 1;;
esac
