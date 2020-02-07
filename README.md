
## Instalation

```
composer require gregdmat/laravel-test-utilities

php artisan ltu:intall
```

# Assert Structure and Value

- Basic usage
    - Use the ValidatorAsserts trait;
    - Call $this->assertStructureAndValue($rules, $data);
    - Rules like a Validator, see https://laravel.com/docs/6.x/validation#manually-creating-validators;
    
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
    'integer' => [
        'except' => ['negative', 'positive'],
        'positive.min' => 1,
        'positive.max' => 3,
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
  
        
    

        

