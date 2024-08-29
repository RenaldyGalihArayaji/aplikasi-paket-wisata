<?php

namespace App\Exports;

use App\Models\OrderPackage;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PackageExport implements FromView
{
    protected $packageStart;
    protected $packageEnd;

    public function __construct($packageStart, $packageEnd)
    {
        $this->packageStart = $packageStart;
        $this->packageEnd = $packageEnd;
    }

    public function view(): View
    {
        $packageData = OrderPackage::with(['package', 'user'])
            ->whereBetween('created_at', [$this->packageStart . ' 00:00:00', $this->packageEnd . ' 23:59:59'])
            ->latest()->get();

        return view('admin.report_package.cetak', [
            'packageData' => $packageData,
        ]);
    }
}
