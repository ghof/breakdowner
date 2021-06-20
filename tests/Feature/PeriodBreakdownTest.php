<?php

namespace Tests\Feature;

use App\Models\Breakdown;
use Carbon\Carbon;
use Database\Seeders\BreakdownSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Passport\Client;
use Laravel\Passport\Passport;
use Tests\TestCase;

class PeriodBreakdownTest extends TestCase
{
    use RefreshDatabase;

    public function testBreakdownDiffArrayAndJson()
    {
        $start = Carbon::parse('2021-01-01T00:00:00');
        $end = Carbon::parse('2021-03-01T12:30:00');
        $timeExpressions = '2m,m,d,2h';
        $array = $start->breakdownDiffArray($end, $timeExpressions);
        $json = $start->breakdownDiffJson($end, $timeExpressions);
        $expected = [
            '2m' => 0,
            'm' => 1,
            'd' => 29,
            '2h' => 6.25
        ];
        $this->assertJsonStringEqualsJsonString(collect($expected)->toJson(), $json);
        $this->assertEquals($expected, $array);
    }
    public function testBreakdownsCanBeCreated()
    {
        $this->seed(BreakdownSeeder::class);
        $this->assertDatabaseCount(Breakdown::class, 10);
    }

    public function testApiStoreBreakdownValidations()
    {
        Passport::actingAsClient(Client::factory()->create());
        $response = $this->post("/api/breakdowns", [
            'starts_at' => '',
            'ends_at' => '',
            'time_expression' => ''
        ]);
        $response->assertSessionHasErrors();
        $response = $this->post("/api/breakdowns", [
            'starts_at' => '2021-01-01T00:00:00',
            'ends_at' => '',
            'time_expression' => ''
        ]);
        $response->assertSessionHasErrors();
        $response = $this->post("/api/breakdowns", [
            'starts_at' => '2021-01-01T00:00:00',
            'ends_at' => '2021-03-01T00:00:00',
            'time_expression' => ''
        ]);
        $response->assertSessionHasErrors();
        $response = $this->post("/api/breakdowns", [
            'starts_at' => '2021-01-01T00:00:00',
            'ends_at' => '2020-03-01T00:00:00',
            'time_expression' => ''
        ]);
        $response->assertSessionHasErrors();
        $response = $this->post("/api/breakdowns", [
            'starts_at' => '2021-01-01T00:00:00',
            'ends_at' => '2021-03-01T00:00:00',
            'time_expression' => 'dfg'
        ]);
        $response->assertSessionHasErrors();
        $response = $this->post("/api/breakdowns", [
            'starts_at' => '2021-01-01T00:00:00',
            'ends_at' => '2021-03-01T00:00:00',
            'time_expression' => '2m,m,'
        ]);
        $response->assertSessionHasErrors();
    }
    public function testApiStoreBreakdown()
    {
        Passport::actingAsClient(Client::factory()->create());
        $response = $this->post("/api/breakdowns", [
            'starts_at' => Carbon::parse('2021-01-01T00:00:00'),
            'ends_at' => Carbon::parse('2021-03-01T12:30:00'),
            'time_expression' => '2m,m,d,2h'
        ]);
        $response->assertSessionHasNoErrors();
        $response->assertExactJson([
            'data' => [
                '2m' => 0,
                'm' => 1,
                'd' => 29,
                '2h' => 6.25
            ]
        ]);
        $this->assertDatabaseCount(Breakdown::class, 1);
    }

    public function testApiBreakdownsList()
    {
        Passport::actingAsClient(Client::factory()->create());
        $this->withoutExceptionHandling();
        $this->seed(BreakdownSeeder::class);
        $this->assertDatabaseCount(Breakdown::class, 10);
        $response = $this->getJson("/api/breakdowns?starts_at=2021-01-01T00:00:00&ends_at=2021-03-01T12:00:00");
        $response->assertJson(fn (AssertableJson $json) =>
            $json->has('data', 10)->has('meta')->has('links')
        );
        $response = $this->getJson("/api/breakdowns?starts_at=2020-01-01T00:00:00&ends_at=2021-03-01T12:30:00");
        $response->assertJson(fn (AssertableJson $json) =>
        $json->has('data', 0)->has('meta')->has('links')
        );
    }

}
