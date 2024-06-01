<?php

namespace App\Traits;

trait PreventDuplicateEvents
{
    protected static $processedEventIds = [];

    protected function isDuplicateEvent($eventId)
    {
        if (in_array($eventId, self::$processedEventIds)) {
            return true;
        }

        self::$processedEventIds[] = $eventId;
        return false;
    }
}
