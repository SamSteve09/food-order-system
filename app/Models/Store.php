<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = ['address', 'phone_number'];

    public function staff()
    {
        return $this->hasMany(Staff::class);
    }

    public function storeTables()
    {
        return $this->hasMany(StoreTable::class);
    }
}
