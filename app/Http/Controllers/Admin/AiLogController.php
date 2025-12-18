<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserTarget;
use Illuminate\Http\Request;

class AiLogController extends Controller
{
    public function index(Request $request)
    {
        // Filter
        $q      = $request->query('q');        // cari nama/email
        $status = $request->query('status');   // success / error (kita definisikan dari insight)
        $goal   = $request->query('goal');     // weightloss / maintain / bulking
        $date   = $request->query('date');     // YYYY-MM-DD (filter created_at)

        $query = UserTarget::query()
            ->with(['user:id,name,email']) // relasi user
            ->latest();

        if ($q) {
            $query->whereHas('user', function ($u) use ($q) {
                $u->where('name', 'like', "%{$q}%")
                  ->orWhere('email', 'like', "%{$q}%");
            });
        }

        if ($goal) {
            $query->where('goal', $goal);
        }

        if ($date) {
            $query->whereDate('created_at', $date);
        }

        // Status kita “turunkan” dari data:
        // - success: insight ada
        // - error: insight kosong/null
        if ($status === 'success') {
            $query->whereNotNull('insight')->where('insight', '!=', '');
        } elseif ($status === 'error') {
            $query->where(function ($q) {
                $q->whereNull('insight')->orWhere('insight', '=', '');
            });
        }

        // Pagination
        $paginator = $query->paginate(10)->withQueryString();

        // Map ke format yang blade kamu sudah pakai ($logs)
        $logs = $paginator->getCollection()->map(function ($t) {
            $isOk = !empty($t->insight);

            return [
                'id'            => $t->id,
                'user_name'     => $t->user?->name ?? 'Pengguna',
                'user_email'    => $t->user?->email ?? '-',
                'user_id'       => $t->user_id,

                'created_at'    => $t->created_at,

                // Data dari user_targets
                'bmi'           => null,                  // tidak ada di user_targets (jadi tampil '-')
                'bmr'           => $t->bmr,
                'calorie_target'=> $t->kalori_target,     // blade kamu pakai "calorie_target"
                'goal'          => $t->goal,              // weightloss/maintain/bulking
                'activity_level'=> '-',                   // tidak ada di user_targets
                'status'        => $isOk ? 'success' : 'error',
                'error_message' => $isOk ? null : 'Insight masih kosong / gagal tersimpan.',
            ];
        });

        // set kembali collection yang sudah dimap supaya blade aman
        $paginator->setCollection($logs);

        return view('admin.ai.logs', [
            'logs' => $paginator, // ini paginator, tapi elemennya array sesuai view
        ]);
    }

    public function show($id)
    {
        $target = UserTarget::with(['user:id,name,email'])->findOrFail($id);

        // Format data detail (biar gampang dipakai di view show)
        $log = [
            'id'             => $target->id,
            'user_name'      => $target->user?->name ?? 'Pengguna',
            'user_email'     => $target->user?->email ?? '-',
            'created_at'     => $target->created_at,

            'bmr'            => $target->bmr,
            'tdee'           => $target->tdee,
            'kalori_target'  => $target->kalori_target,
            'karbo_target'   => $target->karbo_target,
            'protein_target' => $target->protein_target,
            'lemak_target'   => $target->lemak_target,

            'goal'           => $target->goal,
            'insight'        => $target->insight,
        ];

        return view('admin.ai.show', compact('log'));
    }
}
