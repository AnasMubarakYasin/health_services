<?php

namespace App\Dynamic\Resource;

class Definition
{
    public function __construct(
        public string $name,
        public string $type,
        public string|null $format = null,
        public bool $nullable = false,
        public bool $array = false,

        public mixed $default = null,
        public mixed $enums = null,
        public bool $multiple = false,
        public string|null $accept = null,
        public string|null $relation = null,
        public string|null $alias = null,
        public array|null $children = null,
    ) {
    }
    public function string_type(): string {
        return match ($this->format) {
            null => "string",
            default => $this->format,
        };
    }
    public function number_type(): string {
        return match ($this->format) {
            null => "number",
            default => $this->format,
        };
    }
    public function file_type(): string {
        return match ($this->format) {
            null => "document/*",
            default => $this->format,
        };
    }
    public function in_type_string(): bool {
        return in_array($this->type, ["email", "password", "tel", "url"]);
    }
}
