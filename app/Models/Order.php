<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $table = 'order';
    protected $primaryKey = 'id';

    protected $guarded = [];

    public function getIndexLists($id, $search)
    {
        $data = $this->when($id != 1, function ($query) use ($id) {
            $query->where('user_id', $id);
        })->when($search, function ($query) use ($search) {
            $query->where('software_name', 'like', "%{$search}%");
        })->paginate(15);

        return $data;
    }

    public function getByIdOrder($id)
    {
        return $this->where('id', decodeId($id))
            ->first([
                'id', 'copyright_figure', 'serial_number', 'software_name',
                'deliveried_at', 'work_hours', 'price', 'out_at'
            ]);
    }

    public function updateOrder($id, $merge)
    {
        return $this->where('id', decodeId($id))->update($merge);
    }

    public function destroyOrder($id)
    {
        return $this->where('id', decodeId($id))->delete();
    }

}
