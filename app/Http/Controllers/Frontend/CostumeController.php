<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCostumeRequest;
use App\Http\Requests\StoreCostumeRequest;
use App\Http\Requests\UpdateCostumeRequest;
use App\Models\Costume;
use App\Models\CostumeAttribute;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CostumeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('costume_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $costumes = Costume::with(['options'])->get();

        return view('frontend.costumes.index', compact('costumes'));
    }

    public function create()
    {
        abort_if(Gate::denies('costume_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $options = CostumeAttribute::pluck('title', 'id');

        return view('frontend.costumes.create', compact('options'));
    }

    public function store(StoreCostumeRequest $request)
    {
        $costume = Costume::create($request->all());
        $costume->options()->sync($request->input('options', []));

        return redirect()->route('frontend.costumes.index');
    }

    public function edit(Costume $costume)
    {
        abort_if(Gate::denies('costume_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $options = CostumeAttribute::pluck('title', 'id');

        $costume->load('options');

        return view('frontend.costumes.edit', compact('costume', 'options'));
    }

    public function update(UpdateCostumeRequest $request, Costume $costume)
    {
        $costume->update($request->all());
        $costume->options()->sync($request->input('options', []));

        return redirect()->route('frontend.costumes.index');
    }

    public function show(Costume $costume)
    {
        abort_if(Gate::denies('costume_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $costume->load('options');

        return view('frontend.costumes.show', compact('costume'));
    }

    public function destroy(Costume $costume)
    {
        abort_if(Gate::denies('costume_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $costume->delete();

        return back();
    }

    public function massDestroy(MassDestroyCostumeRequest $request)
    {
        Costume::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
