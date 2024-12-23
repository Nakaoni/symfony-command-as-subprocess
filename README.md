# Symfony Command as Subprocess

This repository is a proof of concept to run a command (or multiple commands) asynchronously as subprocess.

## Commands

### PrintCommand

> Wait between 1 and 3 seconds then print a random number between 1 to 1000

```sh
php app.php app:print
```

### ProcessCommand

> Runs the `PrintCommand` X number of times

```sh
php app.php app:process [times]
```

