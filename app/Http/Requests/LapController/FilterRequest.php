<?php

namespace App\Http\Requests\LapController;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use App\FormulaOne\Services\API\Enums\LapDataType;
use Illuminate\Http\Exceptions\HttpResponseException;

class FilterRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'type'      => ['nullable', 'string', Rule::in(LapDataType::values())],
            'driver_ids' => ['nullable', 'sometimes', 'array'],
            'driver_ids.*' => ['integer', 'distinct'],
            'lap_from'  => 'nullable|integer|min:1|lte:lap_to',
            'lap_to'    => 'nullable|integer|min:1|gte:lap_from',
        ];
    }

    /**
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $allowedKeys = ['type', 'driver_ids', 'lap_from', 'lap_to'];

        $extraKeys = array_diff(array_keys($this->all()), $allowedKeys);

        if ($extraKeys) {
            $this->merge([
                '_invalid_keys' => $extraKeys,
            ]);
        }
    }

    /**
     * @param $validator
     * @return void
     */
    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            if ($this->has('_invalid_keys')) {
                foreach ($this->_invalid_keys as $key) {
                    $validator->errors()->add($key, "Unknown filter '$key'");
                }
            }

            $fromExists = $this->filled('lap_from');
            $toExists   = $this->filled('lap_to');

            if ($fromExists xor $toExists) {
                $validator->errors()->add(
                    'lap_range',
                    'Both lap_from and lap_to must be provided together, or both absent.'
                );
            }
        });
    }

    /**
     * @param Validator $validator
     * @return mixed
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'errors'  => $validator->errors(),
        ], 422));
    }
}
