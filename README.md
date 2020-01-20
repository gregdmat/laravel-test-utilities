## Instalation
```
composer require gregdmat/laravel-test-utilities

php artisan vendor:publish --tag=config
```

# Assert Structure and Value

- Basic usage
    - Use the ValidatorAsserts trait;
    - Call $this->assertStructureAndValue(array $structure, $data);
    - Add the reservation key '_rules' in the structure array; 
    
- Structure format example

```
[
    'name' => [
        '_rules' => ['required'],
        'first_name' => [
            '_rules' => ['required', new ExampleRule]
        ]
    ]
]
```
    
- For lists add '*' in the external key
   
 ```
[
    * => [
        'name' => ['_rules' => 'required']
    ]
]
 ```

- Avaible rules:
    - required
    - integer
    - bool
    - string
    - Rule class (see https://laravel.com/docs/6.x/validation#custom-validation-rules)
    - Bool closure

## Data Cases
    This feature provides several scenarios for a data type.

- Modify dataCases config to remove some data case.

- Types of data available.
    - String
    - Integer

- Basic usage:

```
$teste = new DataCases();
        
$teste->get([
    'attribute' => 'type',
    'name' => 'string'
]);
```    
        
- Avaible methods
    - get: return an array of cases
    
  ```
    $teste->get([
      'attribute' => 'type',
      'name' => 'string'
    ]);  
    ```

    - make: return an array of models (this require a Factory model, see: https://laravel.com/docs/6.x/database-testing)
          
    ```
      $teste->make(
        [
          'attribute' => 'type',
          'name' => 'string'
        ],
        Model::class
      );  
    ```
  
    - create: return an array of models and create in database (this require a Factory model, see: https://laravel.com/docs/6.x/database-testing)
          
    ```
      $teste->create(
        [
          'attribute' => 'type',
          'name' => 'string'
        ],
        Model::class
      );  
    ```
      
- Options
 
     When instantiating the DataCases class, it is possible to pass an array of options to the constructor.
        
```
$teste = new DataCases([
    [<case> => [
            <option> => value
        ]
    ],
    ['small' => [
            'size' => 1
        ]
    ],
    [
        except => ['small',long]
    ]
]);
```
     
 - Avaible options
 
 ```
    - except (array of name cases);
    - small.size;
    - normal.size;
    - long.size;
    - negative.min;
    - negative.max;
    - positive.min
    - positive.max
 ```
  - Avaible cases (see in the config file).
  
        
    

        

