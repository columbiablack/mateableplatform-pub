<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\models;

    use mateable\core\db\Database;
    use mateable\core\Platform;

abstract class Model
{
    public const RULE_EMAIL = 'email';
    public const RULE_MATCH = 'match';
    public const RULE_DOB = 'dob';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_REQUIRED = 'required';
    public const RULE_UNIQUE = 'unique';
    public array $errors = [];

    protected static Database $db;

    abstract public function rules(): array;

    public function withDatabase(Database $db): static
    {
        self::$db = $db;
        return $this;
    }

    public static function setDatabase(Database $db): void
    {
        self::$db = $db;
    }

    public static function getDatabase(): ?Database
    {
        return self::$db ?? Platform::$app->db;
    }

    public function loadData($data): void
    {
        foreach($data as $key => $value)
        {
            if(property_exists($this, $key))
            {
                $this->{$key} = $value;
            }
        }
    }

    public function validate(): bool
    {
        foreach ($this->rules() as $attribute => $rules)
        {
            $value = $this->{$attribute};

            foreach($rules as $rule)
            {
                $ruleName = $rule;

                if(!is_string($ruleName))
                {
                    $ruleName = $rule[0];
                }

                if($ruleName === self::RULE_REQUIRED && !$value)
                {
                    $this->addErrorForRule($attribute, self::RULE_REQUIRED, $rule);
                }

                if($ruleName === self::RULE_MIN && strlen($value) < $rule['min'])
                {
                    $this->addErrorForRule($attribute, self::RULE_MIN, $rule);
                }

                if($ruleName === self::RULE_MAX && strlen($value) > $rule['max'])
                {
                    $this->addErrorForRule($attribute, self::RULE_MAX, $rule);
                }

                if($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']})
                {
                    $this->addErrorForRule($attribute, self::RULE_MATCH, $rule);
                }

                if($ruleName === self::RULE_EMAIL && !filter_var($value,FILTER_VALIDATE_EMAIL))
                {
                    $this->addErrorForRule($attribute, self::RULE_EMAIL, $rule);
                }

                if($ruleName === self::RULE_DOB && $this->dobCheck($value) < $rule['dob'])
                {
                    $this->addErrorForRule($attribute, self::RULE_DOB, $rule);
                }

                if ($ruleName === self::RULE_UNIQUE) {
                    $className = $rule['class'];
                    $uniqueAttr = $rule['attribute'] ?? $attribute;
                    $tableName = $className::tableName();
                    self::$db = $this->getDatabase();
                    $statement = self::$db->prepare("SELECT * FROM $tableName WHERE $uniqueAttr = :$uniqueAttr");
                    $statement->bindValue(":$uniqueAttr", $value);
                    $statement->execute();
                    $record = $statement->fetchObject();
                    if ($record) {
                        $this->addErrorForRule($attribute, self::RULE_UNIQUE,['field' => $this->getlabel($attribute)]);
                    }
                }
            }
        }
        return empty($this->errors);
    }

    private function addErrorForRule(string $attribute, string $rule, $params = []): void
    {
        $message = $this->errorMessages()[$rule] ?? '';

        if(isset($params) && is_array($params))
        {
            foreach ($params as $key => $value)
            {
                $message = str_replace("{{$key}}", $value, $message);
            }
        }

        $this->errors[$attribute][] = $message;
    }

    public function addError(string $attribute, string $message) : void
    {
        $this->errors[$attribute][] = $message;
    }

    public function errorMessages(): array
    {
        return [
            self::RULE_REQUIRED => 'This field is required.',
            self::RULE_EMAIL => 'This field must be a valid email address.',
            self::RULE_MATCH => 'This field must match {match}.',
            self::RULE_MAX => 'Maximum length for this field is {max}.',
            self::RULE_MIN => 'Minimum length for this field is {min}.',
            self::RULE_DOB => 'Must be {dob} or older.',
            self::RULE_UNIQUE => '{field} already exists or has to be unique.',
        ];
    }

    public function hasError($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError($attribute)
    {
        return $this->errors[$attribute][0] ?? false;
    }

    public function dobCheck($dob): string
    {
        $today = date("Y-m-d");
        $diff = date_diff(date_create($dob), date_create($today));
        return $diff->format('%y');
    }

    public function labels(): array
    {
        return [];
    }

    public function getLabel($attribute)
    {
        return $this->labels()[$attribute] ?? $attribute;
    }
}