<?php

namespace App\Enum;

interface EventStatus
{
    const FinishedEvents = 'finished_events';
    const UpcomingEvents = 'upcoming_events';
    const UpcomingEventWithin7Days = 'upcoming_events_within_7_days';
    const FinishedEventsOfLast7Days = 'finished_events_of_last_7_days';
}
