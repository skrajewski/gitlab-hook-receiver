GitLab Hook Receiver
==================

Helper to GitLab hook services.

###Example
===================
```php
$logger = new Logger("ON_PUSH", [new StreamHandler('hook.log')]);

// Inject instance of Logger
$receiver = new GitLabRequestReceiver($logger);

// Set Gitlab POST data to Receiver Object
$receiver->prepareData(file_get_contents('php://input'));

// Add command listener for composer. You can pass composer action by the commit message e.g. [composer:update]
$receiver->addCommandListener(new ComposerCommandListener);

// Run all listeners
$receiver->run();
```
