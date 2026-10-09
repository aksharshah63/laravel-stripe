<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    const STATUS_PENDING = 'pending';

    const STATUS_FAILED = 'failed';

    const STATUS_PAID = 'paid';
}
