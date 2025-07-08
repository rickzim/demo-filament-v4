<?php

namespace App\Enums;

enum AttributeFieldType: string
{
    case string = 'string';
    case integer = 'integer';
    case boolean = 'boolean';
    case decimal = 'decimal';
    case date = 'date';
}
