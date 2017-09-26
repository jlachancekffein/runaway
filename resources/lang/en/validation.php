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

    'accepted'             => 'The :attribute must be accepted.',
    'active_url'           => 'The :attribute is not a valid URL.',
    'after'                => 'The :attribute must be a date after :date.',
    'alpha'                => 'The :attribute may only contain letters.',
    'alpha_dash'           => 'The :attribute may only contain letters, numbers, and dashes.',
    'alpha_num'            => 'The :attribute may only contain letters and numbers.',
    'array'                => 'The :attribute must be an array.',
    'before'               => 'The :attribute must be a date before :date.',
    'between'              => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file'    => 'The :attribute must be between :min and :max kilobytes.',
        'string'  => 'The :attribute must be between :min and :max characters.',
        'array'   => 'The :attribute must have between :min and :max items.',
    ],
    'boolean'              => 'The :attribute field must be true or false.',
    'confirmed'            => 'The :attribute confirmation does not match.',
    'date'                 => 'The :attribute is not a valid date.',
    'date_format'          => 'The :attribute does not match the format :format.',
    'different'            => 'The :attribute and :other must be different.',
    'digits'               => 'The :attribute must be :digits digits.',
    'digits_between'       => 'The :attribute must be between :min and :max digits.',
    'distinct'             => 'The :attribute field has a duplicate value.',
    'email'                => 'The :attribute must be a valid email address.',
    'exists'               => 'The selected :attribute is invalid.',
    'filled'               => 'The :attribute field is required.',
    'image'                => 'The :attribute must be an image.',
    'in'                   => 'The selected :attribute is invalid.',
    'in_array'             => 'The :attribute field does not exist in :other.',
    'integer'              => 'The :attribute must be an integer.',
    'ip'                   => 'The :attribute must be a valid IP address.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file'    => 'The :attribute may not be greater than :max kilobytes.',
        'string'  => 'The :attribute may not be greater than :max characters.',
        'array'   => 'The :attribute may not have more than :max items.',
    ],
    'mimes'                => 'The :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'The :attribute must be at least :min.',
        'file'    => 'The :attribute must be at least :min kilobytes.',
        'string'  => 'The :attribute must be at least :min characters.',
        'array'   => 'The :attribute must have at least :min items.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'numeric'              => 'The :attribute must be a number.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => 'The :attribute format is invalid.',
    'required'             => 'The :attribute field is required.',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => 'The :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'The :attribute must be :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => 'The :attribute must be :size characters.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => 'The :attribute must be a string.',
    'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => 'The :attribute has already been taken.',
    'url'                  => 'The :attribute format is invalid.',

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
        'preferences' => [
            'styles' => [
                '*' => [
                    'in' => 'A selected style is invalid.'
                ]
            ],
            'hairColor' => [
                'required' => 'The hair color field is required.',
                '*' => [
                    'in' => 'A selected hair color is invalid.'
                ]
            ],
            'eyeColor' => [
                'required' => 'The eye color field is required.',
                '*' => [
                    'in' => 'A selected eye color is invalid.'
                ]
            ],
            'skinColor' => [
                'required' => 'The skin color field is required.',
                '*' => [
                    'in' => 'A selected skin color is invalid.'
                ]
            ],
            'bodyShape' => [
                'required' => 'The body shape field is required.',
                '*' => [
                    'in' => 'A selected body shape is invalid.'
                ]
            ],
            'height' => [
                'required' => 'The height field is required.',
                'integer' => 'The height field must be an integer.'
            ],
            'weight' => [
                'required' => 'The weight field is required.',
                'integer' => 'The weight field must be an integer.'
            ],
            'weightUnit' => [
                'required' => 'The weight unit field is required.',
                '*' => [
                    'in' => 'A selected weight unit is invalid.'
                ],
            ],
            'braBandSize' => [
                'required' => 'The bra band size field is required.',
                'string' => 'The bra band size field is invalid.'
            ],
            'braCupSize' => [
                'required' => 'The bra cup size field is required.',
                'string' => 'The bra cup size field is invalid.'
            ],
            'shoeSize' => [
                'required' => 'The shoe size field is required.',
                'numeric' => 'The pants size field must be a number.'
            ],
            'allergies' => [
                'string' => 'The allergies field is invalid.'
            ],
            'pantsSize' => [
                'required' => 'The pants size field is required.',
                'integer' => 'The pants size field must be an integer.'
            ],
            'favoritePants' => [
                'required' => 'The favorite pants field is required.',
                '*' => [
                    'in' => 'A selected favorite pants is invalid.'
                ],
            ],
            'shirtSize' => [
                'required' => 'The shirt size field is required.',
                'integer' => 'The shirt size field must be an integer.'
            ],
            'dressSize' => [
                'required' => 'The dress size field is required.',
                'integer' => 'The dress size field must be an integer.'
            ],
            'piercedEars' => [
                'required' => 'The pierced ears field is required.',
                '*' => [
                    'boolean' => 'The pierced ears field must be yes or no.'
                ]
            ],
            'excludedSkirts' => [
                '*' => [
                    'in' => 'An excluded skirt is invalid.'
                ],
            ],
            'excludedPants' => [
                '*' => [
                    'in' => 'An excluded pants is invalid.'
                ],
            ],
            'excludedTops' => [
                '*' => [
                    'in' => 'An excluded top is invalid.'
                ],
            ],
            'excludedNecks' => [
                '*' => [
                    'in' => 'An excluded neck is invalid.'
                ],
            ],
            'excludedClothes' => [
                '*' => [
                    'in' => 'An excluded cloth is invalid.'
                ],
            ],
            'excludedColors' => [
                '*' => [
                    'in' => 'An excluded color is invalid.'
                ],
            ],
            'photo' => [
                'image' => 'The uploaded file must be an image (jpeg, png, bmp, gif, or svg).',
                'max' => 'The uploaded file may not be greater than 10 megabytes.'
            ],
            'favoritePatterns' => [
                '*' => [
                    'in' => 'A selected favorite pattern is invalid.'
                ],
            ],
            'favoriteAccessories' => [
                '*' => [
                    'in' => 'A selected favorite accessory is invalid.'
                ],
            ],
            'favoriteColors' => [
                '*' => [
                    'in' => 'A selected favorite color is invalid.'
                ],
            ],
            'favoriteClothes' => [
                '*' => [
                    'in' => 'A selected favorite cloth is invalid.'
                ],
            ],
            'brands' => [
                '*' => [
                    'in' => 'A selected brand is invalid.'
                ],
            ],
            'name' => [
                'required' => 'The name field is required.',
                'string' => 'The name field is invalid.'
            ],
            'address' => [
                'required' => 'The address field is required.',
                'string' => 'The address field is invalid.'
            ],
            'city' => [
                'required' => 'The city field is required.',
                'string' => 'The city field is invalid.'
            ],
            'postal_code' => [
                'required' => 'The postal code field is required.',
                'string' => 'The postal code field is invalid.'
            ],
            'province' => [
                'required' => 'The province field is required.',
                'string' => 'The province field is invalid.',
                'in' => 'The province field is invalid.'
            ],
            'phone' => [
                'required' => 'The phone field is required.',
                'string' => 'The phone field is invalid.'
            ],
            'contact_method' => [
                'required' => 'The contact method field is required.',
                'string' => 'The contact method field is invalid.'
            ],
            'contact_hours' => [
                'required_if' => 'The contact hours field is required.',
                'string' => 'The contact hours field is invalid.'
            ]
        ],
        'product' => [
            'required' => 'You must put at least one product.',
            'brand' => [
                '*' => 'The brand field is empty on a tag.'
            ],
            'name' => [
                '*' => 'The name field is empty on a tag.'
            ],
            'regular_price' => [
                '*' => 'The regular price field is empty on a tag.'
            ],
        ],
        'fr' => [
            'title' => [
                'required' => 'The french title field is required.'
            ],
            'image' => [
                'required' => 'The french image field is required.'
            ]
        ],
        'en' => [
            'title' => [
                'required' => 'The english title field is required.'
            ],
            'image' => [
                'required' => 'The english image field is required.'
            ]
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'preferences' => [
            'birthday' => [
                'year' => 'birth year',
                'month' => 'birth month',
                'day' => 'birthday day',
            ],
        ],
    ],

    'dimensions' => 'Your picture is too small (minimum width and height should be 250px)',

];
