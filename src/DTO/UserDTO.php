<?php

namespace Imv\Sso\DTO;

class UserDTO extends BaseDTO
{
    public function __construct(
        public readonly bool $active,
        public readonly ?string $pinfl = null,
        public readonly ?string $sub = null,
        public readonly ?string $firstname = null,
        public readonly ?string $birth_date = null,
        public readonly ?bool $verified = null,
        public readonly ?string $doc_serial_number = null,
        public readonly ?string $lastname = null,
        public readonly ?string $patronymic = null,
        public readonly ?string $tin = null,
        public readonly ?string $phone_number = null,
        public readonly ?string $org_name = null,
    ) {}
}
