<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    protected $fillable = ['company_id', 'ticket_code', 'device_type', 'device_brand', 'status', 'customer_name', 'customer_email', 'notes'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
