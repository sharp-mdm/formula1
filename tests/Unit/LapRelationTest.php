<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use Mockery;
use App\FormulaOne\Models\Track\Lap;
use App\FormulaOne\Models\Track\LapSector;
use Illuminate\Database\Eloquent\Collection;


class LapRelationTest extends TestCase
{
    public function test_lap_has_sectors_relation()
    {
        $lap = new Lap();
        $sector1 = Mockery::mock(LapSector::class);
        $sector2 = Mockery::mock(LapSector::class);

        $lap->setRelation('lapSectors', new Collection([$sector1, $sector2]));

        $this->assertInstanceOf(Collection::class, $lap->lapSectors);
        $this->assertCount(2, $lap->lapSectors);
        $this->assertTrue($lap->lapSectors->first() instanceof LapSector);
    }

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
