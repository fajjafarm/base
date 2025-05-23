<?php
namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('user_id', Auth::id())->get()->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'start' => $event->start,
                'end' => $event->end,
                'className' => $event->category,
            ];
        });

        return response()->json($events);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'start' => 'required|date',
            'end' => 'nullable|date|after:start',
        ]);

        $event = Event::create([
            'title' => $request->title,
            'category' => $request->category,
            'start' => $request->start,
            'end' => $request->end,
            'user_id' => Auth::id(),
        ]);

        return response()->json(['success' => true, 'event' => $event]);
    }

    public function update(Request $request, Event $event)
    {
        $this->authorize('update', $event);

        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'start' => 'required|date',
            'end' => 'nullable|date|after:start',
        ]);

        $event->update($request->only(['title', 'category', 'start', 'end']));

        return response()->json(['success' => true]);
    }

    public function destroy(Event $event)
    {
        $this->authorize('delete', $event);
        $event->delete();

        return response()->json(['success' => true]);
    }
}