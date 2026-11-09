# Barangay Bulletin – Purok Perez

Lab Activity 10: Eloquent, migrations and seeding for the Barangay Matina Crossing Hall bulletin (Davao City).

## Personalization
- **Posts per page:** 6. My last name, "Perez", has only 5 letters, so the minimum of 6 applies.
- **Custom category:** Livelihood (alongside Announcement, Health, Peace & Order, Ayuda).
- **Kagawad:** Kagawad Chris Perez, `kagawad.perez@bulletin.test`, created with `Author::create()`.
- **Pinned post:** "Purok Perez Clean-up Drive", published_at = September 4, 2026 (my birthday).

## How to run
```
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
npm install
npm run dev
php artisan serve
```
Then open http://127.0.0.1:8000/posts. `migrate:fresh --seed` gives 5 authors and 51 posts (40 published, 10 drafts, 1 pinned).
