<?php

namespace App\Http\Controllers;

use App\Models\UserTarget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LabController extends Controller
{
    public function insight(Request $request)
    {
        $apiKey = config('services.gemini.key');
        $prompt = $request->input('prompt');

        if (!$apiKey) {
            return response()->json([
                'insight' => 'GEMINI_API_KEY tidak ditemukan dalam konfigurasi.',
            ], 500);
        }

        if (!$prompt) {
            return response()->json([
                'insight' => 'Prompt kosong.',
            ], 400);
        }

        // REQUEST ke Gemini
        $response = Http::withHeaders([
            'Content-Type'   => 'application/json',
            'x-goog-api-key' => $apiKey,
        ])->post(
            'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent',
            [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ]
            ]
        );

        if (!$response->successful()) {
            Log::error('Gemini REST API Error', [
                'status' => $response->status(),
                'body'   => $response->json(),
            ]);

            return response()->json([
                'insight' => 'Gagal mengambil insight AI dari Gemini.',
                'error'   => $response->json(),
            ], $response->status());
        }

        $data    = $response->json();
        $insight = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;
        $insight = $insight ?? 'AI tidak mengembalikan hasil.';

        // ==== SIMPAN KE user_targets (jika user login) ====
        if (Auth::check()) {
            UserTarget::updateOrCreate(
                ['user_id' => Auth::id()],
                [
                    'bmr'            => (int) $request->input('bmr'),
                    'tdee'           => (int) $request->input('tdee'),
                    'kalori_target'  => (int) $request->input('kalori_target'),
                    'karbo_target'   => (int) $request->input('karbo_target'),
                    'protein_target' => (int) $request->input('protein_target'),
                    'lemak_target'   => (int) $request->input('lemak_target'),
                    'goal'           => $request->input('goal'), // weightloss / maintain / bulking
                    'insight'        => $insight,
                ]
            );
        }

        return response()->json([
            'insight' => $insight,
        ]);
    }

    
}
