<?php

namespace App\Services;

use App\Contracts\Repositories\UserRepositoryContract;
use App\Contracts\Services\UserServiceContract;
use App\Dto\Repositories\UserDto;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserService extends BaseService implements UserServiceContract {

    /**
     * @param UserRepositoryContract $repository
     */
    public function __construct(UserRepositoryContract $repository) {
        parent::__construct($repository);
    }

    public function create(UserDto $dto): Model|User {
        return $this->repository->create($dto->toArray());
    }

    public function generateToken(Model|User $user): array{
        $token = $user->createToken('auth_token')->plainTextToken;
        return [
            'access_token' => $token,
            'token_type' => 'Bearer',
        ];
    }
}
