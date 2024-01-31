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
            'message' => ['required', 'string'],
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email', 'max:255'],
            'phone'   => ['required', 'string', 'max:15'],
            'subject' => ['required', 'string', 'max:255'],
        ]);

        $errors = [];
        $successMessage = '';

        if ($validation->fails()) {
            foreach ($validation->messages()->getMessages() as $field_name => $messages) {
                $errors[] = $messages;
            }
        } else {
            (new Query())->storeQuery($request);
            $message = __('Query Send Successfully!');
            $successMessage = '<div class="alert alert-success"> ' . $message . ' </div>';
        }

        $output = [
            'errors'   => $errors,
            'success' => $successMessage
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
