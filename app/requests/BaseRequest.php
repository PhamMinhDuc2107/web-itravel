<?php
class BaseRequest
{
    protected array $data;
    protected array $errors = [];

    public function __construct(array $data)
    {
        $this->data = $data;
        $this->validate();
    }

    // override trong class con
    public function rules(): array
    {
        return [];
    }

    // override trong class con để custom message
    public function messages(): array
    {
        return [];
    }

    protected function addError(string $field, string $rule, string $defaultMessage): void
    {
        $messages = $this->messages();
        $key = $field . '.' . $rule;

        $message = $messages[$key] ?? $defaultMessage;
        $this->errors[$field][] = $message;
    }

    protected function validate(): void
    {
        foreach ($this->rules() as $field => $rules) {
            $rules = explode('|', $rules);
            $value = $this->data[$field] ?? null;

            foreach ($rules as $rule) {
                // required
                if ($rule === 'required' && (is_null($value) || $value === '')) {
                    $this->addError($field, 'required', "$field is required");
                }

                // string
                if ($rule === 'string' && !is_string($value)) {
                    $this->addError($field, 'string', "$field must be a string");
                }

                // number
                if ($rule === 'number' && !is_numeric($value)) {
                    $this->addError($field, 'number', "$field must be a number");
                }

                // email
                if ($rule === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($field, 'email', "$field must be a valid email");
                }

                // phone
                if ($rule === 'phone' && !preg_match('/^(0[0-9]{9})$/', $value)) {
                    $this->addError($field, 'phone', "$field must be a valid phone number");
                }

                // hash
                if ($rule === 'hash' && !preg_match('/^[a-f0-9]{32}$|^[a-f0-9]{64}$/i', $value)) {
                    $this->addError($field, 'hash', "$field must be a valid hash string");
                }

                // min length
                if (str_starts_with($rule, 'min:')) {
                    $min = (int) explode(':', $rule)[1];
                    if (strlen((string)$value) < $min) {
                        $this->addError($field, 'min', "$field must be at least $min characters");
                    }
                }

                // max length
                if (str_starts_with($rule, 'max:')) {
                    $max = (int) explode(':', $rule)[1];
                    if (strlen((string)$value) > $max) {
                        $this->addError($field, 'max', "$field must be at most $max characters");
                    }
                }
                if (str_starts_with($rule, 'in:')) {
                    $allowed = explode(',', substr($rule, 3));
                    if (!in_array($value, $allowed)) {
                        $this->addError($field, 'in', "$field must be one of: " . implode(', ', $allowed));
                    }
                }
            }
        }
    }

    public function fails(): bool
    {
        return !empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function validated(): array
    {
        $valid = [];
        foreach ($this->rules() as $field => $rules) {
            $rules = explode('|', $rules);
            $value = $this->data[$field] ?? null;

            $isRequired = in_array('required', $rules);
            if (!$isRequired && ($value === null || $value === '')) {
                continue;
            }

            if ($value !== null && $value !== '') {
                $valid[$field] = $value;
            }
        }
        return $valid;
    }


}
