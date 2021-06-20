<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Breakdowner</title>

    <link rel="icon" href="favicon.ico" type="image/png" />

    <link href="https://fonts.googleapis.com/css?family=Reem+Kufi|Roboto:300" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" rel="stylesheet">
    <style>
        /* Minimal CSS Reset */

        html {
            box-sizing: border-box;
            font-size: 12px;
        }

        *, *:before, *:after {
            box-sizing: inherit;
        }

        body, h1, h2, h3, h4, h5, h6, p, ol, ul {
            margin: 0;
            padding: 0;
            font-weight: normal;
        }

        ol, ul {
            list-style: none;
        }

        img {
            max-width: 100%;
            height: auto;
        }
        /* Typography */

        html {
            font-family: 'Roboto', sans-serif;
        }

        @media (min-width: 576px) {
            html {
                font-size: 14px;
            }
        }

        @media (min-width: 768px) {
            html {
                font-size: 16px;
            }
        }

        @media (min-width: 992px) {
            html {
                font-size: 18px;
            }
        }

        @media (min-width: 1200px) {
            html {
                font-size: 20px;
            }
        }

        .icons-social i {
            font-size: 3em;
        }

        /* Custom Styles */

        main {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            justify-content: center;
            padding: 0 30px;
            text-align: center;
        }

        main > .intro {
            font-family: 'Reem Kufi', sans-serif;
            font-size: 3.75em;
            font-weight: 600;
        }

        main > .tagline {
            font-size: 1.5rem;
            margin: 1.5rem 0;
            font-weight: 100;
        }

        .icons-social i {
            padding: 10px;
        }

        .devto {
            margin-bottom: -0.20rem;
        }

        .devto svg {
            margin-bottom: -0.20rem;
            margin-left: 0.675rem;;
            width: 2.65rem;
            height: 2.65rem;
        }
        /* Theme */

        main {
            background: #FAFAFA;
            color: #0277BD;
        }

        .icons-social a {
            color: #0277BD;
        }

        .icons-social a svg path{
            fill: #0277BD;
        }
    </style>
</head>
<body>
<main>
    <div class="intro">Breakdowner !</div>
    <div class="tagline">Breakdowner is an API that expose an endpoint that accepts two timestamps and a list of time expressions, and returns a breakdown of the duration between the two timestamps using the given time expressions. The application keep track of all the breakdowns executed. It also exposes Another endpoint to search these stored breakdowns by the input timestamps.</div>
    <div class="icons-social">
        <a target="_blank" href="https://github.com/ghof/breakdowner"><i class="fab fa-github"></i></a>
    </div>
</main>
</body>
</html>
