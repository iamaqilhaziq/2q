<?php

namespace App\Models;

use App\Traits\Models\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory,
        SoftDeletes,
        HasMedia;

    protected $table = 'companies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'website',
    ];

    // export_file_name
    const CSV_PATH = 'export/company/csv/';
    const REPORT_FILE_NAME = 'Company-';    
}