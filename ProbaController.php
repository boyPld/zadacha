<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\ProbaModel;
use Validator;
use App\User;
use Auth;
use DB;

class ProbaController extends Controller {

    public function loginUser() {
        if (Input::get('submit_vhod')) { //когато се натиска бутона за вход
            $obekt = new ProbaModel();
            $obekt->loginUser();
            if (Auth::attempt(['mail' => Input::get('strEmail'),
                        'password' => Input::get('pass'),
                        'type' => 1])) { /* тук има допълнително условие, което служа за ограничаване на потребителите на системата,
                                            променливата type, ако е 2 потребителят е администратор    */
                return redirect('http://localhost/laravel/public/userZone_' . Auth::user()->id_user . '');
            } else if (Auth::attempt(['mail' => Input::get('strEmail'),
                        'password' => Input::get('pass'),
                        'type' => 2])){
                return redirect('http://localhost/laravel/public/adminZone_' . Auth::user()->id_user . '');
                        }else return view('login');              
        }
        if (Input::get('submit_reg')) { //когато се натиска бутона за регистрация
            $obekt = new ProbaModel();
            $obekt->registraciq();
            return view('login');
        }
    }

    public function getListTasks() {
        $obekt = new ProbaModel();
        $x2 = $obekt->listTasks(); //обект от списъци
        $y2 = $obekt->arhivListTasks(); //обект от архивирани списъци
         echo '<pre>'.  print_r($y2).'</pre>';
        return view('userZone', ['result' => $x2, 'arhiv' => $y2]);
    }

    public function newListTasks($id) {
        $validator = Validator::make(Input::all(), array(
                    'tema' => 'required|min:1'), [
                    'tema.required' => 'Полето име на списък за задачи не може да бъде празно!',
                        ]
        );
        if ($validator->fails()) {
            return Redirect::to('userZone_' . $id . '')->withErrors($validator)->withInput();
        } else {
            $obekt = new ProbaModel();
            $x2 = $obekt->createListTasks();
            return redirect('userZone_' . $id . '');
        }
    }

    public function deleteList($id) {
        $obekt = new ProbaModel();
        $x2 = $obekt->deleteListTasks($id);
        return redirect('userZone_' . $id . '');
    }

    public function tasks($id, $id1) {
        $obekt = new ProbaModel();
        $x3 = $obekt->listZadachi($id1);
        // echo '<pre>'.  print_r($x3,true).'</pre>';    
        return view('listTasks', ['zad' => $x3]);
    }

    public function newTasks($id, $id1) {
        if (Input::get('submit_w')) { // когато е натиснат бутона за добавяне на нова задача
            $validator = Validator::make(Input::all(), array(
                        'zadacha' => 'required|min:1',
                        'status' => 'required|min:1'), [
                        'zadacha.required' => 'Не сте въвели задача!',
                        'status.required' => 'Не се въвели статус!']
            );
            if ($validator->fails()) {
                return Redirect::to('userZone_' . $id . '/listTasks_' . $id1 . '')->withErrors($validator)->withInput();
            } else {
                DB::table('tasks_tbl')->insert([
                    [
                        'name_task' => Input::get('zadacha'),
                        'date_added_tasks' => time(),
                        'id_list_tasks' => $id1,
                        'status' => Input::get('status'),
                        'belejka'=>Input::get('b')
                        ]
                ]);
                return redirect('userZone_' . $id . '/listTasks_' . $id1 . '');
            }
        } /* else if (Input::get('newstatus')==1){
          $valid = Validator::make(Input::all(), array(
          'novstatus' => 'required|min:1'), [
          'novstatus.required' => 'Не сте въвели статус!']
          );
          if ($valid->fails()) {

          }
          return Redirect::to('userZone_' . $id . '/listTasks_' . $id1 . '')->withErrors($valid)->withInput();
          }
         * 
         */
    }

    public function arhiv($id) {
        $obekt = new ProbaModel();
        $x3 = $obekt->newArhiv($id);
        return redirect('userZone_' . $id . '');
    }

    public function deleteZadacha($id, $id1, $id2) {
        $obekt = new ProbaModel();
        $x4 = $obekt->deleteTask($id2);
        return redirect('userZone_' . $id . '/listTasks_' . $id1 . '');
    }

}
