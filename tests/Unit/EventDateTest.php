<?php

namespace Tests\Unit;

use App\Models\Event;
use PHPUnit\Framework\TestCase;

class EventDateTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     **/
    public function test_event_date_formatted_successfully()
    {
        $event = new Event([
           'title' => 'Event Title',
           'description' => 'Lorem ipsum content',
           'start_date' => '2022-11-26 10:54:00',
        ]);
        $this->assertEquals('2022-11-26', $event->formatted_date);
        $this->assertTrue(true);
    }
}
