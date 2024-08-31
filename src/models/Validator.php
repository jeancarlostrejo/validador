<?php

namespace Ferre\Validador\models;

use Exception;

class Validator
{
    private array $result;

    public function __construct(private $value)
    {
        $this->result = [];
    }

    public function isEmail(): self
    {
        if (!filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
            $this->includeValidatorError("Email not valid");
        }

        return $this;
    }

    public function isNumber(): self
    {
        if (!is_numeric($this->value)) {
            $this->includeValidatorError("Not a number");
        }

        return $this;
    }

    public function minLength(int $length): self
    {
        if (is_array($this->value)) {
            if (count($this->value) < $length) {
                $this->includeValidatorError("Not minimun length");
            }
        } else if (strlen((string) $this->value) < $length) {
            $this->includeValidatorError("Not minimun length");
        }

        return $this;
    }

    public function isUrl(): self
    {
        if (!filter_var($this->value, FILTER_VALIDATE_URL)) {
            $this->includeValidatorError("URL not valid");
        }

        return $this;
    }

    public function contains(array $options): self
    {
        $contains = false;

        if (!is_array($options)) {
            throw new Exception("Options variable is not an array");
        }

        foreach ($options as $option) {
            if (str_contains((string) $this->value, (string) $option)) {
                $contains = true;
            } else {
                $this->includeValidatorError("Value '{$option}' is not present");
            }
        }

        return $this;
    }

    public function isDate(): self
    {
        if (!strtotime($this->value)) {
            $this->includeValidatorError("Date not found");
        }

        return $this;
    }

    public function getErrors(): array
    {
        return $this->result;
    }

    public function includeValidatorError(string $text): void
    {
        $this->result[] = ["text" => $text, "value" => $this->value];
    }
}
