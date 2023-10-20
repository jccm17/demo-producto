<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *  schema="Product",
 *  title="Product",
 *  	@OA\Property(
 * 		property="id",
 * 		type="integer",
 * 	),
 * 	@OA\Property(
 * 		property="name",
 * 		type="string"
 * 	),
 * 	@OA\Property(
 * 		property="description",
 * 		type="string"
 * 	),
 * @OA\Property(
 * 		property="code",
 * 		type="string"
 * 	),
 * @OA\Property(
 * 		property="price",
 * 		type="double"
 * 	)
 * )
 */
class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description",
        "price",
        "code"
    ];
}
