<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Gate;
use Str;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::user()) {
            $tasks = Task::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(10);

            return view('dashboard', compact('tasks'));
        } else {
            $guestToken = $request->cookie('guest_token');

            if (!$guestToken) {
                $guestToken = Str::uuid();
                Cookie::queue('guest_token', $guestToken, 60 * 24 * 30);
            }

            $tasks = Task::where('guest_token', $guestToken)->orderBy('created_at', 'desc')->paginate(10);
        }

        return view('home', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if (Auth::user()) {
            return view('tasks.user-create');
        }

        return view('tasks.guest-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'description'   => 'required|string|max:255',
        ]);

        if (Auth::user()) {
            Auth::user()->tasks()->create($validated);
        } else {
            $guestToken = $request->cookie('guest_token');

            if (!$guestToken) {
                $guestToken = Str::uuid();
                Cookie::queue('guest_token', $guestToken, 60 * 24 * 30);
            }
            Task::create([
                'description' => $validated['description'],
                'guest_token' => $guestToken,
            ]);

            return redirect()->route('home')->with('success', 'Task created successfully!');
        }

        return redirect()->route('dashboard')->with('success', 'Task created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        Task $task
    ) {
        $guestToken = $request->cookie('guest_token');
        Gate::authorize('update', [$task, $guestToken]);

        if (Auth::user()) {
            return view('tasks.user-edit', compact('task'));
        }

        return view('tasks.guest-edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        Request $request,
        Task $task
    ) {
        $validated = $request->validate([
            'description'   => 'required|string|max:255',
            'is_completed' => 'boolean',
        ]);

        $guestToken = $request->cookie('guest_token');
        Gate::authorize('update', [$task, $guestToken]);

        $task->update($validated);

        if (Auth::user()) {
            return redirect()->route('dashboard')->with('success', 'Task updated successfully!');
        }

        return redirect()->route('home')->with('success', 'Task updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request
        $request,
        Task $task
    ) {
        $guestToken = $request->cookie('guest_token');
        Gate::authorize('update', [$task, $guestToken]);

        $task->delete();

        if (Auth::user()) {
            return redirect()->route('dashboard')->with('success', 'Task deleted successfully!');
        }

        return redirect()->route('home')->with('success', 'Task deleted successfully!');
    }
}
