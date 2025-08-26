<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body>

<div style="width: 40%; margin: auto">
    <h1> Welcome to Formula 1 API</h1>

    <h4>API REQUESTS EXAMPLES:</h4>
    <a href="http://localhost/v1/laps?driver_id[]=81">http://localhost/v1/laps?driver_id[]=81</a>
    <br/>
    <a href="http://localhost/v1/laps?driver_id[]=81&driver_id[]=10&driver_id[]=30">http://localhost/v1/laps?driver_id[]=81&driver_id[]=10&driver_id[]=30</a>
    <br/>
    <a href="http://localhost/v1/laps?type=total">http://localhost/v1/laps?type=total (default behavior)</a>
    <br/>
    <a href="http://localhost/v1/laps?type=sectors">http://localhost/v1/laps?type=sectors</a>
    <br/>
    <a href="http://localhost/v1/laps?lap_from=40&lap_to=80">http://localhost/v1/laps?lap_from=40&lap_to=80</a>
    <br/>
    <a href="http://localhost/v1/laps?lap_from=10&lap_to=40&type=sectors&driver_id[]=87&driver_id[]=23&driver_id[]=5">http://localhost/v1/laps?lap_from=10&lap_to=40&type=sectors&driver_id[]=87&driver_id[]=23&driver_id[]=5</a>
</div>

</body>
</html>
