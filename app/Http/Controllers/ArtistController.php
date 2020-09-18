<?php


namespace App\Http\Controllers;


use App\Application\Commands\CreateArtistCommand;
use App\Application\CreateArtistUseCase;
use App\Application\Response\CreateArtistMapper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArtistController extends Controller
{
    private $createArtistUseCase;

    public function __construct(CreateArtistUseCase $createArtistUseCase)
    {
        $this->createArtistUseCase = $createArtistUseCase;
    }

    public function createOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:50', 'min:3'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                "code" => "INPUT_VALIDATION_ERROR",
                "message" => "Some fields are not valid",
                "details" => $validator->errors()->messages()
            ], 400);
        }

        $createArtistCommand = new CreateArtistCommand(
            $validator->validated()['name'],
            $validator->validated()['email'],
            $validator->validated()['password']
        );

        try {
            $artist = $this->createArtistUseCase->execute($createArtistCommand);
        } catch (\Exception $e) {
            return response()->json([
                "code" => $e->getMessage(),
                "message" => "Some issue occurred when creating the artist",
            ], 500);
        }

        return response()->json(CreateArtistMapper::convertToJson($artist), 201);
    }
}
