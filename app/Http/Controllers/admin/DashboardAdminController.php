<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pet;
use App\Models\RekamMedis;
use App\Models\KodeTindakanTerapi;
use App\Models\Dokter;
use App\Models\Perawat;
use Illuminate\Support\Facades\DB;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // Basic stats
        $stats = [
            'users' => User::count(),
            'pets' => Pet::count(),
            'rekam_medis' => RekamMedis::count(),
            'tindakans' => KodeTindakanTerapi::count(),
            'dokters' => Dokter::count(),
            'perawats' => Perawat::count(),
        ];

        // Recent rekam medis (safely return empty collection if none)
        $recentRekam = RekamMedis::latest('created_at')->take(8)->get();

        // Monthly visits (grouped by YYYY-MM)
        $monthly = RekamMedis::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as ym, COUNT(*) as total")
            ->groupBy('ym')
            ->orderBy('ym')
            ->get();

        $monthlyLabels = $monthly->pluck('ym')->toArray();
        $monthlyTotals = $monthly->pluck('total')->toArray();

        $monthlyLabelsCsv = count($monthlyLabels) ? implode('|', $monthlyLabels) : '';
        $monthlyTotalsCsv = count($monthlyTotals) ? implode(',', $monthlyTotals) : '';

        // Pet distribution by ras (if tables exist)
        $petByRas = [];
        if (SchemaHasTables(['pet','ras_hewan'])) {
            // use actual column name in ras_hewan (likely 'nama_ras')
            $petByRas = DB::table('pet')
                ->join('ras_hewan','pet.idras_hewan','ras_hewan.idras_hewan')
                ->select('ras_hewan.nama_ras as ras', DB::raw('COUNT(*) as total'))
                ->groupBy('ras_hewan.nama_ras')
                ->orderByDesc('total')
                ->get();
        }

        $petLabels = $petByRas ? $petByRas->pluck('ras')->toArray() : [];
        $petValues = $petByRas ? $petByRas->pluck('total')->toArray() : [];

        $petLabelsCsv = count($petLabels) ? implode('|', $petLabels) : '';
        $petValuesCsv = count($petValues) ? implode(',', $petValues) : '';

        $data = [
            'rekamMediss' => $recentRekam,
        ];

        return view('admin.dashboardadmin', compact('stats','data','monthlyLabelsCsv','monthlyTotalsCsv','petLabelsCsv','petValuesCsv'));
    }
}

/**
 * Helper to check for table existence without throwing if connection/schema differs.
 */
function SchemaHasTables(array $tables)
{
    try {
        foreach ($tables as $t) {
            if (!DB::getSchemaBuilder()->hasTable($t)) {
                return false;
            }
        }
        return true;
    } catch (\Exception $e) {
        return false;
    }
}