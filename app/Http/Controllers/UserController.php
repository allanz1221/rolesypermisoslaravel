<?php

namespace App\Http\Controllers;

//use App\Events\UserCreated;
use App\Http\Controllers\Controller;
//use App\Http\Requests\StoreUserPost;
use App\Http\Requests\UpdateUserPut;
use App\Models\User;
use App\Models\Role;
use App\Models\Role_user;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator; 

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'name' => 'required|string|max:255',
            'expediente' => 'required|string|unique:users,expediente',
            'password' => 'required|string|min:8',
            'pe' => 'required|string|max:255',
            'rol' => 'required|string|max:255',
        ]);

        // Crear el usuario
        $user = User::create([
            'name' => $request->name,
            'expediente' => $request->expediente,
            'password' => Hash::make($request->password), // Encriptar la contraseña
            'pe' => $request->pe,
            'rol' => $request->rol,
        ]);

        // Devolver la respuesta en formato JSON
        return response()->json([
            'message' => 'Usuario creado exitosamente',
            'user' => $user
        ], 201);
    }

    public function index()
    {
        //
        //$users = User::with('role')->orderBy('created_at', 'desc')->paginate(10);
        $users = User::all();
        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        return view('users.create', compact('user'));
        //return view('dashboard.users.create', ['user' => new User()]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create(
            [
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]
        );
        $role = Role_user::create(
            [
                'user_id' => $user->id,
                'role_id' => 2,
            ]
        );

        return back()->with('status', 'Usuario creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // 
        return view('users.show', ['user' => $user]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // $this->authorize('edit', $user);
        return view('users.edit', compact('user'));
        //return view('dashboard.users.edit', ["user" => $user]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // $this->authorize('edit', $user);
        $user->update(
            [
                'name' => $request['name'],
                'email' => $request['email'],
            ]
        );
        return back()->with('status', 'Usuario actualizado con exito');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('status', 'Usuario eliminado con exito');
        //
    }
}
