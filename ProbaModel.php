<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Validator;
use Auth;
use DB;
use DateTime;
use Hash;

class ProbaModel extends Model {

    public function loginUser() {
        $data = Input::all();
        $a = ['strEmail' => 'required|email',
            'pass' => 'required|min:6|max:50'];
        $validator = Validator::make($data, $a, ['strEmail.required' => 'Грешнeн е-mail!', 'pass.required' => 'Грешнa парола!']);
        if ($validator->fails()) {
            return Redirect::to('login')->withErrors($validator)->withInput();
        }
    }
    public function registraciq() {
        $data = Input::all();
            $a = ['e' => 'required|email',
                'p' => 'required|min:6|max:50'];
            $validator = Validator::make($data, $a, ['e.required' => 'Грешнeн е-mail!', 
                'p.required' => 'Моля въведете най-мако 6 символа за парола!']);
            if ($validator->fails()) {
                return Redirect::to('login')->withErrors($validator)->withInput();
            } else {
                DB::table('users_tbl')->insert([
                    [
                        'mail' => Input::get('e'),
                        'password' => Hash::make(Input::get('p')) //паролата задължително трябва да се хешира!!
                    ]
                ]);
            }
    }
    public function listTasks() {
        $sqlListTasks = DB::table('list_tasks_tbl')->where([['id_user', '=', Auth::user()->id_user]])->get();
        return $sqlListTasks;
    }

    public function createListTasks() {
        $sqlX = DB::table('list_tasks_tbl')->insert([
            [
                'id_user' => Auth::user()->id_user,
                'name_list' => Input::get('tema'),
                'date_added' => time(),
                'zabelejka'=>Input::get('z')
                ]
        ]);
        return $sqlX;
    }

    public function deleteListTasks($id) { 
        /*
         * когато потребителят натисне върху изтриване на списък, изпраща се заявка за изтриване на списъка
         */
        $sqlX1 = DB::table('list_tasks_tbl')->where('id_list', '=', $id)->update(['zaqvka_del' => 1]);
        return $sqlX1;
    }

    public function listZadachi($id1) {
        $sqlZadachi = DB::table('tasks_tbl')
                ->where('id_list_tasks', '=', $id1)
                ->join('list_tasks_tbl', 'list_tasks_tbl.id_list', '=', 'tasks_tbl.id_list_tasks')
                ->get();
        return $sqlZadachi;
    }

    public function newArhiv($id) {
        DB::table('list_tasks_tbl')
                ->where('id_list', '=', $id)
                ->join('tasks_tbl', 'tasks_tbl.id_list_tasks', '=', 'list_tasks_tbl.id_list') // архивираме само, когато даден списък съдържа поне една задача
                ->update(['arhiv_flag' => 1 // по default arhiv_flag стойността е 0, това означава, че не е архивиран списъка
        ]);
        return redirect('userZone_' . $id . '');
    }

    public function arhivListTasks() {
        $sqlArhiv = DB::table('list_tasks_tbl')->where([['id_user', '=', Auth::user()->id_user],
                    ['arhiv_flag', '=', 1]])->get();
        return $sqlArhiv;
    }

    public function deleteTask($id2) {
        $sqlDelete = DB::table('tasks_tbl')->where('id_tasks', '=', $id2)->delete();
        return $sqlDelete;
    }
  
    public function vsickiSpisyci(){
        $sql = DB::table('list_tasks_tbl')->select('name_list')->get();
        return $sql;
    }
    public function zaqvkaDeleteList(){
         $sqlDel = DB::table('list_tasks_tbl')->where('zaqvka_del', '=', 1)->get();
        return $sqlDel;
        /* и когато администратора разрешава за изтриването на списъка натиска върху даден бутон,
         * пускаме една заявка за изтриване към базата данни и списъкът се изтрива
         */
    }
}
