<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCostumeAttributeRequest;
use App\Http\Requests\StoreCostumeAttributeRequest;
use App\Http\Requests\UpdateCostumeAttributeRequest;
use App\Models\CostumeAttribute;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CostumeAttributeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('costume_attribute_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $costumeAttributes = CostumeAttribute::all();

        return view('admin.costumeAttributes.index', compact('costumeAttributes'));
    }

    public function create()
    {
        abort_if(Gate::denies('costume_attribute_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.costumeAttributes.create');
    }

    public function store(StoreCostumeAttributeRequest $request)
    {
        $costumeAttribute = CostumeAttribute::create($request->all());

        return redirect()->route('admin.costume-attributes.index');
    }

    public function edit(CostumeAttribute $costumeAttribute)
    {
        abort_if(Gate::denies('costume_attribute_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.costumeAttributes.edit', compact('costumeAttribute'));
    }

    public function update(UpdateCostumeAttributeRequest $request, CostumeAttribute $costumeAttribute)
    {
        $costumeAttribute->update($request->all());

        return redirect()->route('admin.costume-attributes.index');
    }

    public function show(CostumeAttribute $costumeAttribute)
    {
        abort_if(Gate::denies('costume_attribute_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.costumeAttributes.show', compact('costumeAttribute'));
    }

    public function destroy(CostumeAttribute $costumeAttribute)
    {
        abort_if(Gate::denies('costume_attribute_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $costumeAttribute->delete();

        return back();
    }

    public function massDestroy(MassDestroyCostumeAttributeRequest $request)
    {
        CostumeAttribute::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
