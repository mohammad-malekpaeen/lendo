<?php

namespace App\Http\Controllers;

use App\Contracts\Mediator\DtoMediatorContract;
use App\Contracts\Services\UserServiceContract;
use App\Enum\FieldEnum;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {
    public function __construct(
        protected UserServiceContract $userService,
        protected DtoMediatorContract $dtoMediator,
    ) {
    }

    public function register(RegisterRequest $request) {
        $user = $this->userService->create(
            $this->dtoMediator->convertDataToUserDto(
                name: $request->input(FieldEnum::name->name),
                email: $request->input(FieldEnum::email->name),
                password: $request->input(FieldEnum::password->name),
            )
        );

        return response()->json($this->userService->generateToken($user));
    }

    public function login(LoginRequest $request) {

        $user = $this->userService->findByCondition([
            FieldEnum::email->value => $request->input(FieldEnum::email->name),
        ]);

        throw_if(empty($user), new ModelNotFoundException(trans('exception.user.not_exists')));

        $isHashCheck = Hash::check($request->input(FieldEnum::password->name), $user->password);
        throw_unless($isHashCheck, new ModelNotFoundException(trans('exception.user.not_exists')));

        return response()->json($this->userService->generateToken($user));
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out'
        ]);
    }
}
