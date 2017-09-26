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

    'accepted'             => 'Le champ :attribute doit être accepté.',
    'active_url'           => 'Le champ :attribute n\'est pas une URL valide.',
    'after'                => 'Le champ :attribute doit être une date ultérieure à :date.',
    'alpha'                => 'Le champ :attribute doit contenir seulement des lettres.',
    'alpha_dash'           => 'Le champ :attribute doit contenir seulement des lettres, des numéros, et des tirets.',
    'alpha_num'            => 'Le champ :attribute doit contenir seulement des lettres et des numéros.',
    'array'                => 'Le champ :attribute must be an array.',
    'before'               => 'Le champ :attribute doit être une date postérieure à :date.',
    'between'              => [
        'numeric' => 'Le champ :attribute doit être entre :min et :max.',
        'file'    => 'Le champ :attribute peser entre :min et :max kilobytes.',
        'string'  => 'Le champ :attribute doit comporter entre :min et :max caractères.',
        'array'   => 'Le champ :attribute doit compter entre :min et :max items.',
    ],
    'boolean'              => 'Le champ :attribute doit être vrai(true) ou faux(false).',
    'confirmed'            => 'La confirmation du champ :attribute ne concorde pas.',
    'date'                 => 'Le champ :attribute n\'est pas une date valide.',
    'date_format'          => 'Le champ :attribute ne concorde pas avec le format :format.',
    'different'            => 'Le champ :attribute et :other doivent être différents.',
    'digits'               => 'Le champ :attribute doit comporter :digits digits.',
    'digits_between'       => 'Le champ :attribute doit être une valeur entre :min et :max digits.',
    'distinct'             => 'Le champ :attribute a une valeur qui existe déjà.',
    'email'                => 'Le champ :attribute doit être une adresse courriel valide.',
    'exists'               => 'The selected :attribute est non valide.',
    'filled'               => 'Le champ :attribute est requis.',
    'image'                => 'Le champ :attribute doit être une image.',
    'in'                   => 'The selected :attribute est non valide.',
    'in_array'             => 'Le champ :attribute n\'existe pas dans :other.',
    'integer'              => 'Le champ :attribute doit être un nombre entier.',
    'ip'                   => 'Le champ :attribute doit être une adresse IP valide.',
    'json'                 => 'Le champ :attribute doit être un string JSON valide.',
    'max'                  => [
        'numeric' => 'Le champ :attribute ne doit pas excéder :max.',
        'file'    => 'Le champ :attribute ne doit pas excéder :max kilobytes.',
        'string'  => 'Le champ :attribute ne doit pas excéder :max caractères.',
        'array'   => 'Le champ :attribute ne peut comporter plus de :max items.',
    ],
    'mimes'                => 'Le champ :attribute doit être un fichier de type: :values.',
    'min'                  => [
        'numeric' => 'Le champ :attribute doit être au minimum :min.',
        'file'    => 'Le champ :attribute doit comporter un minimum de :min kilobytes.',
        'string'  => 'Le champ :attribute doit comporter un minimum de :min caractères.',
        'array'   => 'Le champ :attribute doit comporter un minimum de :min items.',
    ],
    'not_in'               => 'L\'attribut sélectionné :attribute est non valide.',
    'numeric'              => 'Le champ :attribute doit être un nombre.',
    'present'              => 'Le champ :attribute doit être présent.',
    'regex'                => 'Le format du champ :attribute est non valide.',
    'required'             => 'Le champ :attribute est requis.',
    'required_if'          => 'Le champ :attribute est requis lorsque :other est :value.',
    'required_unless'      => 'Le champ :attribute est requis tant que :other est dans :values.',
    'required_with'        => 'Le champ :attribute est requis lorsque :values est présent.',
    'required_with_all'    => 'Le champ :attribute est requis lorsque :values est présent.',
    'required_without'     => 'Le champ :attribute est requis lorsque :values n\'est pas présent.',
    'required_without_all' => 'Le champ :attribute est requis lorsque aucune valeur n\'a été choisie pour :values.',
    'same'                 => 'Le champ :attribute et :other doivent concorder.',
    'size'                 => [
        'numeric' => 'Le :attribute doit être de :size.',
        'file'    => 'Le :attribute doit être de :size kilobytes.',
        'string'  => 'Le champ :attribute doit contenir :size caractères.',
        'array'   => 'Le champ :attribute doit contenir :size items.',
    ],
    'string'               => 'Le champ :attribute doit être une chaîne de caractères(string).',
    'timezone'             => 'Le champ :attribute doit être une zone valide.',
    'unique'               => 'Le champ :attribute est déjà utilisé.',
    'url'                  => 'Le format du champ :attribute est non valide.',

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
                    'in' => 'Un style sélectionné est non valide.'
                ]
            ],
            'hairColor' => [
                'required' => 'Le champ couleur de cheveux est requis.',
                '*' => [
                    'in' => 'Une couleur de cheveux séectionnée est non valide.'
                ]
            ],
            'eyeColor' => [
                'required' => 'Le champ couleur des yeux est requis.',
                '*' => [
                    'in' => 'Une couleur de yeux séectionnée est non valide.'
                ]
            ],
            'skinColor' => [
                'required' => 'Le champ couleur de peau est requis.',
                '*' => [
                    'in' => 'Une couleur de peau séectionnée est non valide.'
                ]
            ],
            'bodyShape' => [
                'required' => 'Le champ forme de corps est requis.',
                '*' => [
                    'in' => 'Une forme de corps séectionnée est non valide.'
                ]
            ],
            'height' => [
                'required' => 'Le champ hauteur est requis.',
                'integer' => 'Le champ hauteur doit être une nombre'
            ],
            'weight' => [
                'required' => 'Le champ poids est requis',
                'integer' => 'Le champ poids doit être un nombre.'
            ],
            'weightUnit' => [
                'required' => 'Le champ unité de mesure de poids est requis.',
                '*' => [
                    'in' => 'Une unité de mesure de poids séectionnée est non valide.'
                ],
            ],
            'braBandSize' => [
                'required' => 'Le champ tour de taille est requis.',
                'string' => 'Le champ tour de taille est non valide.'
            ],
            'braCupSize' => [
                'required' => 'Le champ grosseur du bonnet est requis.',
                'string' => 'Le champ grosseur du bonnet est non valide.'
            ],
            'shoeSize' => [
                'required' => 'Le champ pointure est requis.',
                'numeric' => 'Le champ pointure doit être un nombre.'
            ],
            'allergies' => [
                'string' => 'Le champ allergies est non valide.'
            ],
            'pantsSize' => [
                'required' => 'Le champ grandeur de pantalons est requis.',
                'integer' => 'Le champ grandeur de pantalons doit être un nombre.'
            ],
            'favoritePants' => [
                'required' => 'Le champ pantalon favoris est requis.',
                '*' => [
                    'in' => 'Un pantalon favoris sélectionné est non valide.'
                ],
            ],
            'shirtSize' => [
                'required' => 'Le champ grandeur de chandail est requis.',
                'integer' => 'Le champ grandeur de chandail doit être un nombre.'
            ],
            'dressSize' => [
                'required' => 'Le champ grandeur de robe est requis.',
                'integer' => 'Le champ grandeur de robe doit être un nombre.'
            ],
            'piercedEars' => [
                'required' => 'Le champ oreilles percées est requis.',
                '*' => [
                    'boolean' => 'Le champ oreilles percées doit être oui ou non.'
                ]
            ],
            'excludedSkirts' => [
                '*' => [
                    'in' => 'Une jupe excluse est non valide.'
                ],
            ],
            'excludedPants' => [
                '*' => [
                    'in' => 'Un pantalon exclus est non valide.'
                ],
            ],
            'excludedTops' => [
                '*' => [
                    'in' => 'Un haut exclus est non valide.'
                ],
            ],
            'excludedNecks' => [
                '*' => [
                    'in' => 'Un collier exclus est non valide.'
                ],
            ],
            'excludedClothes' => [
                '*' => [
                    'in' => 'Un vêtement exclus est non valide.'
                ],
            ],
            'excludedColors' => [
                '*' => [
                    'in' => 'Une couleur excluse est non valide.'
                ],
            ],
            'photo' => [
                'image' => 'Le fichier téléversé doit être une image(jpeg, png, bmp, gif, or svg).',
                'max' => 'Le fichier téléversé ne doit pas dépasser 10 megaoctets.'
            ],
            'favoritePatterns' => [
                '*' => [
                    'in' => 'Un motif favoris sélectionné est non valide.'
                ],
            ],
            'favoriteAccessories' => [
                '*' => [
                    'in' => 'Une accessoire favoris sélectionné est non valide.'
                ],
            ],
            'favoriteColors' => [
                '*' => [
                    'in' => 'Une couleur favorite séectionnée est non valide.'
                ],
            ],
            'favoriteClothes' => [
                '*' => [
                    'in' => 'Un vêtement favoris sélectionné est non valide.'
                ],
            ],
            'brands' => [
                '*' => [
                    'in' => 'Une marque séectionnée est non valide.'
                ],
            ],
            'name' => [
                'required' => 'Le champ nom est requis.',
                'string' => 'Le champ nom est non valide.'
            ],
            'address' => [
                'required' => 'Le champ adresse est requis.',
                'string' => 'Le champ adresse est non valide.'
            ],
            'city' => [
                'required' => 'Le champ ville est requis.',
                'string' => 'Le champ ville est non valide.'
            ],
            'postal_code' => [
                'required' => 'Le champ code postal est requis.',
                'string' => 'Le champ code postal est non valide.'
            ],
            'province' => [
                'required' => 'Le champ province est requis.',
                'string' => 'Le champ province est non valide.',
                'in' => 'Le champ province est non valide.'
            ],
            'phone' => [
                'required' => 'Le champ téléphone est requis.',
                'string' => 'Le champ téléphone est non valide.'
            ],
            'contact_method' => [
                'required' => 'Le champ méthode de contact est requis.',
                'string' => 'Le champ méthode de contact est non valide.'
            ],
            'contact_hours' => [
                'required_if' => 'Le champ heures de contact est requis.',
                'string' => 'Le champ heures de contact est non valide.'
            ]
        ],
        'product' => [
            'required' => 'Vous devez mettre au moins un produit.',
            'brand' => [
                '*' => 'Le champ marque est vide sur une étiquette.'
            ],
            'name' => [
                '*' => 'Le champ nom est vide sur une étiquette.'
            ],
            'regular_price' => [
                '*' => 'Le champ prix régulier est vide sur une étiquette.'
            ],
        ],
        'fr' => [
            'title' => [
                'required' => 'Le champs titre en français est requis.'
            ],
            'image' => [
                'required' => 'Le champs image en français est requis.'
            ]
        ],
        'en' => [
            'title' => [
                'required' => 'Le champs titre en anglais est requis.'
            ],
            'image' => [
                'required' => 'Le champs image en anglais est requis.'
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
            'terms' => 'Termes et conditions',
            'birthday' => [
                'year' => 'année de naissance',
                'month' => 'mois de naissance',
                'day' => 'jour de naissance',
            ],
        ],
        'shipping_address' => 'Adresse de livraison',
        'billing_address' => 'Adresse de facturation',
    ],

    'dimensions' => 'Votre photo n\'est pas assez grandeur (largeur et hauteur minimum de 250px)',

];
