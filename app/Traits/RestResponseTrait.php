<?php

namespace App\Traits;

use App\Enums\StateEnum;

trait RestResponseTrait
{
  /**
     * Get the success status.
     */
    public function successStatus(): string
    {
        return StateEnum::SUCCESS->value;
    }

    /**
     * Get the error status.
     */
    public function errorStatus(): string
    {
        return StateEnum::ECHEC->value;
    }
}
