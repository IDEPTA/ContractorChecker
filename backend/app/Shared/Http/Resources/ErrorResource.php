<?php

namespace App\Shared\Http\Resources;

use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Validation\ValidationException;

class ErrorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'message' => $this->getMessage(),
            'success' => false
        ];
    }

    /**
     * Получить HTTP статус-код на основе типа исключения.
     *
     * @return int
     */
    protected function statusCode(): int
    {
        if ($this->resource instanceof ModelNotFoundException) {
            return 404;
        }

        if ($this->resource instanceof FileNotFoundException) {
            return 404;
        }

        if ($this->resource instanceof ValidationException) {
            return $this->status;
        }

        if (method_exists($this->resource, 'getStatusCode')) {
            return $this->resource->getStatusCode();
        }

        return 500;
    }

    /**
     * Transform the resource into a response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request)
    {
        return response()->json($this->toArray($request), $this->statusCode());
    }
}
