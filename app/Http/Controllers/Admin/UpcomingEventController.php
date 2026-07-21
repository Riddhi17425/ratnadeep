<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UpcomingEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UpcomingEventController extends Controller
{
    public function index()
    {
        $events = UpcomingEvent::latest()->get();
        return view('admin.upcoming-events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.upcoming-events.create');
    }

    private function rules()
    {
        return [
            'title'              => 'required|string|max:255',
            'video'              => 'nullable|mimes:mp4,mov,avi,wmv|max:20480',
            'alt_video_text'     => 'nullable|string|max:255',
            'icon'               => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'alt_icon_text'      => 'nullable|string|max:255',
            'short_description'  => 'nullable|string',
            'date_from'          => 'nullable|date',
            'date_to'            => 'nullable|date|after_or_equal:date_from',
            'reference'          => 'nullable|string|max:255',
            'status'             => 'required|in:0,1',
        ];
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        if ($request->hasFile('video')) {
            $data['video'] = $request->file('video')->store('upcoming-events/videos', 'public');
        }

        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('upcoming-events/icons', 'public');
        }

        UpcomingEvent::create($data);

        return redirect()->route('upcoming-events.index')
            ->with('toast_success', 'Upcoming Event created successfully.');
    }

    public function edit(UpcomingEvent $upcoming_event)
    {
        return view('admin.upcoming-events.edit', ['event' => $upcoming_event]);
    }

    public function update(Request $request, UpcomingEvent $upcoming_event)
    {
        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        if ($request->hasFile('video')) {
            if ($upcoming_event->video) {
                Storage::disk('public')->delete($upcoming_event->video);
            }
            $data['video'] = $request->file('video')->store('upcoming-events/videos', 'public');
        }

        if ($request->hasFile('icon')) {
            if ($upcoming_event->icon) {
                Storage::disk('public')->delete($upcoming_event->icon);
            }
            $data['icon'] = $request->file('icon')->store('upcoming-events/icons', 'public');
        }

        $upcoming_event->update($data);

        return redirect()->route('upcoming-events.index')
            ->with('toast_success', 'Upcoming Event updated successfully.');
    }

    public function destroy(UpcomingEvent $upcoming_event)
    {
        if ($upcoming_event->video) {
            Storage::disk('public')->delete($upcoming_event->video);
        }
        if ($upcoming_event->icon) {
            Storage::disk('public')->delete($upcoming_event->icon);
        }
        $upcoming_event->delete();

        return redirect()->route('upcoming-events.index')
            ->with('toast_success', 'Upcoming Event deleted successfully.');
    }

    public function updateStatus(Request $request, UpcomingEvent $upcoming_event)
    {
        $request->validate([
            'status' => 'required|in:0,1',
        ]);

        $upcoming_event->status = $request->status;
        $upcoming_event->save();

        return response()->json(['success' => true]);
    }
}