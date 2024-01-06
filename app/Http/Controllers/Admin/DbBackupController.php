<?php

namespace App\Http\Controllers\Admin;

use App\Models\DbBackup;
use App\Http\Controllers\Controller;
use App\DataTables\Admin\DbBackupsDataTable;

class DbBackupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(DbBackupsDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.db-backup');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        (new DbBackup)->storeDbBackup();
        return back();
    }

    /**
     * download the specified resource.
     */
    public function download(DbBackup $backup)
    {

        if (!file_exists('public/db-backups/' . $backup->name)) {
            session()->flash('error', 'Backup file does not exists!');
            return back();
        }

        return response()->download('public/db-backups/' . $backup->name);
    }

}
