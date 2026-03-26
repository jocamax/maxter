<?php

namespace App\Http\Controllers;

use App\Mail\NewQuestionReceived;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = \App\Models\Question::latest()->get();

        return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Honeypot prevention
        if ($request->filled('website')) {
            return response()->noContent();
        }

        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'firm' => ['nullable', 'string', 'max:255'],
            'email'   => ['required', 'email:rfc,dns', 'max:255'],
            'phone'   => ['nullable', 'string', 'max:50'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        $question = Question::create($validated);

        try {
            Mail::to(config('mail.notification_to'))->send(new NewQuestionReceived($question));
        } catch (\Exception $e) {
            \Log::error('Contact form mail failed: ' . $e->getMessage());
        }

        return back()->with('success', 'Hvala! Vaša poruka je uspešno poslata.');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
