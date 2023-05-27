<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\WritesDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\WriterRequest;
use Spatie\Permission\Models\Role;
use App\Models\Writer;

class WriterController extends Controller
{
    protected $writerModelObject;

    public function __construct()
    {
        $this->writerModelObject = new Writer();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(WritesDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.writers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::where('name', 'Writer')->first(['id', 'name']);
        return view('backend.admin.writers.create', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WriterRequest $request)
    {
        $this->writerModelObject->storeWriter($request);
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  object  Writer $writer
     * @return \Illuminate\Http\Response
     */
    public function edit(Writer $writer)
    {
        $data = [
            'writer' => $writer,
            'role' => Role::where('name', 'Writer')->first(['id', 'name'])
        ];
        return view('backend.admin.writers.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  object Writer $writer
     * @return \Illuminate\Http\Response
     */
    public function update(WriterRequest $request, Writer $writer)
    {
        $this->writerModelObject->updateWriter($request, $writer);
        return redirect()->route('admin.writers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  object  $writer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Writer $writer)
    {
        $this->writerModelObject->destroyWriter($writer);
        return back(); 
    }
}
