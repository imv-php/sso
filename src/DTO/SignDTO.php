<?php

namespace Imv\Sso\DTO;

class SignDTO extends BaseDTO
{
    public function __construct(
        public readonly bool $success,
        public readonly ?string $error = null,
        public readonly ?string $sign = null,
    ) {}
}
