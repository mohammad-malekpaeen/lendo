<?php

namespace App\Dto\Repositories;

use App\Dto\BaseDto;
use App\Enum\FieldEnum;

class UserDto extends BaseDto {

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     */
    public function __construct(
        protected string $name,
        protected string $email,
        protected string $password,
    ) {
    }

    public function getName(): string {
        return $this->name;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    /**
     * @return array
     */
    public function toArray(): array {
        return [
            FieldEnum::name->value  => $this->getName(),
            FieldEnum::email->value => $this->getEmail(),
            FieldEnum::password->value => $this->getPassword(),
        ];
    }

}
