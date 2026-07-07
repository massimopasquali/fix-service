<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Billable;

class Company extends Model
{
    protected $fillable = ['name', 'vat_number', 'email', 'phone', 'address'];

    public function repairs()
    {
        return $this->hasMany(Repair::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
