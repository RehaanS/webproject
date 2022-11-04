<?php
namespace App\Http\Controllers;

use App\Models\Mood;
use Illuminate\Http\Request;

class MoodController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('moods.index', [
            'moods' => Mood::with('user')->latest()->get(),
        ]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $request->user()->moods()->create($validated);

        return redirect(route('moods.index'));
    }

    /**
     * @param  \App\Models\Mood  $mood
     * @return \Illuminate\Http\Response
     */
    public function show(Mood $mood)
    {
        //
    }

    /**
     * @param  \App\Models\Mood  $mood
     * @return \Illuminate\Http\Response
     */
    public function edit(Mood $mood)
    {
        $this->authorize('update', $mood);

        return view('moods.edit', [
            'mood' => $mood,
        ]);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mood  $mood
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mood $mood)
    {
        $this->authorize('update', $mood);

        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $mood->update($validated);

        return redirect(route('moods.index'));
    }

    /**
     * @param  \App\Models\Mood  $mood
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mood $mood)
    {
        $this->authorize('delete', $mood);

        $mood->delete();

        return redirect(route('moods.index'));
    }

}
