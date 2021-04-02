<?php
namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponser

{
	/**
	 * Buid a success response
	 * @param string|array $data
	 * @param int $code
	 * @return Illuminate\Http\JsonResponse
	 */
	public function successResponse($data, $code = Response::HTTP_OK)
	{
		return response($data, $code)->header('Content-Type', 'application/json');
	}

	/**
	 * Buid a valid response
	 * @param string|array $data
	 * @param int $code
	 * @return Illuminate\Http\JsonResponse
	 */
	public function validResponse($data, $code = Response::HTTP_OK)
	{
		return response()->json(['data' => $data], $code);
	}

	/**
	 * Buid a error response
	 * @param string $message
	 * @param int $code
	 * @return Illuminate\Http\JsonResponse
	 */
	public function errorResponse($message, $code)
	{
		return response()->json(['error' => $message, 'code' => $code], $code);
	}

	/**
	 * Return an error in JSON format
	 * @param string $message
	 * @param int $code
	 * @return Illuminate\Http\Response
	 */
	public function errorMessage($message, $code)
	{
		return response()->json($message, $code)->header('Content-Type', 'application/json');
	}
}