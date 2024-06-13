<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Http\Resources\JobPositionResource;
use App\Http\Resources\UserCollection;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\UserDetail;
use App\Models\User;
use App\Models\WorkUnit;
use App\Models\Position;
use App\Models\GroupPosition;
use App\Models\JobLevel;
use App\Models\JobPosition;
use App\Models\UserCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->filled('draw')) {
            if ($request->search) {
                return $this->getData($request);
            }
        }


        return view('dashboard.users.index', [
            'users' => User::all()
        ]);
    }

    public function getData($request)
    {
        $query = User::query();

        $query->with('jobPosition');

        if ($request->search) {
            $query->where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search['value'] . '%')->orWhere('email', 'like', '%' . $request->search['value'] . '%');
            });
        }

        $currentPage = ($request->start / $request->length) + 1;
        $paginate = $query->paginate($request->length, ['*'], 'paginate', $currentPage);

        return json_encode([
            "draw" => $request->draw,
            "recordsTotal" => $paginate->total(),
            "recordsFiltered" => $paginate->total(),
            "data" => new UserCollection($paginate)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $workUnit = WorkUnit::all();
        $groupPosition = GroupPosition::all();
        $position = Position::all();
        $userCategory = UserCategory::all();
        $jabatan = JobPosition::with('parent')->get();
        $level = JobLevel::all();


        return view('dashboard.users.create', [
            'workUnit' => $workUnit,
            'position' => $jabatan,
            'userCategory' => $userCategory,
            'groupPosition' => $groupPosition,
            'level' => $level
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|string|max:255|unique:users',
            'nik' => 'required|string|max:255|unique:users',
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'phone_number' => 'required|string|max:255|unique:users',
            'role' => 'required',
            'position_id' => 'required'
        ]);

        $users = User::create([
            'nip' => $request->input('nip'),
            'nik' => $request->input('nik'),
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'phone_number' => $request->input('phone_number'),
            'role' => $request->input('role'),
            'isActive' => true,
            'job_position_id' => $request->input('position_id')
        ]);

        return redirect('/users')->with('success', 'Pengguna baru telah dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserDetail  $userDetail
     * @return \Illuminate\Http\Response
     */
    public function show(UserDetail $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserDetail  $userDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $workUnit = WorkUnit::all();
        $groupPosition = GroupPosition::all();
        $userCategory = UserCategory::all();
        $jabatan = JobPosition::with('parent')->get();
        $level = JobLevel::all();

        return view('dashboard.users.create', [
            'workUnit' => $workUnit,
            'position' => $jabatan,
            'userCategory' => $userCategory,
            'groupPosition' => $groupPosition,
            'level' => $level,
            'user' => $user,
            'id' => $user->id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserDetail  $userDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validationRole = [
            'nip' => 'required|string|max:255|unique:users,nip,' . $user->id,
            'nik' => 'required|string|max:255|unique:users,nik,' . $user->id,
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone_number' => 'required|string|max:255|unique:users,phone_number,' . $user->id,
            'role' => 'required',
            'position_id' => 'required'
        ];

        if ($request->filled('password')) {
            array_push($validationRole, [
                'password' => 'required|string|min:6',
            ]);
        }

        if ($request->hasFile('photo')) {
            \array_push($validationRole, [
                'photo' => 'required|image|file|mimes:jpeg,png,jpg,gif|max:10000',
            ]);
        }

        $request->validate($validationRole);

        $newPhoto = $user->photo;
        $newPassword = $user->password;
        if ($request->filled('password')) {
            $newPassword = Hash::make($request->input('password'));
        }
        if ($request->hasFile('photo')) {
            Utils::removeFile($newPhoto);
            $newPhoto = Utils::singelUpload('user', $request->file('photo'));
        }
        $user->update([
            'nip' => $request->input('nip'),
            'nik' => $request->input('nik'),
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => $newPassword,
            'phone_number' => $request->input('phone_number'),
            'role' => $request->input('role'),
            'isActive' => true,
            'photo' => $newPhoto,
            'job_position_id' => $request->input('position_id')
        ]);

        return redirect('/users')->with('success', 'Pengguna telah diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserDetail  $userDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect('/users')->with('success', 'Pengguna telah dihapus!');
    }
}
