<?php

namespace App\Enums;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;

trait EnumHelperTrait
{

    public static function options($locale = null): array
    {
        $cases = static::cases();
        $options = [];
        foreach ($cases as $case) {
            if ($case->value == 'initial state') {
                continue;
            }
            $langKey = static::getLangKey($case);
            $optionLabel = Lang::get($langKey, [], $locale);
            $options[$case->value] = ($optionLabel != $langKey) ? $optionLabel : Str::title($case->value);
        }

        return $options;
    }

    public static function optionLabel($value = null, $locale = null): string|null
    {

        foreach (self::cases() as $case) {
            if ($case->value == $value) {
                $langKey = static::getLangKey($case);
                $optionLabel = Lang::get($langKey, [], $locale);
                return ($optionLabel != $langKey) ? $optionLabel : Str::title($case->value);
            }
        }
        return null;
    }

    public static function getLangKey($case)
    {
        return 'enums.' . static::class . '.' . $case->value;
    }

    public static function values(): array
    {
        return array_column(static::cases(), 'value');
    }

    public static function names(): array
    {
        return array_column(static::cases(), 'name');
    }

    public static function valueExists($value)
    {
        $values = static::values();
        return in_array($value, $values);
    }


}
