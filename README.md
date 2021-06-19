
# Breakdowner

Breakdowner is an API that expose an endpoint that accepts two timestamps and a
list of time expressions, and returns a breakdown of the duration between the two timestamps
using the given time expressions. The application keep track of all the breakdowns
executed. It also exposes Another endpoint to search these
stored breakdowns by the input timestamps.
# Requirements
The project uses [Laravel framework](https://laravel.com/) and [Sail](https://laravel.com/docs/8.x/sail) that provides a Docker powered local development experience that is compatible with macOS, Windows (WSL2), and Linux. Other than Docker, no software or libraries are required to be installed on your local computer before using Breakdowner.
# Installation 

- Clone this project

```bash 
git clone http://......
cd breakdowner
```
- Run it with detached mode

```bash 
./vendor/bin/sail up -d
```
- Open browser on http://localhost
- Run tests

```bash 
./vendor/bin/sail test
```
# Notes
[Macros pattern](https://tighten.co/blog/the-magic-of-laravel-macros/) was used for the main function witch breakdown the interval given a time expression. It's extending the Carbon library with 2 new functions:
- breakdownDiffArray
- breakdownDiffJson

Check out CarbonServiceProvider for more details

    
