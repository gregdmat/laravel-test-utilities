<?php


namespace Gregdmat\LaravelTestUtilities\Mocker;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class ApiMocker
{
    protected $servers;

    public static function expectResponse(int $status)
    {
        cache()->put('ltu:nextMockResponse', $status);
    }

    public static function setUp()
    {
        if(app()->runningUnitTests()){
            foreach (config('ltu.api_mocks') as $openApi)
            {
                self::register($openApi);
            }
        }
    }

    private static function register($file)
    {
        $data = json_decode(file_get_contents(public_path($file)));
        $schemas = $data->components->schemas;

        foreach ($data->paths as $path => $methods)
        {
            foreach ($methods as $method => $options)
            {
                Route::$method('ltu/testing/' . $path, function () use ($options, $schemas) {
                    $expectResponse = cache()->has('ltu:nextMockResponse') ? cache()->pull('ltu:nextMockResponse') : 200;
                    return self::getResponse($expectResponse, $options, $schemas);
                });
            }
        }
    }

    private static function getResponse($expectStatus, $options, $schemas)
    {
        try{
            $component = $options->responses->$expectStatus->content->{'application/json'}->schema->{'$ref'};
            $component = str_replace('/', '', strrchr($component, '/'));
            $response = new \stdClass();
            foreach ($schemas->$component->properties as $key => $property)
            {
                $response->$key = $property->example;
            }
        }catch (\Throwable $e){
            throw new \Exception('Parse open api failed.');
        }

        return response()->json($response, $expectStatus);
    }

}
