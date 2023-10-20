<?php

namespace App\Models\Response;


use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *  schema="ResponseData"
 * )
 */
class ResponseData
{
    /**
     * @OA\Property(format="string")
     *
     * @var string
     */
    public $message;

    /**
     * @OA\Property(format="object")
     *
     * @var object
     */
    public $entity;

    /**
     * @OA\Property(default=false)
     *
     * @var bool
     */
    public $status;


}
