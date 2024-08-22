<?php

namespace App\Http\Controllers;

use App\Models\Manual;
use App\Http\Requests\ManualRequest;

/**
 * Class ManualController
 * @package App\Http\Controllers
 */
class ManualController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $manuals = Manual::paginate();

        return view('manual.index', compact('manuals'))
            ->with('i', (request()->input('page', 1) - 1) * $manuals->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $manual = new Manual();
        return view('manual.create', compact('manual'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ManualRequest $request)
    {
        Manual::create($request->validated());

        return redirect()->route('manuals.index')
            ->with('success', 'Manual created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $manual = Manual::find($id);

        return view('manual.show', compact('manual'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $manual = Manual::find($id);

        return view('manual.edit', compact('manual'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ManualRequest $request, Manual $manual)
    {
        $manual->update($request->validated());

        return redirect()->route('manuals.index')
            ->with('success', 'Manual updated successfully');
    }

    public function destroy($id)
    {
        Manual::find($id)->delete();

        return redirect()->route('manuals.index')
            ->with('success', 'Manual deleted successfully');
    }
}
