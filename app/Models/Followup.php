<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Followup extends Model
{
    protected $fillable = ['query_id', 'fdate', 'fcomment'];

    public function relatedQuery()
    {
        return $this->belongsTo(Queries::class, 'query_id');
    }
}
