<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:Administrador'])->except('index');
    }

    public function index()
    {
        $this->authorize('index',new User());

        return view('user.index');
    }
    public function create()
    {
        $user = new User();
        $this->authorize('create',$user);
        $roles = Role::all();
        return view('user.create')->with(['roles' => $roles, 'user' => $user]);
    }
    public function store(UserStoreRequest $request)
    {
        $this->authorize('create',new User());
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'area' => $validated['area'],
            'password' => Hash::make($validated['password'])
        ]);

        $user->assignRole($validated['role']);
        Alert::success('Creado Correctamente');
        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        $this->authorize('edit',$user);
        $roles = Role::all();
        return view('user.create')->with(['user' => $user, 'roles' => $roles]);
    }

    public function update(UserStoreRequest $request, User $user)
    {
        $this->authorize($user);
        $validated = $request->validated();

        if (isset($validated['password'])) {

            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'area' => $validated['area'],
                'password' => Hash::make($validated['password'])
            ]);
        } else {
            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'area' => $validated['area']
            ]);
        }
        $user->syncRoles($validated['role']);

        Alert::success('Actualizado Correctamente');
        return redirect()->route('users.index');

    }

    public function destroy(User $user)
    {
    $this->authorize($user);
       $user->delete();
       Alert::success('Eliminado Correctamente');
       return redirect()->route('users.index');
    }
}
