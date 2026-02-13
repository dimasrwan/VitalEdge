<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class HealthController extends Controller
{
    public function index() {
        $user = auth()->user();
        $userId = $user->id ?? null;

        // Ambil history logs
        $logs = DB::table('health_logs')
                ->where('user_id', $userId)
                ->orderBy('created_at', 'desc')
                ->take(5)->get();

        // Inisialisasi variabel default
        $latestLog = $logs->first();
        $bmi = null;
        $bmiLabel = 'Data Belum Lengkap';
        $calorieTarget = 0; // Inisialisasi target kalori

        // Hitung BMI & Kalori berdasarkan log terbaru dan tinggi badan user
        if ($latestLog && isset($user->height) && $user->height > 0) {
            // 1. Logika BMI
            $heightInMeters = $user->height / 100;
            $bmi = round($latestLog->weight / ($heightInMeters * $heightInMeters), 1);

            if ($bmi < 18.5) $bmiLabel = 'Underweight';
            elseif ($bmi < 25) $bmiLabel = 'Ideal';
            elseif ($bmi < 30) $bmiLabel = 'Overweight';
            else $bmiLabel = 'Obesity';

            // 2. Logika Target Kalori (Estimasi Dasar: Berat x 30 kkal)
            $calorieTarget = $latestLog->weight * 30;
        }

        $chartData = DB::table('health_logs')
                    ->where('user_id', $userId)
                    ->orderBy('created_at', 'asc')
                    ->take(10)->get();

        return view(auth()->check() ? 'dashboard' : 'welcome', 
            compact('logs', 'chartData', 'bmi', 'bmiLabel', 'calorieTarget')); // Kirim calorieTarget ke view
    }

    public function store(Request $request) {
        // 1. Validasi input
        $request->validate([
            'weight' => 'required|numeric',
            'height' => 'required|numeric|min:50|max:300',
        ]);

        $user = auth()->user();

        // 2. Update Tinggi Badan di tabel Users
        $user->update([
            'height' => $request->height
        ]);

        // 3. Hitung target air (35ml per kg berat badan)
        $waterTarget = ($request->weight * 35) / 1000;

        // 4. Simpan Log Berat Badan
        DB::table('health_logs')->insert([
            'user_id' => $user->id,
            'weight' => $request->weight,
            'water_target' => $waterTarget,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Biometri tubuh berhasil diperbarui!');
    }

    public function destroy($id) {
        DB::table('health_logs')
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->delete();
            
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }

    public function exportPdf() {
    $user = auth()->user();
    $logs = DB::table('health_logs')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

    // Hitung data ringkasan untuk PDF
    $latest = $logs->first();
    $heightInMeters = $user->height / 100;
    $bmi = $latest ? round($latest->weight / ($heightInMeters * $heightInMeters), 1) : null;

    $pdf = Pdf::loadView('pdf.report', compact('user', 'logs', 'bmi'));
    
    return $pdf->download('VitalEdge_Report_' . $user->name . '.pdf');
}
}