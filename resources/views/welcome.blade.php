<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body>

<div style="width: 45%; margin: auto">
    <h1> Welcome to Formula 1 API</h1>

    <p><b>Swagger API Documentation:</b> <a href="http://localhost/api/documentation">http://localhost/api/documentation</a></p>
    <p><b>OpenAPI Documentation:</b> <a href="http://localhost/docs?api-docs.json">http://localhost/docs?api-docs.json</a></p>

    <h4>API Usage Examples:</h4>
    <a href="http://localhost/api/v1/laps?driver_ids[]=81">http://localhost/api/v1/laps?driver_ids[]=81</a>
    <br/>
    <a href="http://localhost/api/v1/laps?driver_ids[]=81&driver_ids[]=10&driver_ids[]=30">http://localhost/api/v1/laps?driver_ids[]=81&driver_ids[]=10&driver_ids[]=30</a>
    <br/>
    <a href="http://localhost/api/v1/laps?type=total">http://localhost/api/v1/laps?type=total (default behavior)</a>
    <br/>
    <a href="http://localhost/api/v1/laps?type=sectors">http://localhost/api/v1/laps?type=sectors</a>
    <br/>
    <a href="http://localhost/api/v1/laps?lap_from=10&lap_to=40">http://localhost/api/v1/laps?lap_from=10&lap_to=40</a>
    <br/>
    <a href="http://localhost/api/v1/laps?lap_from=10&lap_to=40&type=sectors&driver_ids[]=81&driver_ids[]=10&driver_ids[]=30">http://localhost/api/v1/laps?lap_from=10&lap_to=40&type=sectors&driver_ids[]=81&driver_ids[]=10&driver_ids[]=30</a>
</div>

</body>
</html>
