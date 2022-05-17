<?php

namespace App\Services;

use App\Models\Note;
use App\Support\Data\Filter;
use App\Support\Data\Writer;

class NoteService
{
    private Writer $dataWriter;

    public function __construct(Writer $dataWriter)
    {
        $this->dataWriter = $dataWriter;
    }

    /** @return Note[] */
    public function search(array $filter = []): iterable
    {
        $query = Note::query()
            ->with('questions', 'links');

        return Filter::make($query, $filter)
            ->in('id')
            ->eq('category_id')
            ->search('search', 'content')
            ->order('created_at', 'desc')
            ->getQuery()
            ->paginate(10);
    }

    public function create(array $data): Note
    {
        return $this->dataWriter->transactionWrite(new Note(), $data);
    }

    public function update(Note $note, array $data): Note
    {
        return $this->dataWriter->transactionWrite($note, $data);
    }

    public function destroy(Note $note): bool
    {
        return $note->delete();
    }
}
