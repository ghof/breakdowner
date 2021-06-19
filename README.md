
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
- Run migrations and seeders.
seeders will create you a user with email: ghofrane@ekar.com and password=password.
it will also generate client ID and secret. 
```bash 
./vendor/bin/sail artisan migrate:refresh --seed
```
the output of this command will prompt you Client ID & Client secret they will be useful for authentication.

- Authentication
use postman or any http client you want to request an API token.
as shown with the below curl command.
```bash 
curl --request POST \
  --url http://localhost/oauth/token \
  --header 'accept: application/json' \
  --header 'content-type: application/json' \
  --data '{
 "grant_type": "client_credentials",
    "client_id": REPLACE_THIS_BY_THE_CLIENT_ID_DISPLAYED_WITH_MIGRATE_SEED_COMMAND,
    "client_secret" : "REPLACE_THIS_BY_THE_SECRET_DISPLAYED_WITH_MIGRATE_SEED_COMMAND",
	"username": "ghofrane@ekar.com",
    "password": "password",
    "scope": ""
}'
```
the response should look something like.
```json
{
  "token_type": "Bearer",
  "expires_in": 31536000,
  "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZDU0Njc4MmI5MzZiMmI0Y2EzYjJhODM3MWI4ODNhYWVhYjkxOGEwN2I4YTc3NDUxNmJhNzBkN2VlZTU1MGZkODk3ZWQ5NmFlNDUzYWUxMGYiLCJpYXQiOjE2MjQxMTI5NzMuOTExNDksIm5iZiI6MTYyNDExMjk3My45MTE0OTQsImV4cCI6MTY1NTY0ODk3My45MDUyOTEsInN1YiI6IiIsInNjb3BlcyI6W119.OYj1zkTYKTKguk66efzogAUA546_YfrmUi6mSaKA2sYKJlXqwNNAlPHBmyDh6RnVgehTiCgHSN4pfxZM9BevgQqpry3yzAEYoyu0GwN3mEshARvpQee51fojRJDcDQXxbjzZMBmk2nsCSyFDxSrA_Sb2ZyZdc7YB83CJ41I6v0E9osbM-B_L8ZdEusU_XYBttOpGJUaf05-0G1cpaQxDVlO-fBdUyQTWXseprnmxousHbvnccWNN6sMXO8-tznEXApG2sj2qsMcthdUO7kzHbnZehM9uAxwUbzWccAnkyP5cNz5Vfnx4AWERA314BfOEMT0oXruzNxMOFnDe5-sR7c1QsnZCVSyFldPKem7idyJEtc-N7vYkwGwKMdlDs8p_lHI_8lWEgP-QYdW2bqtRyyoBK0NUbi-oEEx-6HeW8X8erYgIf-Pqu_370GZojtuCqqoUh_kQ2hT6HMRTNg4ByzYKDgFaAh-6ONpKfinDJ_Ko0xzEkEzfPPtCgBtkYEE3-e9B1vK1JHQnk3VohLhweI-QSm56dw7crqRUdbWAEOsGgz6-w7XCzfy7-cDIqejJRzq52WWtWE5h6go9c6jIUOIseeMkbn7XH-xFy204_T_GjHeod7-8uj9ScfwGzVepKKHO64XRDZiA7LgOyb8xl2PXArqqst09CRasyyoXGVk"
}
```
you should send this access_token with all your requests to the API.


- Run tests

```bash 
./vendor/bin/sail test
```

# Notes
[Macros pattern](https://tighten.co/blog/the-magic-of-laravel-macros/) was used for the main function witch breakdown the interval given a time expression. It's extending the Carbon library with 2 new functions:
- breakdownDiffArray
- breakdownDiffJson

Check out CarbonServiceProvider for more details

    
https://docs.docker.com/engine/install/ubuntu/
https://docs.docker.com/compose/install/

git clone https://github.com/ghof/breakdowner.git


