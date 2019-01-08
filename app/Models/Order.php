<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $table = 'order';
    protected $primaryKey = 'id';

    public function getIndexLists($id)
    {
        $data = $this->when($id != 1, function ($query) use ($id) {
            $query->where('user_id', $id);
        })->paginate(2);

        return $data;
    }

}
