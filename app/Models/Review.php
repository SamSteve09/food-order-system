<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['rating', 'comment', 'review_date', 'customer_id', 'menu_item_id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class);
    }
}
