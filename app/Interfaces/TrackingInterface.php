<?php

namespace App\Interfaces;

interface TrackingInterface
{
    public function trackUser($user , $trackingDetails);

    public function initiateTracking($user_id, $locationDetails);

    public function recordActiveTrackingSession($tracker_id , $locationDetails);
}
