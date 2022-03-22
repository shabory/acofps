<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const QEOUD_REGISTERD_RADIO = [
        'false' => 'لا',
        'true'  => 'نعم',
    ];

    public const PAYMENT_METHOD_SELECT = [
        'bank transfer' => 'تحويل بنكي',
        'CC'            => 'بطاقة إئتمان',
        'other'         => 'طريقة أخرى',
    ];

    public $table = 'invoices';

    protected $dates = [
        'payment_time',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'amount',
        'payment_time',
        'payment_method',
        'payment_refrence',
        'qeoud_registerd',
        'qeoud_number',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function invoiceOrders()
    {
        return $this->hasMany(Order::class, 'invoice_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getPaymentTimeAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setPaymentTimeAttribute($value)
    {
        $this->attributes['payment_time'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
