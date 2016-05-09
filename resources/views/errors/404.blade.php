<!DOCTYPE html>
<html>
    <head>
        <title>Oh bother.</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">4.0.4</div>
                <div class="title">The force is strong with this one...</div>
                <div>
                    Or so we hoped. Simply, we can't find the page you are looking for. <br/><br/>
                    Click <a href="{{ route('front') }}" class="btn btn-primary">here</a>
                    to return to the homepage.
                </div>
            </div>
        </div>
    </body>
</html>
