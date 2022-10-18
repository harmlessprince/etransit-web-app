<?php

namespace App\Interfaces;

interface TrackingInterface
{
    public function trackUser($user , $trackingDetails , $transaction_id);

    public function initiateTracking($user_id, $locationDetails);

    public function recordActiveTrackingSession($tracker_id , $locationDetails);

    public function endActiveTrackingSession($tracker_id);
}
