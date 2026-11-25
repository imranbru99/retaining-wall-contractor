# Crestlock Retaining

Production-ready Laravel 13 + Filament 3 website, ERP, and AI toolkit for a Denver Front Range retaining wall contractor. Public marketing site, knowledge base, WhatsApp CTA, and a full admin ERP for wall jobs, inventory, invoices, scheduling, and AI assistants.

## ✨ Features

- 🧱 Premium public site with hero, services, about, ERP dashboard preview, and contact form
- 🛠️ Service detail pages for segmental, boulder, concrete, drainage rescue, terraces, and HOA walls
- 📚 Blog / field notes with seeded retaining wall articles
- 💬 Floating WhatsApp button + public AI chatbot (OpenAI / Gemini / FAQ demo fallback)
- 🧾 Filament ERP at `/admin` — customers, jobs, inventory, invoices, payments, appointments
- 👥 Roles: Admin, Manager, Staff (Spatie Permission + role column)
- 📊 Reports dashboard with stats and charts
- ⚙️ Company settings page + AI content / automation / troubleshooting tools
- 📖 Knowledge base: common issues, guides, admin manual, troubleshooting
- 🌱 Realistic demo seeders for Colorado homeowners and wall jobs

## 🧰 Tech Stack

- Laravel 13
- Filament 3
- Livewire + Alpine.js + Tailwind (Filament)
- MySQL or SQLite (demo)
- Spatie Laravel Permission
- OpenAI PHP Laravel SDK with Gemini fallback config

## 🚀 Installation

```bash
git clone https://github.com/imranbru99/retaining-wall-contractor.git
cd retaining-wall-contractor
composer install
copy .env.example .env   # Windows
php artisan key:generate
# SQLite demo is ready — or configure MySQL in .env
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

Admin panel: `http://localhost:8000/admin`  
Public site: `http://localhost:8000`

### Demo credentials

- Email: `admin@example.com`
- Password: `password`

Optional AI keys in `.env`: `OPENAI_API_KEY`, `GEMINI_API_KEY`.

## 🖼️ Screenshots / Visual Dashboard

![Modern outdoor home hillside](https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1200&q=80)

![Garden landscape terracing](https://images.unsplash.com/photo-1416879595882-3373a0480b5b?auto=format&fit=crop&w=1200&q=80)

![Landscaped outdoor living levels](https://images.unsplash.com/photo-1558904541-efa843a96f01?auto=format&fit=crop&w=1200&q=80)

![Planted terrace beds](https://images.unsplash.com/photo-1466692476866-aef53dfb6c00?auto=format&fit=crop&w=1200&q=80)

## 🌐 Live Demo

Placeholder — deploy to your preferred host (Forge, Vapor, shared PHP) and update this section with the production URL.

## 🔍 SEO-optimized GitHub description suggestion

```
Crestlock Retaining — Laravel 13 + Filament 3 retaining wall contractor website & ERP with AI chatbot, jobs, inventory, invoices, and Denver Front Range demo data.
```

---

## 🤝 Let's Connect & Collaborate
I am open to Senior Remote Full-Stack Roles, AI Platform Architecture Contracts, and Enterprise Technical Advisory.
Timezone: UTC+6 (Dhaka / Rangpur, Bangladesh) — Flexible overlap with US, UK, and European business hours.
Delivery Mode: Async-ready, Slack, Discord, Jira, GitHub, and production-first accountability.

| Channel | Address / Handle | Quick Action |
|---------|------------------|--------------|
| 🌐 Primary Portfolio | imrandev.bd | Visit Site ↗ |
| 📦 Packagist Packages | packagist.org/packages/imrandevbd/ | View Packages ↗ |
| 💼 LinkedIn Profile | linkedin.com/in/imranbru99 | Connect ↗ |
| 🐙 GitHub Profile | github.com/imranbru99 | Follow ↗ |
| 💬 WhatsApp Direct | +880 1576-918420 | Chat Now ↗ |
| 📧 Direct Email | me@imrandev.bd | Send Email ↗ |
| 🐦 X (Twitter) | @imrandev_bd | Follow ↗ |
| 📺 YouTube Tech | @ImranDevBD | Subscribe ↗ |
