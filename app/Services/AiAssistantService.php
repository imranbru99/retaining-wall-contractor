<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use OpenAI\Laravel\Facades\OpenAI;
use Throwable;

class AiAssistantService
{
    /** @var array<int, array{q: string, a: string}> */
    protected array $faq = [
        [
            'q' => 'how long does retaining wall take timeline',
            'a' => 'Most Crestlock residential retaining walls run 3–10 working days after permits and material delivery. Tall engineered walls or hillside cut-and-fill jobs can take 2–4 weeks depending on weather and inspection timing along the Front Range.',
        ],
        [
            'q' => 'cost price estimate budget',
            'a' => 'Typical Denver-area retaining walls range from about $45–$120 per face square foot installed, depending on height, geogrid, drainage, access, and finish. Boulder and poured concrete systems price differently. We provide a free on-site estimate.',
        ],
        [
            'q' => 'drainage weep gravel french drain',
            'a' => 'Drainage is non-negotiable. Crestlock installs free-draining backfill, perforated pipe, filter fabric, and weep paths so hydrostatic pressure never loads the wall face — especially critical with Colorado snowmelt and clay soils.',
        ],
        [
            'q' => 'permit inspection engineered',
            'a' => 'Many Front Range municipalities require permits (and engineer stamps) above certain heights — often around 4 feet. We coordinate design calcs, stamped drawings when needed, and inspection scheduling with your city or county.',
        ],
        [
            'q' => 'block segmental boulder concrete timber',
            'a' => 'We build segmental block, boulder, poured concrete, and treated timber systems. Material choice depends on height, aesthetics, budget, and soil. Segmental block with geogrid is our most common hillside solution.',
        ],
        [
            'q' => 'failing lean crack bulge replace',
            'a' => 'Leaning, bulging, or cracked walls usually mean failed drainage or inadequate base. We assess whether rebuild, partial rebuild, or drainage retrofit is safer — then quote a structural fix, not a cosmetic patch.',
        ],
        [
            'q' => 'geogrid soil reinforcement',
            'a' => 'For taller segmental walls, geogrid layers lock the wall into compacted backfill. Grid length and spacing follow manufacturer and engineer specs for your retained height and surcharge (driveways, slopes).',
        ],
        [
            'q' => 'schedule appointment consult site walk',
            'a' => 'Book a free site walk via our contact form or WhatsApp. A Crestlock lead will measure height, review soil/access, discuss wall options, and send a scoped proposal within a few business days.',
        ],
        [
            'q' => 'hoa hillside terrace yard',
            'a' => 'We regularly rebuild HOA hillside walls and create terraced yards that reclaim flat usable space. Aesthetic finishes can match community guidelines while meeting structural requirements.',
        ],
        [
            'q' => 'warranty guarantee',
            'a' => 'Crestlock craftsmanship on retaining wall installs is warrantied for 5 years against workmanship defects. Manufacturer warranties on block, geogrid, and drainage products are passed through to you.',
        ],
    ];

    public function chat(string $message, string $context = 'public'): string
    {
        $message = trim($message);
        if ($message === '') {
            return 'Ask anything about retaining walls, drainage, permits, timelines, or Crestlock project workflow.';
        }

        if ($this->hasOpenAiKey()) {
            try {
                $system = $this->systemPrompt($context);
                $result = OpenAI::chat()->create([
                    'model' => config('services.ai.openai_model', 'gpt-4o-mini'),
                    'messages' => [
                        ['role' => 'system', 'content' => $system],
                        ['role' => 'user', 'content' => $message],
                    ],
                    'temperature' => 0.4,
                ]);

                return trim($result->choices[0]->message->content ?? '') ?: $this->faqReply($message);
            } catch (Throwable) {
                // Fall through to Gemini, then FAQ.
            }
        }

        if ($this->hasGeminiKey()) {
            try {
                $reply = $this->geminiReply($message, $context);
                if ($reply !== null) {
                    return $reply;
                }
            } catch (Throwable) {
                // Fall through to FAQ demo mode.
            }
        }

        return $this->faqReply($message);
    }

    public function generateContent(string $type, string $topic): string
    {
        $prompt = match ($type) {
            'blog' => "Write a practical 400-word blog post outline and intro for Crestlock Retaining about: {$topic}",
            'service' => "Write a persuasive service description for a retaining wall offering: {$topic}",
            'email' => "Write a short homeowner follow-up email about: {$topic}",
            default => "Write helpful retaining wall contractor copy about: {$topic}",
        };

        return $this->chat($prompt, 'generator');
    }

    public function automationSuggestions(): string
    {
        return $this->chat(
            'Suggest 5 practical ERP automations for a US retaining wall contractor using jobs, inventory, invoices, and appointments.',
            'automation'
        );
    }

    public function troubleshoot(string $issue): string
    {
        return $this->chat(
            "Troubleshoot this retaining wall / admin workflow issue and give step-by-step checks: {$issue}",
            'troubleshoot'
        );
    }

    protected function faqReply(string $message): string
    {
        $hay = Str::lower($message);
        $best = null;
        $bestScore = 0;

        foreach ($this->faq as $item) {
            $score = 0;
            foreach (explode(' ', $item['q']) as $token) {
                if ($token !== '' && Str::contains($hay, $token)) {
                    $score++;
                }
            }
            if ($score > $bestScore) {
                $bestScore = $score;
                $best = $item['a'];
            }
        }

        if ($best && $bestScore > 0) {
            return $best.' (Demo AI mode — add OPENAI_API_KEY or GEMINI_API_KEY for live model replies.)';
        }

        return 'Thanks for asking Crestlock. We build engineered retaining walls across Denver and the Front Range with drainage-first design, permit coordination, and durable segmental, boulder, or concrete systems. Share wall height, photos of the slope, and your city for a tighter estimate—or book a free site walk. (Demo AI mode.)';
    }

    protected function systemPrompt(string $context): string
    {
        $base = 'You are the AI assistant for Crestlock Retaining, a US retaining wall contractor in Denver, Colorado (Front Range). Be concise, practical, and safety/code-aware. Never invent legal or structural engineering advice; recommend local permits, geotech input, and inspections when appropriate.';

        return match ($context) {
            'generator' => $base.' Generate clear marketing or operational copy for retaining wall construction.',
            'automation' => $base.' Focus on Filament ERP workflows: leads, projects, inventory, invoices, scheduling.',
            'troubleshoot' => $base.' Help staff diagnose drainage, wall failure, scheduling, invoice, or CRM issues step by step.',
            default => $base.' Answer homeowner FAQs about retaining walls, drainage, cost ranges, and next steps.',
        };
    }

    protected function hasOpenAiKey(): bool
    {
        return filled(config('openai.api_key')) || filled(env('OPENAI_API_KEY'));
    }

    protected function hasGeminiKey(): bool
    {
        return filled(config('services.ai.gemini_key'));
    }

    protected function geminiReply(string $message, string $context): ?string
    {
        $key = config('services.ai.gemini_key');
        $model = config('services.ai.gemini_model', 'gemini-1.5-flash');
        $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$key}";

        $response = Http::timeout(20)->post($url, [
            'contents' => [[
                'parts' => [[
                    'text' => $this->systemPrompt($context)."\n\nUser: {$message}",
                ]],
            ]],
        ]);

        if (! $response->successful()) {
            return null;
        }

        return data_get($response->json(), 'candidates.0.content.parts.0.text');
    }
}
