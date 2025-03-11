<?php

namespace App\Observers;

use App\Models\Car;
use App\Models\Reminder;
use Carbon\Carbon;

class CarObserver
{
    /**
     * Handle the Car "created" event.
     *
     * @param  \App\Models\Car  $car
     * @return void
     */
    public function created(Car $car)
    {
        //
    }

    /**
     * Handle the Car "updated" event.
     *
     * @param  \App\Models\Car  $car
     * @return void
     */
    public function updated(Car $car)
    {
        
    }

    /**
     * Handle the Car "deleted" event.
     *
     * @param  \App\Models\Car  $car
     * @return void
     */
    // public function deleted(Car $car)
    // {
    //     //
    // }

    /**
     * Handle the Car "restored" event.
     *
     * @param  \App\Models\Car  $car
     * @return void
     */
    // public function restored(Car $car)
    // {
    //     //
    // }

    /**
     * Handle the Car "force deleted" event.
     *
     * @param  \App\Models\Car  $car
     * @return void
     */
    // public function forceDeleted(Car $car)
    // {
    //     //
    // }
}
