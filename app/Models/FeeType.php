<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeType extends Model
{
    // Table associated with the model (if different from default)
    protected $table = 'fee_types';

    // Primary key (if different from default 'id')
    protected $primaryKey = 'fee_type_id';

    // If you want to allow mass assignment on specific fields, define the fillable array
    protected $fillable = ['fee_name'];

    // Define the relationship with FeeDetail model (one-to-many)
    public function feeDetails()
    {
        return $this->hasMany(FeeDetail::class, 'fee_type_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'fee_type_id', 'fee_type_id');
    }


}
