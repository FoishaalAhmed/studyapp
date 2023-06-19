<?php

namespace Modules\UserAccess\Http\Controllers;

use Modules\UserAccess\DataTables\UserQueriesDataTable;
use Illuminate\Contracts\Support\Renderable;
use Modules\UserAccess\Entities\Query;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Validator;

class QueryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(UserQueriesDataTable $dataTable)
    {
        return $dataTable->render('useraccess::query');
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [

            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email', 'max:255'],
            'phone'   => ['required', 'string', 'max:15'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],

        ]);

        $error_array    = [];
        $success_output = '';

        if ($validation->fails()) {
            foreach ($validation->messages()->getMessages() as $field_name => $messages) {
                $error_array[] = $messages;
            }
        } else {
            (new Query())->storeQuery($request);

            $success_output = '<div class="alert alert-success"> Query Send Successfully! </div>';
        }

        $output = [
            'error'   => $error_array,
            'success' => $success_output
        ];

        echo json_encode($output);
    }

    /**
     * Remove the specified resource from storage.
     * @param Query $query
     * @return Renderable
     */
    public function destroy(Query $query)
    {
        (new Query())->destroyQuery($query);
        return back();
    }
}
