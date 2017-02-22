<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Pagination\LengthAwarePaginator;

class ApiController extends Controller
{

	// const HTTP_NOT_FOUND = 404;

    protected $statusCode = 200;

    /**
     * Gets the value of statusCode.
     *
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Sets the value of statusCode.
     *
     * @param mixed $statusCode the status code
     *
     * @return self
     */
    protected function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function responseNotFound($message = 'Not Found!')
    {
    	return $this->setStatusCode(Response::HTTP_NOT_FOUND)->respondWithError($message);
    }

    public function respondInvalidRequest($message = 'Invalid Request!')
    {
    	return $this->setStatusCode(422)->respondWithError($message);
    }


    public function respondInternalError($message = 'Internal Error')
    {
    	return $this->setStatusCode(500)->respondWithError($message);
    }

    public function respond($data, $headers = [])
    {
    	return response()->json($data, $this->getStatusCode(), $headers);
    }

    protected function respondWithPagination(LengthAwarePaginator $lessons, array $data)
    {

        $data = array_merge($data, [
            'paginator' => [
                'total_count' => $lessons->total(),
                'total_pages' => ceil($lessons->total() / $lessons->perPage()),
                'current_page' => $lessons->currentPage(),
                'limit' => $lessons->perPage()
            ]
        ]);

        return $this->respond($data);
    }

    public function respondWithError($message)
    {
    	return $this->respond([
			'error' => [
				'message' => $message,
				'status_code' => $this->getStatusCode()
			]
		]);
    }

    public function respondWithMessage($message='All is well.')
    {
    	return $this->respond([
			'response' => [
				'message' => $message,
				'status_code' => $this->getStatusCode()
			]
		]);
    }


}