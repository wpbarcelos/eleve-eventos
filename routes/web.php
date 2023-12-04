<?php

use App\Http\Controllers\ReportFinanceiroController;
use App\Http\Controllers\ReportPresencaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::redirect('/','/admin');

Route::get('export/financeiro', ReportFinanceiroController::class);

Route::get('export/presenca', ReportPresencaController::class);
