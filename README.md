## Formula 1 API

### Installation
**1)** Clone repo https://github.com/sharp-mdm/formula1.git

**2)** Copy `.env.example` to `.env` in project root.
- The behavior can be fine-tuned through environment variables.
   
  CHUNK_SIZE - The size of the parts into which the imported JSON is divided  

  IMPORT_API_URL - The API URL from which the data will be imported 

**3)** Run installation use command `make install`

- During installation check MySql storage and press enter.
- Wait installation process.
- Click link in CLI which will open browser page for make sure the application is running correctly.

**4)** After installation, use the commands `make up` and `make stop` to run or stop the project in the future.

**5)** You can trigger the import immediately using `make import`, no cron setup needed.

**6)** Run the tests using `make test`

### API Documentation

**Swagger API Documentation:** http://localhost/api/documentation

**OpenAPI Documentation:** http://localhost/docs?api-docs.json

### API Usage Examples
1) http://localhost/api/v1/laps?driver_ids[]=81

![](public/img/1.png )

2) http://localhost/api/v1/laps?driver_ids[]=81&driver_ids[]=10&driver_ids[]=30

![](public/img/2.png )

3) http://localhost/api/v1/laps?type=total (default behavior)

![](public/img/3.png )

4) http://localhost/api/v1/laps?type=sectors

![](public/img/4.png )

5) http://localhost/api/v1/laps?lap_from=10&lap_to=40

![](public/img/5.png )

6) http://localhost/api/v1/laps?lap_from=10&lap_to=40&type=sectors&driver_ids[]=81&driver_ids[]=10&driver_ids[]=30

![](public/img/6.png )
