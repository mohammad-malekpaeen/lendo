<?php

namespace App\Contracts\Services;

use App\Dto\Repositories\UserDto;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
interface UserServiceContract extends BaseServiceContract {

    /**
     * @param UserDto $dto
     * @return Model|User
     */
    public function create(UserDto $dto): Model|User;

    public function generateToken(Model|User $user): array;

}
