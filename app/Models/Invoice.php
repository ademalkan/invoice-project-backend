<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        "address_from", "city_from", "post_code_from", "country_from",
        "client_name", "client_email", "address_to", "city_to", "post_code_to", "country_to", "invoice_date",
        "payment_terms", "project_description", "status", "items", "key"
    ];


    protected $casts = [
        'items' => 'array',
    ];
}
