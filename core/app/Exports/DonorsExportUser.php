<?php

namespace App\Exports;

use App\Models\Donor;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Auth;

class DonorsExportUser implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $ids = json_decode(Auth::guard('user')->user()->manage_agent_id);

        return view('user.donor.exportv', [
            'donors' => Donor::where('status', 1)->whereIn('agent_id', $ids)->get()
        ]);
    }
}
