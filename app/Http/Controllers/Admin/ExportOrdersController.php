<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Shipping\PostCanadaShippingAddress;
use Response;

class ExportOrdersController extends Controller
{

    public function exportPaidOrdersForPostCanada()
    {
        $transactions = Transaction::paid()->get();

        return Response::make(
            PostCanadaShippingAddress::exportToCsv($transactions),
            200,
            [
                'Content-Type' => 'text/cvs',
                'Content-Disposition' => 'attachment; filename=export_post_canada_' . date('Y-m-d_H-m-s') . '.csv'
            ]
        );
    }

}
