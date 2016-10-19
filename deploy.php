<?php

// All Deployer recipes are based on `recipe/common.php`.
require 'recipe/laravel.php';

set('writable_use_sudo', false);

// Define a server for deployment.
// Let's name it "prod" and use port 22.
server('prod', 'spaced.undefined.interhostsolutions.be', 22)
    ->user('staging')
    ->forwardAgent() // You can use identity key, ssh config, or username/password to auth on the server.
    ->stage('production')
    ->env('deploy_path', '/home/staging/domains/apps/foreseetv'); // Define the base path to deploy your project to.

// Specify the repository from which to download your project's code.
// The server needs to have git installed for this to work.
// If you're not using a forward agent, then the server has to be able to clone
// your project from this repository.
set('repository', 'git@github.com:SpacedBe/foreseetv-api.git');