<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        return view('backend.dashboard', compact('title'));
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Đăng xuất thành công',
            'alert-type' => 'success'
        );

        return redirect('/login')->with($notification);
    }

    private function MainInfoUser()
    {
        $id = Auth::user()->id;
        $data = null;

        if (isset($id)) {
            $data = User::find($id);
        }
        return $data;
    }

    public function Profile()
    {
        $title = 'Thông tin tài khoản';
        $adminData = $this->MainInfoUser();

        return view('backend.accounts.admin_profile_view', compact('title','adminData'));
    }

    public function EditProfile()
    {
        $title = 'Chỉnh sửa hồ sơ';
        $editData = $this->MainInfoUser();

        return view('backend.accounts.admin_profile_edit', compact('editData', 'title'));
    }

    public function StoreProfile(Request $request)
    {
        $data = $this->MainInfoUser();
        $id = $data->id;
        // dd($id);
        $params = $request->except('_token');
        // dd($request->all());
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $resultDL = Storage::delete('/public/accounts' . $data->image);
            $params['image'] = uploadFile('images/accounts', $request->file('image'));   
        } else {
            $params['image'] = $data->image;
        }

        $result = User::where('id', $id)
        ->update($params);

        // $data->save();

        $notification = array(
            'message' => 'Cập nhật thành công',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.profile')->with($notification);
    }


    public function ChangePassword()
    {
        $title = 'Thay đổi mật khẩu';
        return view('backend.accounts.admin_change_password', compact('title'));
    }


    public function UpdatePassword(Request $request)
    {
        $validateData = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password',
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->old_password, $hashedPassword)) {
            $users = User::find(Auth::id());
            $users->password = bcrypt($request->new_password);
            $users->save();

            session()->flash('message', 'Cập nhật mật khẩu thành công');
            return redirect()->route('admin.profile');
        } else {
            session()->flash('message', 'Mật khẩu không trùng khớp');
            return redirect()->back();
        }
    }

    public function addAccount() {
        $title = 'Tạo tài khoản';
        return view('backend.accounts.add', compact('title'));
    }

    public function postAccounts(AccountsRequest $request) {
        $params = $request->except('_token');
        $params['password'] = bcrypt($request->password);
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $params['image'] = uploadFile('images/accounts', $request->file('image'));
        }
        // dd($params);

        // dd($params)

        DB::enableQueryLog();
        $user = User::create($params);
        dd(DB::getQueryLog());
        if ($user->id) {
            $notification = [
                'alert-type' => 'success',
                'message' => 'Thêm tài khoản thành công'
            ];

            return redirect()->route('admin.add')->with($notification);
        }
    }
}
