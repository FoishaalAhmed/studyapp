<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buy extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'type', 'resource_id', 'price', 'payment_method', 'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getResourceBuy($type, $id)
    {
        $query = $this::join('users', 'buys.user_id', '=', 'users.id')
                        ->orderBy('buys.id', 'desc')
                        ->where(['buys.id' => $id, 'buys.type' => $type]);

        if ($type == 'ebook') {
            $query->join('ebooks', 'buys.resource_id', '=', 'ebooks.id')
                  ->select('buys.*', 'users.name', 'ebooks.title as resource');
        }

        if ($type == 'exam') {
            $query->join('exams', 'buys.resource_id', '=', 'exams.id')
                ->select('buys.*', 'users.name', 'exams.title as resource');
        }

        if ($type == 'mcq') {
            $query->join('model_tests', 'buys.resource_id', '=', 'model_tests.id')
                ->select('buys.*', 'users.name', 'model_tests.title as resource');
        }

        if ($type == 'sheet') {
            $query->join('lecture_sheets', 'buys.resource_id', '=', 'lecture_sheets.id')
                ->select('buys.*', 'users.name', 'lecture_sheets.chapter as resource');
        }

        return $query->first();
    }

    public function getUserResourceBuy($type)
    {
        $query = $this::join('users', 'buys.user_id', '=', 'users.id')
                        ->orderBy('buys.id', 'desc')
                        ->where(['buys.user_id' => auth()->id(), 'buys.type' => $type]);

        if ($type == 'ebook') {
            $query->join('ebooks', 'buys.resource_id', '=', 'ebooks.id')
                  ->select('buys.*', 'users.name', 'ebooks.title as resource');
        }

        if ($type == 'exam') {
            $query->join('exams', 'buys.resource_id', '=', 'exams.id')
                ->select('buys.*', 'users.name', 'exams.title as resource');
        }

        if ($type == 'mcq') {
            $query->join('model_tests', 'buys.resource_id', '=', 'model_tests.id')
                ->select('buys.*', 'users.name', 'model_tests.title as resource');
        }

        if ($type == 'sheet') {
            $query->join('lecture_sheets', 'buys.resource_id', '=', 'lecture_sheets.id')
                ->select('buys.*', 'users.name', 'lecture_sheets.chapter as resource');
        }

        return $query->get();
    }

    public function getUserResourceBuyForAdmin($type)
    {
        $query = $this::join('users', 'buys.user_id', '=', 'users.id')
                        ->where('buys.type', $type);

        if ($type == 'ebook') {
            $query->join('ebooks', 'buys.resource_id', '=', 'ebooks.id')
                  ->select('buys.*', 'users.name', 'ebooks.title as resource');
        }

        if ($type == 'exam') {
            $query->join('exams', 'buys.resource_id', '=', 'exams.id')
                ->select('buys.*', 'users.name', 'exams.title as resource');
        }

        if ($type == 'mcq') {
            $query->join('model_tests', 'buys.resource_id', '=', 'model_tests.id')
                ->select('buys.*', 'users.name', 'model_tests.title as resource');
        }

        if ($type == 'sheet') {
            $query->join('lecture_sheets', 'buys.resource_id', '=', 'lecture_sheets.id')
                ->select('buys.*', 'users.name', 'lecture_sheets.chapter as resource');
        }

        return $query;
    }

    public function storeBuy(object $request)
    {
        $this->type = $request->type ;
        $this->payment_method = $request->payment_method ;
        $this->resource_id = $request->resource_id ;
        $this->price = $request->price ;
        $this->user_id = auth()->id() ;
        $this->save();
    }
}
