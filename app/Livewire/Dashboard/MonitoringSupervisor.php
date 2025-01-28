<?php

namespace App\Livewire\Dashboard;

use App\Models\MonitoringPresent;
use App\Models\Shift;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class MonitoringSupervisor extends Component
{
    public $date;
    public $data = [];
    public $shift;
    public $shift_id;
    public $dateString;
    public $timeTypes = ['9', '15', '21', '3'];

    public function mount($date)
    {
        $this->date = $date;
        $this->dateString = Carbon::parse($date)->format('d F Y');
        $this->shift = Shift::where('day_of_week', strtolower(Carbon::parse($this->date)->format('l')))->first();
        $this->shift_id = $this->shift->id;
        $this->generateData();

        // dd($this->data);
    }

    #[On('updatedData')]
    public function updatedDate($date)
    {
        $this->date = $date;

        $this->dateString = Carbon::parse($date)->format('d F Y');

        $this->shift = Shift::where('day_of_week', strtolower(Carbon::parse($this->date)->format('l')))->first();
        $this->shift_id = $this->shift->id;

        $this->generateData();
    }

    public function generateData()
    {
        // Ambil data monitoring dengan relasi grup dan detail
        $monitoring = MonitoringPresent::with(['group.supervisor', 'details'])
            ->select('group_id', 'type')
            ->withCount([
                'details as hadir_count' => function ($query) {
                    $query->where('is_present', 1);
                },
                'details as sakit_count' => function ($query) {
                    $query->where('reason', 'sakit');
                },
                'details as tanpa_keterangan_count' => function ($query) {
                    $query->where('reason', 'tanpa_keterangan');
                },
                'details as pindah_supervisor_count' => function ($query) {
                    $query->where('reason', 'pindah_supervisor');
                },
            ])
            ->where('role', 'supervisor')
            ->whereDate('shift_date', $this->date)
            ->get()
            ->groupBy('group_id');

        // Format data untuk tabel
        $this->data = $monitoring->map(function ($group, $groupId) {
            $groupName = optional($group->first()->group)->name; // Ambil nama grup dari relasi
            $supervisorName = optional($group->first()->group->supervisor)->name;
            $types = $group->groupBy('type'); // Kelompokkan berdasarkan tipe

            // Format data untuk setiap tipe
            return [
                'group_name' => $groupName,
                'supervisor_name' => $supervisorName,
                'types' => collect($this->timeTypes)->mapWithKeys(function ($type) use ($types) {
                    // Ubah tipe menjadi dua digit (pad dengan 0 jika perlu)
                    $formattedTime = str_pad($type, 2, '0', STR_PAD_LEFT);

                    // Ambil data berdasarkan tipe
                    $typeData = $types->get((int) $formattedTime, collect()); // Pastikan pencocokan tipe dalam format integer

                    return [
                        $formattedTime => [
                            'H' => $typeData->sum('hadir_count'),
                            'S' => $typeData->sum('sakit_count'),
                            'TK' => $typeData->sum('tanpa_keterangan_count'),
                            'PS' => $typeData->sum('pindah_supervisor_count'),
                        ],
                    ];
                }),
            ];
        });
    }

    public function formatTime($type)
    {
        return str_pad($type, 2, '0', STR_PAD_LEFT) . ':00';
    }

    public function render()
    {
        return view('livewire.dashboard.monitoring-supervisor', [
            'monitoringData' => $this->data
        ]);
    }
}
