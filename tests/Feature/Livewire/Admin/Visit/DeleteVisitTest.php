<?php

namespace Tests\Feature\Livewire\Admin\Visit;

use App\Http\Livewire\Admin\Visit\CreateVisits;
use App\Http\Livewire\Admin\Visit\ShowVisits;
use App\Models\PointOfInterest;
use App\Models\User;
use App\Models\Visit;
use Livewire\Livewire;
use Tests\TestCase;
use function dd;


class DeleteVisitTest extends TestCase
{
    /** @test */
    public function TestDeleteVisit()
    {
        $adminUser = $this->createAdmin();
        $place = $this->createPlace();
        $pointOfInterest = $this->createPointOfInterest($place->id);
        $vist = $this->createVisit($pointOfInterest->id);

        $this->actingAs($adminUser);

        $this->assertDatabaseCount('visits', 1);

        $this->assertDatabaseHas('visits', [
            'point_of_interest_id' => $vist->pointOfInterest->id,
        ]);

        Livewire::test(ShowVisits::class)
            ->call('delete', $vist);

        $this->assertDatabaseCount('visits', 0);
    }
}
