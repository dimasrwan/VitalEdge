@extends('layouts.vital')
@section('title', 'Dashboard')

@section('content')
<main class="max-w-6xl mx-auto px-6 py-12">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
        <div class="bg-gray-900/50 p-8 rounded-2xl neon-border text-center">
            <p class="text-xs text-gray-500 uppercase tracking-widest mb-2">Body Mass Index (BMI)</p>
            <h2 class="text-5xl font-bold accent-color">{{ $bmi ?? '--' }}</h2>
            
            <span class="inline-block mt-3 px-4 py-1 rounded-full text-[10px] font-black uppercase tracking-widest
                {{ $bmiLabel == 'Ideal' ? 'bg-green-500/20 text-green-400' : '' }}
                {{ $bmiLabel == 'Underweight' ? 'bg-yellow-500/20 text-yellow-400' : '' }}
                {{ $bmiLabel == 'Overweight' ? 'bg-orange-500/20 text-orange-400' : '' }}
                {{ $bmiLabel == 'Obesity' ? 'bg-red-500/20 text-red-400' : '' }}
                {{ $bmiLabel == 'Data Belum Lengkap' ? 'bg-white/10 text-gray-400' : '' }}">
                {{ $bmiLabel }}
            </span>
        </div>
        
        <div class="bg-gray-900/50 p-8 rounded-2xl border border-gray-800 text-center">
            <p class="text-xs text-gray-500 uppercase tracking-widest mb-2">Tinggi Badan Saat Ini</p>
            <h2 class="text-5xl font-bold text-white">{{ auth()->user()->height ?? '0' }} <span class="text-sm font-light">cm</span></h2>
            <p class="text-[10px] text-gray-500 mt-3 uppercase tracking-widest italic">Sinkronisasi Otomatis Teraktifkan</p>
        </div>
    </div>

    <div class="grid lg:grid-cols-2 gap-12">
        <div class="space-y-6">
            <div class="bg-gray-900/50 p-8 rounded-2xl border border-gray-800">
                <form action="/save-health" method="POST">
                    @csrf
                    <div class="grid grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-gray-400 text-[10px] uppercase font-bold mb-2 tracking-widest">Berat (KG)</label>
                            <input type="number" step="0.1" name="weight" required 
                                class="w-full bg-black border border-gray-700 p-4 rounded-xl text-white text-xl outline-none focus:border-cyan-500 transition"
                                placeholder="0.0">
                        </div>
                        
                        <div>
                            <label class="block text-cyan-500 text-[10px] uppercase font-bold mb-2 tracking-widest">Tinggi (CM)</label>
                            <input type="number" step="0.1" name="height" value="{{ auth()->user()->height }}" required 
                                class="w-full bg-black border border-gray-700 p-4 rounded-xl text-white text-xl outline-none focus:border-cyan-500 transition">
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-accent text-black py-4 rounded-xl font-black uppercase tracking-widest hover:bg-cyan-300 transition shadow-lg shadow-cyan-500/10">
                        Sinkronisasi Data Tubuh
                    </button>
                </form>
            </div>

            <div class="bg-gray-900/30 p-4 rounded-2xl border border-gray-800">
                <h4 class="text-[10px] uppercase font-bold text-gray-500 mb-4 px-2">Tren Progres Tubuh</h4>
                <canvas id="healthChart"></canvas>
            </div>
        </div>

        <div class="bg-gray-900/30 p-8 rounded-2xl border border-gray-800 h-fit">
            <h3 class="font-bold mb-6 uppercase text-sm flex items-center">
                <span class="w-2 h-2 bg-cyan-500 rounded-full mr-2 shadow-[0_0_8px_#66fcf1]"></span>
                Log Aktivitas Terbaru
            </h3>
            
            @if($logs->isEmpty())
                <p class="text-gray-600 italic text-sm text-center py-10">Belum ada data biometrik tercatat.</p>
            @else
                <div class="space-y-2">
                    @foreach($logs as $log)
                        <div class="flex justify-between items-center p-4 bg-black/20 rounded-xl border border-gray-800/50 hover:border-cyan-500/30 transition duration-300 group">
                            <div class="flex flex-col">
                                <span class="text-gray-500 text-[10px] uppercase tracking-tighter">{{ date('d M Y', strtotime($log->created_at)) }}</span>
                                <span class="font-bold text-white text-lg group-hover:text-cyan-400 transition">{{ $log->weight }} <span class="text-xs font-normal text-gray-500">kg</span></span>
                            </div>
                            <div class="text-right border-l border-gray-800 pl-4">
                                <p class="text-[9px] text-cyan-500 uppercase font-bold mb-1">Target Hidrasi</p>
                                <span class="accent-color font-bold text-xl">{{ number_format($log->water_target, 1) }}L</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
    const ctx = document.getElementById('healthChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($chartData->pluck('created_at')->map(fn($d) => date('d M', strtotime($d)))) !!},
            datasets: [{
                label: 'Berat Badan',
                data: {!! json_encode($chartData->pluck('weight')) !!},
                borderColor: '#66fcf1',
                backgroundColor: 'rgba(102, 252, 241, 0.05)',
                tension: 0.4,
                fill: true,
                borderWidth: 3,
                pointBackgroundColor: '#66fcf1',
                pointBorderColor: '#0b0c10',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { grid: { color: '#1f2937' }, ticks: { color: '#4b5563', font: { size: 10 } } },
                x: { grid: { display: false }, ticks: { color: '#4b5563', font: { size: 10 } } }
            }
        }
    });
</script>
@endpush