<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Redirect setelah register
     */
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Validasi
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:USERS,EMAIL',
            'password' => 'required|string|min:8|confirmed',
        ]);
    }

    /**
     * Simpan user baru
     */
   protected function create(array $data)
    {
    $user = new User();

    $user->name = $data['name'];
    $user->email = $data['email'];
    $user->password = Hash::make($data['password']);

    // Default role
    $user->role = 'customer';

    $user->save();

    return $user;
    }
}
