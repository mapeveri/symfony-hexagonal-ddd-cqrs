<?php

declare(strict_types=1);

namespace App\Shared\Domain\Criteria;

final class Filter
{
    public function __construct(
        private FilterField $field,
        private FilterOperator $operator,
        private FilterValue $value,
        private ?FilterFields $fields,
    ) {
    }

    public static function fromValues(array $values): self
    {
        return new self(
            new FilterField($values['field']),
            new FilterOperator($values['operator']),
            new FilterValue($values['value']),
            !empty($values['fields']) ? new FilterFields($values['fields']) : null,
        );
    }

    public function field(): FilterField
    {
        return $this->field;
    }

    public function operator(): FilterOperator
    {
        return $this->operator;
    }

    public function value(): FilterValue
    {
        return $this->value;
    }

    public function fields(): ?FilterFields
    {
        return $this->fields;
    }

    public function serialize(): string
    {
        return sprintf('%s.%s.%s', $this->field->value(), $this->operator->id(), $this->value->value());
    }
}