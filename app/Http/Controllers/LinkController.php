<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinkRequest;
use App\Models\Link;
use App\Services\LinkService;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public const ROUTE_INDEX = 'links.index';

    private LinkService $linkService;

    public function __construct(LinkService $linkService)
    {
        $this->linkService = $linkService;
    }

    public function index(Request $request)
    {
        $links = $this->linkService->search($request->all());
        return view('link.index', compact('links'));
    }

    public function create()
    {
        $link = new Link();
        return view('link.create', compact('link'));
    }

    public function store(LinkRequest $request)
    {
        $data = $request->validated();
        $this->linkService->create($data);

        return redirect()->route(self::ROUTE_INDEX)->with('success', 'Link created');
    }

    public function show(Link $link)
    {
        return view('link.show', compact('link'));
    }

    public function edit(Link $link)
    {
        return view('link.edit', compact('link'));
    }

    public function update(LinkRequest $request, Link $link)
    {
        $data = $request->validated();
        $this->linkService->update($link, $data);

        return redirect()->route(self::ROUTE_INDEX)->with('success', 'Link updated');
    }

    public function destroy(Link $link)
    {
        $this->linkService->destroy($link);
        return redirect()->route(self::ROUTE_INDEX)->with('success', 'Link deleted');
    }
}
