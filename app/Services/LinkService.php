<?php

namespace App\Services;

use App\Models\Link;
use App\Support\Data\Filter;
use App\Support\Data\Writer;

class LinkService
{
    private Writer $dataWriter;

    public function __construct(Writer $dataWriter)
    {
        $this->dataWriter = $dataWriter;
    }

    /** @return Link[] */
    public function search(array $filter = []): iterable
    {
        return Filter::make(Link::query(), $filter)
            ->search('search', 'name', 'url')
            ->getQuery()
            ->paginate();
    }

    public function create(array $data): Link
    {
        return $this->dataWriter->write(new Link(), $data);
    }

    public function update(Link $link, array $data): Link
    {
        return $this->dataWriter->write($link, $data);
    }

    public function destroy(Link $link): bool
    {
        return $link->delete();
    }


}
