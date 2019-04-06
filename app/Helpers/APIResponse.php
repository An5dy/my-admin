<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

trait APIResponse
{
    protected $responseStatus = JsonResponse::HTTP_OK;

    protected $responseMessage = ResponseMessage::HTTP_OK;

    protected $responseHeaders = [];

    protected $responseData = [];

    public function setResponseStatus(int $status): self
    {
        $this->responseStatus = $status;

        return $this;
    }

    public function getResponseStatus(): int
    {
        return $this->responseStatus;
    }

    public function setResponseMessage(string $message): self
    {
        $this->responseMessage = $message;

        return $this;
    }

    public function getResponseMessage(): string
    {
        return $this->responseMessage;
    }

    public function setResponseHeaders(array $headers): self
    {
        $this->responseHeaders = $headers;

        return $this;
    }

    public function getResponseHeaders(): array
    {
        return $this->responseHeaders;
    }

    public function setResponseData($data = []): self
    {
        $this->responseData['data'] = $data;

        return $this;
    }

    public function getResponseData(): array
    {
        return $this->responseData;
    }

    public function respond(): JsonResponse
    {
        $commonData = [
            'code' => $this->getResponseStatus(),
            'message' => $this->getResponseMessage(),
        ];

        if ($data = $this->getResponseData()) {
            $commonData = array_merge($commonData, $data);
        }

        return Response::json($commonData, $this->getResponseStatus(), $this->getResponseHeaders());
    }

    public function succeedResponse(string $message = ResponseMessage::HTTP_OK,
                                    int $status = JsonResponse::HTTP_OK)
    {
        return $this->setResponseMessage($message)
            ->setResponseStatus($status)
            ->respond();
    }

    public function failedResponse(string $message = ResponseMessage::HTTP_INTERNAL_SERVER_ERROR,
                                   int $status = JsonResponse::HTTP_INTERNAL_SERVER_ERROR)
    {

        return $this->setResponseMessage($message)
            ->setResponseStatus($status)
            ->respond();
    }
}