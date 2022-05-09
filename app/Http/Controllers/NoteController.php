<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Models\Note;
use App\Services\NoteService;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public const ROUTE_INDEX = 'notes.index';

    private NoteService $noteService;

    public function __construct(NoteService $noteService)
    {
        $this->noteService = $noteService;
    }

    public function index(Request $request)
    {
        $notes = $this->noteService->search($request->query->all());
        return view('note.index', compact('notes'));
    }

    public function create(Request $request)
    {
        $note = new Note();
        $note->category_id = $request->query->get('category_id');

        return view('note.create', compact('note'));
    }

    public function store(NoteRequest $request)
    {
        $data = $request->validated();
        $this->noteService->create($data);

        $request->session()->flash('success', 'Note created');

        return redirect()->route(self::ROUTE_INDEX, $request->query());
    }

    public function show(Note $note)
    {
        return view('note.show', compact('note'));
    }

    public function edit(Note $note)
    {
        return view('note.edit', compact('note'));
    }

    public function update(NoteRequest $request, Note $note)
    {
        $data = $request->validated();
        $this->noteService->update($note, $data);

        $request->session()->flash('success', 'Note updated');

        return redirect()->route(self::ROUTE_INDEX, $request->query());
    }

    public function destroy(Request $request, Note $note)
    {
        $deleted = $this->noteService->destroy($note);

        if ($deleted) {
            $request->session()->flash('success', 'Note deleted');
        } else {
            $request->session()->flash('failed', 'Note delete failed');
        }

        return redirect()->route(self::ROUTE_INDEX, $request->query());
    }
}
