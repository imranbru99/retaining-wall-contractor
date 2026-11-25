<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\BlogPost;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\KnowledgeArticle;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['admin', 'manager', 'staff'] as $role) {
            Role::findOrCreate($role);
        }

        $admin = User::query()->updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Crestlock Admin',
                'phone' => '(303) 555-0100',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'is_active' => true,
            ]
        );
        $admin->syncRoles(['admin']);

        $manager = User::query()->updateOrCreate(
            ['email' => 'manager@crestlock.example'],
            [
                'name' => 'Reese Calder',
                'phone' => '(303) 555-0101',
                'password' => Hash::make('password'),
                'role' => 'manager',
                'is_active' => true,
            ]
        );
        $manager->syncRoles(['manager']);

        $staff = User::query()->updateOrCreate(
            ['email' => 'crew@crestlock.example'],
            [
                'name' => 'Sam Ortega',
                'phone' => '(303) 555-0102',
                'password' => Hash::make('password'),
                'role' => 'staff',
                'is_active' => true,
            ]
        );
        $staff->syncRoles(['staff']);

        $settings = [
            'company_name' => 'Crestlock Retaining Co.',
            'tagline' => 'Engineered walls for Front Range slopes',
            'company_phone' => '(303) 555-0192',
            'company_email' => 'hello@crestlock.example',
            'company_address' => '4820 Brighton Blvd, Denver, CO 80216',
            'whatsapp_number' => '13035550192',
            'service_area' => 'Denver metro and Front Range — Denver, Boulder, Highlands Ranch, Golden, and surrounding foothills',
        ];
        foreach ($settings as $key => $value) {
            Setting::setValue($key, $value, 'company');
        }

        $services = [
            [
                'title' => 'Segmental Block Retaining Walls',
                'slug' => 'segmental-block-walls',
                'icon' => 'layers',
                'summary' => 'Geogrid-reinforced modular block walls for yards, driveways, and hillside terraces.',
                'description' => '<p>Crestlock builds manufacturer-spec segmental walls with compacted base, drainage pipe, free-draining backfill, and geogrid as height requires.</p><p>Ideal for residential grades, patio edges, and multi-tier landscapes across Denver metro.</p>',
                'starting_price' => 8500,
                'image_url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1400&q=80',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Boulder & Natural Stone Walls',
                'slug' => 'boulder-natural-stone-walls',
                'icon' => 'mountain',
                'summary' => 'Massive stone placements that blend into Front Range landscapes while holding serious load.',
                'description' => '<p>We source and set Colorado boulders with proper embedment and drainage so the wall looks organic and performs structurally.</p>',
                'starting_price' => 12000,
                'image_url' => 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&w=1400&q=80',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Poured Concrete Retaining',
                'slug' => 'poured-concrete-retaining',
                'icon' => 'cube',
                'summary' => 'Formed and poured walls for tight lots, tall heights, and architectural finishes.',
                'description' => '<p>When modular block cannot meet height or space constraints, we form, steel, and pour structural concrete walls with engineer coordination.</p>',
                'starting_price' => 18000,
                'image_url' => 'https://images.unsplash.com/photo-1494438639946-1ebd1d20bf85?auto=format&fit=crop&w=1400&q=80',
                'is_featured' => false,
                'sort_order' => 3,
            ],
            [
                'title' => 'Drainage & Wall Rescue',
                'slug' => 'drainage-wall-rescue',
                'icon' => 'droplet',
                'summary' => 'Fix leaning walls, add French drains, and rebuild failed backfill before the next snowmelt.',
                'description' => '<p>Hydrostatic pressure destroys more walls than freeze alone. We excavate, install perforated pipe and fabric, and rebuild or stabilize as needed.</p>',
                'starting_price' => 5500,
                'image_url' => 'https://images.unsplash.com/photo-1585320806297-369747d6e1d1?auto=format&fit=crop&w=1400&q=80',
                'is_featured' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'Terraced Yard Systems',
                'slug' => 'terraced-yard-systems',
                'icon' => 'steps',
                'summary' => 'Multi-level retaining that creates flat lawns, planting beds, and outdoor living pads on steep lots.',
                'description' => '<p>We design tier heights for plant health, drainage, and usable space — then sequence walls so each level drains cleanly downhill.</p>',
                'starting_price' => 22000,
                'image_url' => 'https://images.unsplash.com/photo-1466692476866-aef53dfb6c00?auto=format&fit=crop&w=1400&q=80',
                'is_featured' => false,
                'sort_order' => 5,
            ],
            [
                'title' => 'Commercial & HOA Hillside Walls',
                'slug' => 'commercial-hoa-hillside',
                'icon' => 'building',
                'summary' => 'Permit-heavy hillside repairs and new walls for HOAs, multifamily, and small commercial sites.',
                'description' => '<p>Crestlock coordinates stamped plans, traffic control, and phased builds so communities stay safe while slopes get locked down.</p>',
                'starting_price' => 45000,
                'image_url' => 'https://images.unsplash.com/photo-1605146768851-eda79da39897?auto=format&fit=crop&w=1400&q=80',
                'is_featured' => false,
                'sort_order' => 6,
            ],
        ];
        foreach ($services as $service) {
            Service::query()->updateOrCreate(['slug' => $service['slug']], $service);
        }

        $products = [
            ['name' => 'Segmental Block Cap Unit', 'sku' => 'BLK-CAP-01', 'category' => 'block', 'unit_cost' => 4.20, 'unit_price' => 7.50, 'stock_qty' => 860, 'unit' => 'ea'],
            ['name' => 'Segmental Wall Block Standard', 'sku' => 'BLK-STD-08', 'category' => 'block', 'unit_cost' => 3.10, 'unit_price' => 5.80, 'stock_qty' => 4200, 'unit' => 'ea'],
            ['name' => 'Geogrid Roll 4ft x 50ft', 'sku' => 'GEO-4X50', 'category' => 'reinforcement', 'unit_cost' => 68, 'unit_price' => 115, 'stock_qty' => 48, 'unit' => 'roll'],
            ['name' => 'Perforated Drain Pipe 4"', 'sku' => 'DRN-PERF-4', 'category' => 'drainage', 'unit_cost' => 0.85, 'unit_price' => 1.65, 'stock_qty' => 2400, 'unit' => 'lf'],
            ['name' => 'Filter Fabric 12.5ft Roll', 'sku' => 'DRN-FF-125', 'category' => 'drainage', 'unit_cost' => 42, 'unit_price' => 74, 'stock_qty' => 36, 'unit' => 'roll'],
            ['name' => 'Crushed Drain Rock 3/4"', 'sku' => 'AGG-DR-34', 'category' => 'aggregate', 'unit_cost' => 28, 'unit_price' => 48, 'stock_qty' => 120, 'unit' => 'ton'],
            ['name' => 'Class 6 Road Base', 'sku' => 'AGG-C6-BASE', 'category' => 'aggregate', 'unit_cost' => 22, 'unit_price' => 38, 'stock_qty' => 95, 'unit' => 'ton'],
            ['name' => 'Timber Wall Tie 8ft', 'sku' => 'TMB-TIE-8', 'category' => 'timber', 'unit_cost' => 18, 'unit_price' => 32, 'stock_qty' => 140, 'unit' => 'ea'],
        ];
        foreach ($products as $product) {
            Product::query()->updateOrCreate(
                ['sku' => $product['sku']],
                array_merge($product, ['description' => 'Crestlock stock for retaining wall crews.', 'is_active' => true])
            );
        }

        $customers = collect([
            ['name' => 'Nora Ellison', 'email' => 'nora.ellison@example.com', 'phone' => '(303) 555-2211', 'city' => 'Denver', 'address' => '2140 Race St', 'zip' => '80205'],
            ['name' => 'Kai & Morgan Voss', 'email' => 'voss.family@example.com', 'phone' => '(720) 555-8830', 'city' => 'Boulder', 'address' => '980 Mapleton Ave', 'zip' => '80304'],
            ['name' => 'Diego Morales', 'email' => 'diego.morales@example.com', 'phone' => '(303) 555-4412', 'city' => 'Highlands Ranch', 'address' => '9402 Wilde Ave', 'zip' => '80126'],
            ['name' => 'Helen Park', 'email' => 'helen.park@example.com', 'phone' => '(303) 555-7788', 'city' => 'Golden', 'address' => '712 Washington Ave', 'zip' => '80401'],
            ['name' => 'Omar Haddad', 'email' => 'omar.h@example.com', 'phone' => '(720) 555-9090', 'city' => 'Aurora', 'address' => '15820 E Alameda Pkwy', 'zip' => '80017'],
        ])->map(function (array $data) {
            return Customer::query()->updateOrCreate(
                ['email' => $data['email']],
                array_merge($data, ['state' => 'CO', 'notes' => 'Demo homeowner lead for Crestlock.'])
            );
        });

        $projectDefs = [
            ['number' => 'CL-2401', 'title' => 'Race St segmental terrace', 'status' => 'completed', 'sqft' => 420, 'est' => 28500, 'act' => 30200],
            ['number' => 'CL-2408', 'title' => 'Boulder hillside boulder wall', 'status' => 'in_progress', 'sqft' => 680, 'est' => 54000, 'act' => 26000],
            ['number' => 'CL-2412', 'title' => 'Highlands Ranch driveway edge', 'status' => 'scheduled', 'sqft' => 310, 'est' => 16800, 'act' => 0],
            ['number' => 'CL-2415', 'title' => 'Golden drainage rescue rebuild', 'status' => 'quoted', 'sqft' => 520, 'est' => 41000, 'act' => 0],
            ['number' => 'CL-2419', 'title' => 'Aurora HOA hillside phase 1', 'status' => 'lead', 'sqft' => 1100, 'est' => 98000, 'act' => 0],
        ];

        $projects = collect();
        foreach ($projectDefs as $i => $def) {
            $customer = $customers[$i];
            $projects->push(Project::query()->updateOrCreate(
                ['project_number' => $def['number']],
                [
                    'customer_id' => $customer->id,
                    'assigned_to' => $i % 2 === 0 ? $manager->id : $staff->id,
                    'title' => $def['title'],
                    'description' => 'Demo retaining wall project seeded for Crestlock ERP.',
                    'status' => $def['status'],
                    'priority' => $i === 1 ? 'high' : 'normal',
                    'site_address' => $customer->address.', '.$customer->city.', CO',
                    'sqft' => $def['sqft'],
                    'estimated_value' => $def['est'],
                    'actual_value' => $def['act'],
                    'start_date' => now()->subDays(40 - ($i * 5)),
                    'target_date' => now()->addDays(20 + ($i * 7)),
                    'completed_at' => $def['status'] === 'completed' ? now()->subDays(10) : null,
                ]
            ));
        }

        $invoice1 = Invoice::query()->updateOrCreate(
            ['invoice_number' => 'INV-2001'],
            [
                'customer_id' => $customers[0]->id,
                'project_id' => $projects[0]->id,
                'status' => 'paid',
                'issue_date' => now()->subMonths(2),
                'due_date' => now()->subMonths(1)->subDays(15),
                'subtotal' => 28000,
                'tax' => 2200,
                'total' => 30200,
                'amount_paid' => 30200,
                'notes' => 'Final payment for Race St terrace wall.',
            ]
        );
        Payment::query()->updateOrCreate(
            ['invoice_id' => $invoice1->id, 'reference' => 'CHK-55021'],
            [
                'amount' => 15000,
                'method' => 'check',
                'paid_at' => now()->subMonths(2)->addDays(3),
            ]
        );
        Payment::query()->updateOrCreate(
            ['invoice_id' => $invoice1->id, 'reference' => 'ACH-77102'],
            [
                'amount' => 15200,
                'method' => 'ach',
                'paid_at' => now()->subMonths(1)->subDays(10),
            ]
        );

        $invoice2 = Invoice::query()->updateOrCreate(
            ['invoice_number' => 'INV-2008'],
            [
                'customer_id' => $customers[1]->id,
                'project_id' => $projects[1]->id,
                'status' => 'partial',
                'issue_date' => now()->subDays(18),
                'due_date' => now()->addDays(12),
                'subtotal' => 26000,
                'tax' => 2000,
                'total' => 28000,
                'amount_paid' => 14000,
                'notes' => 'Deposit + progress billing for Boulder hillside wall.',
            ]
        );
        Payment::query()->updateOrCreate(
            ['invoice_id' => $invoice2->id, 'reference' => 'CARD-3381'],
            [
                'amount' => 14000,
                'method' => 'card',
                'paid_at' => now()->subDays(16),
            ]
        );

        Appointment::query()->updateOrCreate(
            ['title' => 'Boulder wall base inspection', 'starts_at' => now()->addDays(2)->setTime(9, 0)],
            [
                'customer_id' => $customers[1]->id,
                'project_id' => $projects[1]->id,
                'assigned_to' => $manager->id,
                'type' => 'site_visit',
                'status' => 'confirmed',
                'ends_at' => now()->addDays(2)->setTime(10, 30),
                'location' => $customers[1]->address,
            ]
        );
        Appointment::query()->updateOrCreate(
            ['title' => 'Golden drainage consult', 'starts_at' => now()->addDays(5)->setTime(14, 0)],
            [
                'customer_id' => $customers[3]->id,
                'project_id' => $projects[3]->id,
                'assigned_to' => $staff->id,
                'type' => 'consultation',
                'status' => 'scheduled',
                'ends_at' => now()->addDays(5)->setTime(15, 0),
                'location' => $customers[3]->address,
            ]
        );

        $posts = [
            [
                'title' => 'Why Front Range retaining walls fail after snowmelt',
                'slug' => 'why-front-range-walls-fail-snowmelt',
                'excerpt' => 'Hydrostatic pressure — not just freeze — is what bulges block faces. Here is how Crestlock stages drainage before the first course.',
                'cover_image' => 'https://images.unsplash.com/photo-1416879595882-3373a0480b5b?auto=format&fit=crop&w=1400&q=80',
                'body' => '<p>Every spring we see the same pattern: a handsome wall that leaned after March melt. The culprit is almost always water trapped behind the face.</p><p>Our rule is simple — pipe, gravel, fabric, then stack. Pretty finishes on a wet backfill are temporary.</p>',
            ],
            [
                'title' => 'When you need an engineer-stamped retaining wall',
                'slug' => 'when-you-need-engineer-stamped-wall',
                'excerpt' => 'Height thresholds, surcharges, and hillside cuts — a homeowner checklist for Denver-area permits.',
                'cover_image' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=1400&q=80',
                'body' => '<p>Most Front Range cities care about retained height and what sits above the wall. Driveways and structures above a wall often trigger stamped plans.</p><p>Crestlock flags this early so your proposal includes the right design path.</p>',
            ],
            [
                'title' => 'Segmental block vs boulder walls for hillside lots',
                'slug' => 'segmental-vs-boulder-hillside',
                'excerpt' => 'Aesthetics, access for equipment, and geogrid needs — how we help homeowners choose.',
                'cover_image' => 'https://images.unsplash.com/photo-1558904541-efa843a96f01?auto=format&fit=crop&w=1400&q=80',
                'body' => '<p>Boulders look native on foothill lots but need machine access. Segmental systems shine on tighter suburban grades with predictable geogrid schedules.</p>',
            ],
        ];
        foreach ($posts as $post) {
            BlogPost::query()->updateOrCreate(
                ['slug' => $post['slug']],
                array_merge($post, [
                    'author_name' => 'Crestlock Field Team',
                    'is_published' => true,
                    'published_at' => now()->subDays(rand(3, 40)),
                ])
            );
        }

        $articles = [
            [
                'title' => 'Wall leaning after first winter',
                'slug' => 'wall-leaning-after-first-winter',
                'category' => 'issues',
                'summary' => 'What to check when a new or aging wall starts to tip.',
                'body' => '<ol><li>Look for saturated soil or ponding behind the wall.</li><li>Confirm weep and drain outlets are clear.</li><li>Check base for settlement or scour.</li><li>Stop adding surcharge (heavy planters, vehicles) until assessed.</li></ol>',
                'sort_order' => 1,
            ],
            [
                'title' => 'Retaining wall build sequence checklist',
                'slug' => 'retaining-wall-build-sequence',
                'category' => 'guides',
                'summary' => 'From excavation to caps — the Crestlock order of operations.',
                'body' => '<p>1) Layout & utilities 2) Excavate 3) Compact base 4) First course level 5) Drainage & fabric 6) Stack + geogrid 7) Backfill lifts 8) Caps 9) Final grade & inspection.</p>',
                'sort_order' => 1,
            ],
            [
                'title' => 'Admin: creating a wall job in Filament ERP',
                'slug' => 'admin-creating-a-wall-job',
                'category' => 'admin',
                'summary' => 'How staff open projects, assign crew, and link invoices.',
                'body' => '<p>Navigate to <strong>Jobs / Projects</strong>, create a record with customer and face sq ft / linear footage, then schedule a site walk and draft an invoice from Finance.</p>',
                'sort_order' => 1,
            ],
            [
                'title' => 'Invoice balance not updating after payment',
                'slug' => 'invoice-balance-not-updating',
                'category' => 'troubleshooting',
                'summary' => 'Quick ERP checks when amount_paid looks wrong.',
                'body' => '<p>Confirm the payment is linked to the correct invoice, that status is partial/paid, and that amount_paid equals the sum of payment rows. Re-save the invoice if needed.</p>',
                'sort_order' => 1,
            ],
            [
                'title' => 'Clay soil and poor drainage behind walls',
                'slug' => 'clay-soil-poor-drainage',
                'category' => 'issues',
                'summary' => 'Front Range clay holds water — design accordingly.',
                'body' => '<p>Use free-draining aggregate, continuous perforated pipe to daylight or a storm connection, and fabric separation from fines. Never backfill with native clay against the wall face.</p>',
                'sort_order' => 2,
            ],
            [
                'title' => 'Homeowner prep before excavation day',
                'slug' => 'homeowner-prep-excavation-day',
                'category' => 'guides',
                'summary' => 'Mark utilities awareness, clear access, protect landscaping edges.',
                'body' => '<p>Confirm 811 locates are current, clear driveway for machines, and move fragile plantings. Crestlock sets silt controls where runoff could leave the site.</p>',
                'sort_order' => 2,
            ],
        ];
        foreach ($articles as $article) {
            KnowledgeArticle::query()->updateOrCreate(
                ['slug' => $article['slug']],
                array_merge($article, ['is_published' => true])
            );
        }
    }
}
