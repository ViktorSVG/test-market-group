<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vacation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index(Request $request, $year = null) : \Illuminate\Contracts\Support\Renderable
    {
        $current = (int)$year ?: date('Y');
        $years = range(date('Y') - 4, date('Y') + 1, 1);
        $users = User::allYearVacations($current);
        $errors = $request->session()->has('errors') ? $request->session()->get('errors') : [];
        $success = $request->session()->has('success') ? $request->session()->get('success') : null;
        return view(
            'dashboard.index',
            [
                'years' => $years,
                'current' => $current,
                'users'=> $users,
                'success' => $success,
                'errors' => $errors
            ]
        );
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date_from' => 'required|date',
            'date_to' => 'required|date',
            'id' => 'integer'
        ]);
        $validator->after(function($validator){
            $data = $validator->getData();
            if ((int)date_diff(date_create($data['date_from']), date_create($data['date_to']))->format('%r%a') < 0) {
                $validator->errors()->add(
                    'no-field', 'Дата начала отпуска не может быть позже даты окончания отпуска!'
                );
            }
            $data['users_id'] = Auth::id();
            if (!Vacation::availableVacation($data)) {
                $validator->errors()->add(
                    'no-field', 'Не возможно использовать даты для отпуска, т.к. они полностью или частично перекрываются с другим Вашим отпуском!'
                );
            }
        });
        if ($validator->fails()) {
            return redirect(route('app.index'))
                ->with('errors', $validator->errors()->toArray());
        }
        $validated = $validator->validated();
        $validated['users_id'] = Auth::id();
        if (!(int)$validated['id']){
            Vacation::createRow($validated);
        }
        else {
            Vacation::updateRow((int)$validated['id'], $validated);
        }
        return redirect(route('app.index'))
            ->with('success', 'Данные успешно сохранены');
    }

    public function approve(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'approve' => 'required|regex:/^[0-1]$/',
            'id' => 'required|regex:/^\d+$/'
        ]);
        if ($validator->fails()) {
            return redirect(route('app.index'))
                ->with('errors', $validator->errors()->toArray());
        }
        $validated = $validator->validated();
        Vacation::approve((int)$validated['id'], (bool)((int)$validated['approve']));
        return redirect(route('app.index'))
            ->with('success', ((int)$validated['approve'] ? 'Отпуск согласован' : 'Согласование отменено'));
    }

    public function drop(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|regex:/^\d+$/'
        ]);
        if ($validator->fails()) {
            return redirect(route('app.index'))
                ->with('errors', $validator->errors()->toArray());
        }
        $validated = $validator->validated();
        Vacation::drop((int)$validated['id']);
        return redirect(route('app.index'))
            ->with('success', 'Отпуск удален');
    }
}
