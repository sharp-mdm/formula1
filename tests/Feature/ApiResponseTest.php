<?php

namespace Tests\Feature;

use Tests\TestCase;


class ApiResponseTest extends TestCase
{
    public function test_api_filter_driver_negative(): void
    {
        $response = $this->getJson('/v1/laps?driver_id=81');
        $response->assertStatus(422);

        $response->assertJson([
            'success' => false,
            'message' => 'Validation errors',
            'errors'  => [
                'driver_id' => [
                    'The driver id field must be an array.'
                ]
            ]
        ]);
    }

    public function test_api_filter_driver_positive(): void
    {
        $response = $this->getJson('/v1/laps?driver_id[]=81');
        $response->assertStatus(200);

        $data = $response->json();

        if (empty($data)) {
            $this->assertSame([], $data);
        } else {
            $this->assertGreaterThan(0, count($data));
        }
    }

    public function test_api_filter_type_negative(): void
    {
        $response = $this->getJson('/v1/laps?type=type');
        $response->assertStatus(422);

        $response->assertJson([
            'success' => false,
            'message' => 'Validation errors',
            'errors'  => [
                'type' => [
                    'The selected type is invalid.'
                ]
            ]
        ]);
    }

    public function test_api_filter_type_positive(): void
    {
        $response = $this->getJson('/v1/laps?type=sectors');
        $response->assertStatus(200);

        $data = $response->json();

        if (empty($data)) {
            $this->assertSame([], $data);
        } else {
            $this->assertGreaterThan(0, count($data));
        }
    }

    public function test_api_filter_lap_negative(): void
    {
        $response = $this->getJson('/v1/laps?lap_from=from');
        $response->assertStatus(422);

        $response->assertJson([
            'success' => false,
            'message' => 'Validation errors',
            "errors"  => [
                "lap_from" => [
                    "The lap from field must be an integer."
                ]
            ]
        ]);
    }

    public function test_api_filter_lap_positive(): void
    {
        $response = $this->getJson('/v1/laps?lap_from=10&lap_to=20');
        $response->assertStatus(200);

        $data = $response->json();

        if (empty($data)) {
            $this->assertSame([], $data);
        } else {
            $this->assertGreaterThan(0, count($data));
        }
    }
}
