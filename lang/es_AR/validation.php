<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Este campo debe ser aceptado.',
    'accepted_if' => 'Este campo debe ser aceptado cuando :other es :value.',
    'active_url' => 'Este campo debe ser una URL válida.',
    'after' => 'Este campo debe contener una fecha posterior a :date.',
    'after_or_equal' => 'Este campo debe contener una fecha igual o posterior a :date.',
    'alpha' => 'Este campo solo puede contener letras.',
    'alpha_dash' => 'Este campo solo puede contener letras, números, guiones y guiones bajos.',
    'alpha_num' => 'Este campo solo puede contener letras y números.',
    'array' => 'Este campo debe ser un arreglo.',
    'ascii' => 'Este campo solo puede contener caracteres alfanuméricos de un solo byte y símbolos.',
    'before' => 'Este campo debe contener una fecha anterior a :date.',
    'before_or_equal' => 'Este campo debe contener una fecha igual o anterior a :date.',
    'between' => [
        'array' => 'Este campo debe tener entre :min y :max elementos.',
        'file' => 'Este campo debe tener un tamaño entre :min y :max kilobytes.',
        'numeric' => 'Este campo debe estar entre :min y :max.',
        'string' => 'Este campo debe tener entre :min y :max caracteres.',
    ],
    'boolean' => 'Este campo debe ser verdadero o falso.',
    'can' => 'Este campo contiene un valor no autorizado.',
    'confirmed' => 'La confirmación no coincide con este campo.',
    'current_password' => 'La contraseña actual es incorrecta.',
    'date' => 'Este campo debe ser una fecha válida.',
    'date_equals' => 'Este campo debe ser una fecha igual a :date.',
    'date_format' => 'Este campo debe coincidir con el formato :formato.',
    'decimal' => 'Este campo debe tener :decimal lugares decimales.',
    'declined' => 'Este campo debe ser rechazado.',
    'declined_if' => 'Este campo debe ser rechazado cuando :other sea :value.',
    'different' => 'Este campo y :other deben ser diferentes.',
    'digits' => 'Este campo debe tener :digits dígitos.',
    'digits_between' => 'Este campo debe tener entre :min y :max dígitos.',
    'dimensions' => 'Las dimensiones de la imagen en este campo son inválidas.',
    'distinct' => 'Este campo tiene un valor duplicado.',
    'doesnt_end_with' => 'Este campo no debe terminar con :values.',
    'doesnt_start_with' => 'Este campo no debe comenzar con :values.',
    'email' => 'Este campo debe ser una dirección de correo electrónico válida.',
    'ends_with' => 'Este campo debe terminar con uno de los siguientes: :values.',
    'enum' => 'El valor seleccionado en este campo es inválido.',
    'exists' => 'El valor seleccionado en este campo es inválido.',
    'file' => 'Este campo debe ser un archivo.',
    'filled' => 'Este campo debe tener un valor.',
    'gt' => [
        'array' => 'Este campo debe tener más de :value elementos.',
        'file' => 'El tamaño de este campo debe ser mayor a :value kilobytes.',
        'numeric' => 'Este campo debe ser mayor a :value.',
        'string' => 'Este campo debe tener más de :value caracteres.',
    ],
    'gte' => [
        'array' => 'Este campo debe tener :value elementos o más.',
        'file' => 'El tamaño de este campo debe ser igual o mayor a :value kilobytes.',
        'numeric' => 'Este campo debe ser igual o mayor a :value.',
        'string' => 'Este campo debe tener :value caracteres o más.',
    ],
    'image' => 'Este campo debe ser una imagen.',
    'in' => 'El valor seleccionado en este campo es inválido.',
    'in_array' => 'Este campo debe existir en :other.',
    'integer' => 'Este campo debe ser un número entero.',
    'ip' => 'Este campo debe ser una dirección IP válida.',
    'ipv4' => 'Este campo debe ser una dirección IPv4 válida.',
    'ipv6' => 'Este campo debe ser una dirección IPv6 válida.',
    'json' => 'Este campo debe ser una cadena JSON válida.',
    'lowercase' => 'Este campo debe estar en minúsculas.',
    'lt' => [
        'array' => 'Este campo debe tener menos de :value elementos.',
        'file' => 'El tamaño de este campo debe ser menor a :value kilobytes.',
        'numeric' => 'Este campo debe ser menor a :value.',
        'string' => 'Este campo debe tener menos de :value caracteres.',
    ],
    'lte' => [
        'array' => 'Este campo no debe tener más de :value elementos.',
        'file' => 'El tamaño de este campo debe ser igual o menor a :value kilobytes.',
        'numeric' => 'Este campo debe ser igual o menor a :value.',
        'string' => 'Este campo debe tener :value caracteres o menos.',
    ],
    'mac_address' => 'Este campo debe ser una dirección MAC válida.',
    'max' => [
        'array' => 'Este campo no debe tener más de :max elementos.',
        'file' => 'El tamaño de este campo no debe ser mayor a :max kilobytes.',
        'numeric' => 'Este campo no debe ser mayor a :max.',
        'string' => 'Este campo no debe tener más de :max caracteres.',
    ],
    'max_digits' => 'Este campo no debe tener más de :max dígitos.',
    'mimes' => 'Este campo debe ser un archivo de tipo: :values.',
    'mimetypes' => 'Este campo debe ser un archivo de tipo: :values.',
    'min' => [
        'array' => 'Este campo debe tener al menos :min elementos.',
        'file' => 'El tamaño de este campo debe ser al menos :min kilobytes.',
        'numeric' => 'Este campo debe ser al menos :min.',
        'string' => 'Este campo debe tener al menos :min caracteres.',
    ],
    'min_digits' => 'Este campo debe tener al menos :min dígitos.',
    'missing' => 'Este campo debe estar ausente.',
    'missing_if' => 'Este campo debe estar ausente cuando :other sea :value.',
    'missing_unless' => 'Este campo debe estar ausente a menos que :other sea :value.',
    'missing_with' => 'Este campo debe estar ausente cuando :values está presente.',
    'missing_with_all' => 'Este campo debe estar ausente cuando :values están presentes.',
    'multiple_of' => 'Este campo debe ser un múltiplo de :value.',
    'not_in' => 'El valor seleccionado en este campo es inválido.',
    'not_regex' => 'El formato de este campo es inválido.',
    'numeric' => 'Este campo debe ser un número.',
    'password' => [
        'letters' => 'Este campo debe contener al menos una letra.',
        'mixed' => 'Este campo debe contener al menos una letra mayúscula y una letra minúscula.',
        'numbers' => 'Este campo debe contener al menos un número.',
        'symbols' => 'Este campo debe contener al menos un símbolo.',
        'uncompromised' => 'El valor proporcionado ha aparecido en una fuga de datos. Por favor, elija un valor diferente.',
    ],
    'present' => 'Este campo debe estar presente.',
    'prohibited' => 'Este campo está prohibido.',
    'prohibited_if' => 'Este campo está prohibido cuando :other sea :value.',
    'prohibited_unless' => 'Este campo está prohibido a menos que :other esté en :values.',
    'prohibits' => 'Este campo prohíbe que :other esté presente.',
    'regex' => 'El formato de este campo es inválido.',
    'required' => 'Este campo es obligatorio.',
    'required_array_keys' => 'Este campo debe contener entradas para: :values.',
    'required_if' => 'Este campo es obligatorio cuando :other sea :value.',
    'required_if_accepted' => 'Este campo es obligatorio cuando :other sea aceptado.',
    'required_unless' => 'Este campo es obligatorio a menos que :other esté en :values.',
    'required_with' => 'Este campo es obligatorio cuando :values está presente.',
    'required_with_all' => 'Este campo es obligatorio cuando :values están presentes.',
    'required_without' => 'Este campo es obligatorio cuando :values no está presente.',
    'required_without_all' => 'Este campo es obligatorio cuando ninguno de :values está presente.',
    'same' => 'Este campo debe coincidir con :other.',
    'size' => [
        'array' => 'Este campo debe contener :size elementos.',
        'file' => 'Este campo debe ser :size kilobytes.',
        'numeric' => 'Este campo debe ser :size.',
        'string' => 'Este campo debe tener :size caracteres.',
    ],
    'starts_with' => 'Este campo debe empezar con uno de los siguientes: :values.',
    'string' => 'Este campo debe ser una cadena.',
    'timezone' => 'Este campo debe ser una zona horaria válida.',
    'unique' => 'Este campo ya ha sido tomado.',
    'uploaded' => 'La carga en este campo ha fallado.',
    'uppercase' => 'Este campo debe estar en mayúsculas.',
    'url' => 'Este campo debe ser una URL válida.',
    'ulid' => 'Este campo debe ser un ULID válido.',
    'uuid' => 'Este campo debe ser un UUID válido.',




    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
