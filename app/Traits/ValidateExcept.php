<?php

namespace App\Traits;

trait ValidateExcept
{
    public function validateExcept(string $property, array $rules): array
    {
        // Remove given property from validation rules
        $filteredRules = array_diff_key($rules, [$property => '']);

        // Validate the remaining fields
        return $validated = $this->validate($filteredRules);
    }
}
