<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEventAddonRequest;
use App\Http\Requests\StoreEventAddonRequest;
use App\Http\Requests\UpdateEventAddonRequest;
use App\Models\EventAddon;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EventAddonsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('event_addon_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventAddons = EventAddon::all();

        return view('admin.eventAddons.index', compact('eventAddons'));
    }

    public function create()
    {
        abort_if(Gate::denies('event_addon_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.eventAddons.create');
    }

    public function store(StoreEventAddonRequest $request)
    {
        $eventAddon = EventAddon::create($request->all());

        return redirect()->route('admin.event-addons.index');
    }

    public function edit(EventAddon $eventAddon)
    {
        abort_if(Gate::denies('event_addon_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.eventAddons.edit', compact('eventAddon'));
    }

    public function update(UpdateEventAddonRequest $request, EventAddon $eventAddon)
    {
        $eventAddon->update($request->all());

        return redirect()->route('admin.event-addons.index');
    }

    public function show(EventAddon $eventAddon)
    {
        abort_if(Gate::denies('event_addon_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.eventAddons.show', compact('eventAddon'));
    }

    public function destroy(EventAddon $eventAddon)
    {
        abort_if(Gate::denies('event_addon_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventAddon->delete();

        return back();
    }

    public function massDestroy(MassDestroyEventAddonRequest $request)
    {
        EventAddon::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
