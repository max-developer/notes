<?php

namespace App\Services;

use App\Models\Note;

class NoteService
{
    /** @return Note[] */
    public function search(array $filter = [])
    {
        $query = Note::query();

        if ($filter['category_id'] ?? false) {
            $query->where('category_id', $filter['category_id']);
        }

        return $query->get();
    }

    public function create(array $data): Note
    {
        $note = new Note($data);
        $this->saveWithRelations($note, $data);

        return $note;
    }

    public function update(Note $note, array $data): Note
    {
        $note->fill($data);
        $this->saveWithRelations($note, $data);

        return $note;
    }

    public function destroy(Note $note): bool
    {
        return $note->delete();
    }

    private function saveWithRelations(Note $note, array $data): void
    {
        if (array_key_exists('category_id', $data)) {
            $note->category()->associate($data['category_id']);
        }

        $note->save();

        if (array_key_exists('questions', $data)) {
            $note->questions()->sync($data['questions']);
        }
    }

}
