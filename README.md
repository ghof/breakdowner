
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
git clone https://github.com/ghof/breakdowner.git
cd breakdowner
cp .env.example .env
```
- Run it with detached mode

```bash 
docker-compose up --build -d
./vendor/bin/sail -d
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

# Endpoints Samples

- Perform Breakdown API
```bash 
curl --request POST \
  --url http://localhost/api/breakdowns \
  --header 'accept: application/json' \
  --header 'authorization: Bearer YOUR_API_TOKEN_HERE' \
  --header 'content-type: application/json' \
  --data '{
     "starts_at": "2021-01-01T00:00:00",
     "ends_at": "2021-03-01T12:30:00",
     "time_expression": "2m,m,d,2h"
}'
```
the response should look something like.
```json
{
  "data": {
    "2m": 0,
    "m": 1,
    "d": 29,
    "2h": 6.25
  }
}
```
- Breakdowns History List API
```bash 
curl --request GET \
  --url 'http://localhost/api/breakdowns?starts_at=2021-01-01T00%3A00%3A00&ends_at=2021-03-01T12%3A30%3A00' \
  --header 'accept: application/json' \
  --header 'authorization: Bearer YOUR_TOKEN_HERE'
```
the response should look something like.
```json
{
  "data": [
    {
      "starts_at": "2021-01-01 00:00:00",
      "ends_at": "2021-03-01 12:30:00",
      "time_expression": "2m,m,d,2h",
      "breakdown_array": {
        "2m": 0,
        "m": 1,
        "d": 29,
        "2h": 6.25
      }
    }
  ],
  "links": {
    "first": "http:\/\/localhost\/api\/breakdowns?page=1",
    "last": "http:\/\/localhost\/api\/breakdowns?page=1",
    "prev": null,
    "next": null
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 1,
    "links": [
      {
        "url": null,
        "label": "&laquo; Previous",
        "active": false
      },
      {
        "url": "http:\/\/localhost\/api\/breakdowns?page=1",
        "label": "1",
        "active": true
      },
      {
        "url": null,
        "label": "Next &raquo;",
        "active": false
      }
    ],
    "path": "http:\/\/localhost\/api\/breakdowns",
    "per_page": 15,
    "to": 1,
    "total": 1
  }
}
```

# Notes

[Macros pattern](https://tighten.co/blog/the-magic-of-laravel-macros/) was used for the main function witch breakdown the interval given a time expression. It's extending the Carbon library with 2 new functions:
- breakdownDiffArray
- breakdownDiffJson

Check out [CarbonServiceProvider](https://github.com/ghof/breakdowner/blob/master/app/Providers/CarbonServiceProvider.php) for more details

#DEMO

The demo server can be found [here](http://149.202.41.71/).
Feel free to contact me for demo server client ID and secret at ghofrane.benhmida@gmail.com. 

#TODO

- Implement CI/CD using github actions.
- Setup production env.
- Improve the docker files to make the use of apache/ nginx.
- Commits on master should only be by merging PR's.
- demo branch will be used for the demo server.
- Create login/register forms.
- Registered users can manage clientIds and secrets.
- Create better API doc using swagger.
- Setup [Stile Ci](https://styleci.io/) for the project.
