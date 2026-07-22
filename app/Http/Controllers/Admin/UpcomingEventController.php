<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UpcomingEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class UpcomingEventController extends Controller
{
    protected $iconUploadPath  = 'backend/upcoming-events/icons';
    protected $videoUploadPath = 'backend/upcoming-events/videos';

    // Ab active + trashed dono ek sath layenge
    public function index()
    {
        $events = UpcomingEvent::withTrashed()->latest()->get();
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
            $data['video'] = $this->uploadFile($request->file('video'), $this->videoUploadPath);
        }

        if ($request->hasFile('icon')) {
            $data['icon'] = $this->uploadFile($request->file('icon'), $this->iconUploadPath);
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
            $this->deleteFile($upcoming_event->video);
            $data['video'] = $this->uploadFile($request->file('video'), $this->videoUploadPath);
        }

        if ($request->hasFile('icon')) {
            $this->deleteFile($upcoming_event->icon);
            $data['icon'] = $this->uploadFile($request->file('icon'), $this->iconUploadPath);
        }

        $upcoming_event->update($data);

        return redirect()->route('upcoming-events.index')
            ->with('toast_success', 'Upcoming Event updated successfully.');
    }

    // Soft delete
    public function destroy(UpcomingEvent $upcoming_event)
    {
        $upcoming_event->delete();

        return redirect()->route('upcoming-events.index')
            ->with('toast_success', 'Upcoming Event moved to trash.');
    }

    // Restore
    public function restore($id)
    {
        $upcoming_event = UpcomingEvent::onlyTrashed()->findOrFail($id);
        $upcoming_event->restore();

        return redirect()->route('upcoming-events.index')
            ->with('toast_success', 'Upcoming Event restored successfully.');
    }

    // Permanent delete
    public function forceDelete($id)
    {
        $upcoming_event = UpcomingEvent::withTrashed()->findOrFail($id);

        $this->deleteFile($upcoming_event->icon);
        $this->deleteFile($upcoming_event->video);
        $upcoming_event->forceDelete();

        return redirect()->route('upcoming-events.index')
            ->with('toast_success', 'Upcoming Event permanently deleted.');
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

    private function uploadFile($file, $uploadPath)
    {
        $destinationPath = public_path($uploadPath);

        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $fileName);

        return $uploadPath . '/' . $fileName;
    }

    private function deleteFile($filePath)
    {
        if ($filePath && File::exists(public_path($filePath))) {
            File::delete(public_path($filePath));
        }
    }
}