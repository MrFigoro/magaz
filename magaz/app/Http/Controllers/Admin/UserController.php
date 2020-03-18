<?php
/**
 * Created by PhpStorm.
 * User: Stepan
 * Date: 18.12.2019
 * Time: 21:21
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use SoftDeletes;
    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return array_merge($request->only('email', 'password'), ['role' => 'admin']);
    }

    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('user.index', ['users' => $users]);
    }

    /**
     * search of the users.
     */
    public function search() {
        return $this->jsonPagination(User::paginate(5));
    }
    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        return view('user.create', ['user' => $user]);
    }

    /**
     * @param UserRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(UserRequest $request)
    {
        $userData = $request->all();
        if (empty($userData['id'])) {
            $user = new User();
        } else {
            $user = User::find($userData['id']);
        }
        $user->fill($userData);
        $user->save();
        return redirect('/admin/')->with('success', 'User has been added');
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(int $id)
    {
        $user = User::findOrFail($id);
        return view('user.create', ['user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        User::findOrFail($id)->delete();
        return response()->json(['message' => 'deleted']);
    }

    public function active(int $id)
    {
        $user = User::findOrFail($id);
        if($user->active) {
            $user->active = false;
        } else {
            $user->active = true;
        }
        $user->save();
        return response()->json($user);
    }

}