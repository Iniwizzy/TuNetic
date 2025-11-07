<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatBotController extends Controller
{
    private $apiKey;
    private $apiUrl;

    public function __construct()
    {
        $this->apiKey = 'AIzaSyBgxSB5Ff8HzfKJehzV5fhqpek8q3owgt8';
        $this->apiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent';
    }

    /**
     * Handle chat message from user
     */
    public function chat(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'message' => 'required|string|max:1000'
            ]);

            $userMessage = $request->input('message');

            // Prepare request to Gemini API
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($this->apiUrl . '?key=' . $this->apiKey, [
                'contents' => [
                    [
                        'parts' => [
                            [
                                'text' => $userMessage
                            ]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'temperature' => 0.7,
                    'topK' => 40,
                    'topP' => 0.95,
                    'maxOutputTokens' => 1024,
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();

                if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                    $botResponse = $data['candidates'][0]['content']['parts'][0]['text'];

                    return response()->json([
                        'success' => true,
                        'message' => $botResponse
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Maaf, saya tidak bisa memproses pertanyaan Anda saat ini.'
                    ], 500);
                }
            } else {
                Log::error('Gemini API Error: ' . $response->body());

                return response()->json([
                    'success' => false,
                    'message' => 'Maaf, terjadi kesalahan saat menghubungi layanan AI.'
                ], 500);
            }
        } catch (\Exception $e) {
            Log::error('ChatBot Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Maaf, terjadi kesalahan. Silakan coba lagi.'
            ], 500);
        }
    }
}
