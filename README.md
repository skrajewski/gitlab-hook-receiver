GitLab Hook Receiver 0.1.1
==================

Helper to GitLab hook services.

## What it is?
It's a simple set of class to help create GitLab POST Hook. At this moment it supports `Push Events`.

## How it works?
Imagine you have a project in VCS. Always when you push commits to the master branch your production server automatically pull all changes. Are you use composer? You can transfer special command through commit message to run `composer install` on production. See example.

###Example
```php
$directory = '/path/to/your/project/directory';

// Instance of Logger, in this case it's Monolog
$logger = new Logger("ON_PUSH", [new StreamHandler('hook.log')]);

// Create new Receiver and inject instance of Logger
$receiver = new GitLabRequestReceiver($logger);

// Set Gitlab POST data to Receiver Object
$receiver->prepareData(file_get_contents('php://input'));

// Add GitPullCommandListener to Receiver, argument is your git repository
// It automatically pull changes from current project branch
$receiver->addCommandListener(new GitPullCommandListener($directory));

// Add ComposerCommandListener to Receiver, argument is your project directory with composer.json file
// Now you can transfer composer action through commit message e.g. [composer:update]
$receiver->addCommandListener(new ComposerCommandListener($directory));

// Run all listeners
$receiver->run();
```
