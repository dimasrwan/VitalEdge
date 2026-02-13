<style>
    body { font-family: sans-serif; color: #333; }
    .header { text-align: center; border-bottom: 2px solid #66fcf1; padding-bottom: 20px; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
    th { bg-color: #f8f9fa; }
    .summary { margin-top: 30px; padding: 15px; background: #f0ffff; border-radius: 10px; }
</style>

<div class="header">
    <h1>VITALEDGE SYSTEM REPORT</h1>
    <p>Subjek: {{ $user->name }} | Tanggal Cetak: {{ date('d/m/Y') }}</p>
</div>

<div class="summary">
    <p><strong>BMI Terakhir:</strong> {{ $bmi ?? 'N/A' }}</p>
    <p><strong>Tinggi Badan:</strong> {{ $user->height }} cm</p>
</div>

<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Berat (kg)</th>
            <th>Target Air (L)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($logs as $log)
        <tr>
            <td>{{ date('d M Y', strtotime($log->created_at)) }}</td>
            <td>{{ $log->weight }}</td>
            <td>{{ number_format($log->water_target, 1) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>