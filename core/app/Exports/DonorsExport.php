<?php

namespace App\Exports;

use App\Models\Donor;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DonorsExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view('admin.donor.exportv', [
            'donors' => Donor::where('status', 1)->get()
        ]);
    }
}
