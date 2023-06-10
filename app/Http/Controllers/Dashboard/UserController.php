<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{

    public function index(){
        if(request()->ajax()){
            $users = User::query()->latest()->get();
            return DataTables::make($users)
                ->escapeColumns([])
                ->addIndexColumn()
                ->addColumn('image',function ($user){
                    if ($user->image == null) {
                        return '<img src="'. asset('assets/image/guest-user.jpg').'" class="img-thumbnail" alt="..." width="70" height="40">';
                    }else{
                        return '<img src="'.asset('storage/'.$user->image).'" class="img-thumbnail" alt="..." width="70" height="40">';
                    }

                })
                ->addColumn('status',function ($user){
                    if ($user->active == 0) {
                        return '<span class="label label-inline label-light-danger font-weight-bold">'. __('aside.not_active') .'</span>';
                    }else{
                        return '<span class="label label-inline label-light-success font-weight-bold">'. __('aside.active') .'</span>';
                    }

                })
                ->addColumn('actions',function ($user){
                    return $user->action_buttons;
                })
                ->rawColumns(['actions','image','status'])
                ->make();
        }
        return view('dashboard.users.index');
    }

    public function create(){
        return view('dashboard.users.create');
    }

    public function store(UserRequest $request){
        $path = "";
        $data = $request->except('_token','image','password');
        if($request->hasFile('image')){
            $data['image'] = uploadImage($request->file('image'),'users');
        }
        $data['password'] = Hash::make($request->password);
        $data['active'] = 1;

        $image_name = time() + rand(1, 1000000000) . '.svg';
        if(File::exists(storage_path('app/public/uploads/QRCodes'))){
            $path = storage_path('app/public/uploads/QRCodes/'.$image_name);
        }else{
            File::makeDirectory(storage_path('app/public/uploads/QRCodes'));
            $path = storage_path('app/public/uploads/QRCodes/'.$image_name);
        }
        $data['qrcode'] = $image_name;
        $user = User::query()->create($data);
        $qrCode = QrCode::size(250)->generate(route('admin.users.getQRCode',$user->id),$path);
        toastr()->success(__('aside.add_success'));
        return redirect()->route('admin.users');
    }

    public function edit($id){
        $user = User::query()->find($id);
        if(!$user){
            toastr()->error(__('aside.error'));
            return redirect()->route('admin.users');
        }
        return view('dashboard.users.edit',compact('user'));
    }

    public function update(UserRequest $request,$id){
        $data = $request->except('_token','image','password');
        $user = User::query()->find($id);
        if(!$user){
            toastr()->error(__('aside.error'));
            return redirect()->route('admin.users');
        }
        if($request->hasFile('image')){
            if($user->image != null){
                Storage::disk('public')->delete($user->image);
                $data['image'] = uploadImage($request->file('image'),'users');
            }else{
                $data['image'] = uploadImage($request->file('image'),'users');
            }
        }

        $data['password'] = $request->has('password') && $request->password != null ? Hash::make($request->password) : $user->password;

        $user->update($data);
        toastr()->success(__('aside.update_success'));
        return redirect()->route('admin.users');
    }

    public function destroy(Request $request){
        $user = User::query()->find($request->id);
        if(!$user){
            toastr()->error(__('aside.error'));
            return redirect()->route('admin.users');
        }
        Storage::disk('public')->delete($user->image);
        Storage::disk('public')->delete('uploads/QRCodes/'.$user->qrcode);
        $user->delete();
        return response()->json(['success' => true]);
    }

    public function changeStatus($id){
        $user = User::query()->find($id);
        if(!$user){
            toastr()->error(__('aside.error'));
            return redirect()->route('admin.users');
        }
        $user->update([
            'active' => $user->active === 0 ? 1 : 0
        ]);
        return response()->json(['active' => $user->active]);
    }

    public function generateQR($id){
        $user = User::query()->find($id);
        if(!$user){
            toastr()->error(__('aside.error'));
            return redirect()->route('admin.users');
        }

        return response()->json(['image' => $user->qrcode]);
    }

    public function get_QRCode($id){
        $user = User::query()->find($id);
        if(!$user){
            toastr()->error(__('aside.error'));
            return redirect()->route('admin.users');
        }
        return redirect()->route('admin.users.getQRCode',compact('user'));

    }
}
