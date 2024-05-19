<?php

namespace App\Http\Controllers;

use App\Http\Helpers\LogHelper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $searchTerm = $request->search;
        if ($request->search) {
            $data = User::where('username', 'LIKE', "%{$searchTerm}%")->where('username', '!=', auth()->user()->username)->paginate(8);
        } else {
            $data = User::where('username', '!=', auth()->user()->username)->paginate(8);
        }

        return view('admin.user.index', compact('data'));
    }

    public function formAddUser()
    {
        return view('admin.user.add');
    }

    public function addUserAction(Request $request)
    {
        try {

            if ($request->password != $request->re_password) {
                return redirect()->back()->with(['flash' => 'passwordNotMatch']);
            }

            if (strlen($request->password) < 8) {
                return redirect()->back()->with(['flash' => 'passwordMin8Char']);
            }

            if (strpos($request->password, ' ') !== false) {
                return redirect()->back()->with(['flash' => 'passwordHaveSpace']);
            }

            if (strpos($request->username, ' ') !== false) {
                return redirect()->back()->with(['flash' => 'usernameHaveSpace']);
            }

            $existingUser = User::where('username', $request->username)->count();
            if ($existingUser > 0) {
                return redirect()->back()->with(['flash' => 'userAlreadyRegister']);
            }

            DB::beginTransaction();
            $user = new User();
            $user->name = $request->name;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->role = $request->role;
            $user->save();

            DB::commit();

            $message = "Sukses tambah data user";
            LogHelper::Log($message);
            return redirect()->back()->with(['flash' => 'successAdd']);
        } catch (\Throwable $th) {
            DB::rollBack();

            $message = "Gagal tambah data user" . $th;
            LogHelper::Log($message);
            return redirect()->back()->with(['flash' => 'errorAdd']);
        }
    }

    public function formEditUser($id)
    {
        $data = User::where('id', $id)->first();

        return view('admin.user.edit', compact('data'));
    }

    public function editUserAction(Request $request)
    {
        try {
            $isPassword = false;
            if ($request->password || $request->re_password) {
                if ($request->password != $request->re_password) {
                    return redirect()->back()->with(['flash' => 'passwordNotMatch']);
                }

                if (strlen($request->password) < 8) {
                    return redirect()->back()->with(['flash' => 'passwordMin8Char']);
                }

                if (strpos($request->password, ' ') !== false) {
                    return redirect()->back()->with(['flash' => 'passwordHaveSpace']);
                }

                if (strpos($request->username, ' ') !== false) {
                    return redirect()->back()->with(['flash' => 'usernameHaveSpace']);
                }

                $dataPassword = [
                    'password' => Hash::make($request->password)
                ];

                $isPassword = true;
            }

            $existingUser = User::where('username', $request->username)->where('id', '!=', $request->id)->count();
            if ($existingUser > 0) {
                return redirect()->back()->with(['flash' => 'userAlreadyRegister']);
            }

            DB::beginTransaction();
            $data = [
                'name' => $request->name,
                'username' => $request->username,
                'role' => $request->role
            ];

            if ($isPassword) {
                $data = array_merge($data, $dataPassword);
            }
            User::where('id', $request->id)->update($data);

            DB::commit();

            $message = "Sukses update data user";
            LogHelper::Log($message);
            return redirect()->back()->with(['flash' => 'successUpdate']);
        } catch (\Throwable $th) {
            DB::rollBack();

            $message = "Gagal update data user" . $th;
            LogHelper::Log($message);
            return redirect()->back()->with(['flash' => 'errorUpdate']);
        }
    }

    public function deleteUserAction($id)
    {
        User::where('id', $id)->delete();

        return redirect()->back()->with(['flash' => 'successDelete']);
    }
}
