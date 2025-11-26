<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

        // === REQUEST ke Gemini REST API ===
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

        // Jika error dari Gemini
        if (!$response->successful()) {
            \Log::error('Gemini REST API Error', [
                'status' => $response->status(),
                'body'   => $response->json(),
            ]);

            return response()->json([
                'insight' => 'Gagal mengambil insight AI dari Gemini.',
                'error'   => $response->json(),
            ], $response->status());
        }

        $data = $response->json();
        $insight = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;

        return response()->json([
            'insight' => $insight ?? 'AI tidak mengembalikan hasil.',
        ]);
    }
}
