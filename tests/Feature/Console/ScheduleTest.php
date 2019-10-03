<?php

namespace Tests\Feature\Auth;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ScheduleTest extends TestCase
{
    public function testCanRunSchedule()
    {
        $result = Artisan::call('schedule:run');
        $this->assertEquals(null, $result);
    }
}
