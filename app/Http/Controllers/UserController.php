<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return UserResource::collection(User::all());
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !User::checkPassHash($request->password, $user->password)) {
            return response(null, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        Auth::login($user);
        $userRole = "USER";
        //todo migration
        if ($user->email === "admin@mail.ru"){
            $userRole = "ADMIN";
        }
        return response()->json([
            'user_id'=> $user->id,
            'user_token' => $this->generateToken($user),

            "user_role" => $userRole
        ])->setStatusCode(200);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        return [
            'content' => [
                'message' => 'Выход',
            ],
        ];
    }

    public function signup(SignupRequest $request)
    {
        $user = User::make($request->validated());
        $user->password = Hash::make($user->password, [
            'memory' => 1024,
            'time' => 2,
            'threads' => 2,
        ]);
//        /todo
        $user->avatar_src = "https://sun155-1.userapi.com/s/v1/ig2/mT_XLhlVBauQlejBKSk2DchjE4X8X6I2JiuBtrwaBb5fxZxPjqtfhOkfzt6q3wauyOMRDl5cfu2TEN9IOg8O4sH4.jpg?size=200x0&quality=96&crop=73,141,595,595&ava=1";
        $user->save();


        return response()->json([
            'user_token'  => $this->generateToken($user)
        ])->setStatusCode(201);
    }

    private function generateToken(User $user)
    {
        $abilities = [];
//todo if need admin role add migration
        if ($user->email == "admin@mail.ru") {
            $abilities = ["ADMIN"];
        }
        $token = $user->createToken(Hash::make(Str::random()), $abilities);
        return $token->plainTextToken;
    }
}
