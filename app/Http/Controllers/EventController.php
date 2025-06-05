<?php

namespace App\Http\Controllers;

use App\Http\Requests\Event\CreateEventRequest;
use App\Http\Requests\Event\CreteEvent;
use App\Http\Requests\Event\UpdateEventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
// use App\Http\Controllers\CreateEventRequest;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return EventResource::collection(Event::paginate(20)) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEventRequest $request)
    {
        $data = $request->validated();
        $event = Event::create($data);
        if ($request->hasFile('event_images')) { // Changed 'gallery' to 'images' for consistency
            foreach ($request->file('event_images') as $image) {
                $event->addMedia($image)->toMediaCollection('event_image');
            }
        }
        return new EventResource($event);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return new EventResource($event);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $data = $request->validated();
        //  dd($data);
        //  dd($request);
        $event->update($data);
        // dd($event);
        if ($request->hasFile('event_images')) { // Changed 'gallery' to 'images' for consistency
            $event->clearMediaCollection('event_images'); // Clear existing images if any
            foreach ($request->file('event_images') as $image) {
                // $event->addMedia($image)->toMediaCollection('event_image');
                $event->addMedia($image)->toMediaCollection('event_image');
            }
        }       
        return new EventResource($event);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return response()->json(null,200);
    }
}
