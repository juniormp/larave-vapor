<?php


namespace App\Http\Controllers;


use App\Application\AskToPublishPrizeUseCase;
use App\Application\Commands\CreatePrizeCommand;
use App\Application\CreatePrizeUseCase;
use App\Application\DeletePrizeUseCase;
use App\Application\Response\CreatePrizeMapper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrizeController extends Controller
{
    private $createPrizeUseCase;
    private $deletePrizeUseCase;
    private $askToPublishPrizeUseCase;

    public function __construct(
        CreatePrizeUseCase $createPrizeUseCase,
        DeletePrizeUseCase $deletePrizeUseCase,
        AskToPublishPrizeUseCase $askToPublishPrizeUseCase)
    {
        $this->createPrizeUseCase = $createPrizeUseCase;
        $this->deletePrizeUseCase = $deletePrizeUseCase;
        $this->askToPublishPrizeUseCase = $askToPublishPrizeUseCase;
    }

    public function createOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:50', 'min:3'],
            'category' => ['required', 'string'],
            'description' => ['required', 'string', 'max:250'],
            'image' => ['required', 'string'],
            'artist_id' => ['required', 'int']
        ]);

        if ($validator->fails()) {
            return response()->json([
                "code" => "INPUT_VALIDATION_ERROR",
                "message" => "Some fields are not valid",
                "details" => $validator->errors()->messages()
            ], 400);
        }

        $createPrizeCommand = new CreatePrizeCommand(
            $validator->validated()['name'],
            $validator->validated()['category'],
            $validator->validated()['description'],
            $validator->validated()['image'],
            $validator->validated()['artist_id']
        );

        try {
            $prize = $this->createPrizeUseCase->execute($createPrizeCommand);

            return response()->json(CreatePrizeMapper::convertToJson($prize), 201);
        } catch (\Exception $e) {
            return response()->json([
                "code" => $e->getMessage(),
                "message" => "Some issue occurred when creating the prize",
            ], 500);
        }
    }

    public function delete(int $id)
    {
        try {
            $this->deletePrizeUseCase->execute($id);

            return response()->json([], 204);
        } catch (\Exception $e) {
            return response()->json([
                "code" => $e->getMessage(),
                "message" => "Some issue occurred when deleting the prize",
            ], 500);
        }
    }

    public function publish(int $id)
    {
        try {
            $this->askToPublishPrizeUseCase->execute($id);

            return response()->json([], 204);
        } catch (\Exception $e) {
            return response()->json([
                "code" => $e->getMessage(),
                "message" => "Some issue occurred when asking to be published",
            ]);
        }
    }
}
