# maxter2 — Project Reference

## Overview
Simple web shop catalogue for industrial machines (airless painting, sandblasting).
Built with Laravel 12, Blade components, Alpine.js, Tailwind CSS v3, DaisyUI v5, Vite.

## Rules
- **ProfileController** — do not touch.
- Product CRUD (create/edit/delete) requires authenticated user only.
- Registration is disabled — users are created manually.

---

## Stack
- **Backend:** Laravel 12, PHP 8.2+
- **Auth:** Laravel Breeze (registration disabled)
- **Frontend:** Blade, Alpine.js, Tailwind CSS v3, DaisyUI v5
- **Build:** Vite

---

## Controllers

### ProductController — Full CRUD (`app/Http/Controllers/ProductController.php`)
| Method | Route | Auth | Description |
|--------|-------|------|-------------|
| `index` | GET /products | no | Paginated list (25/page), sort by price, filter by category |
| `create` | GET /products/create | yes | Form with categories + related product selector |
| `store` | POST /products | yes | Create product, up to 5 images + 5 related products |
| `show` | GET /products/{slug} | no | Product detail with images and related products |
| `edit` | GET /products/{id}/edit | yes | Edit form |
| `update` | PUT/PATCH /products/{id} | yes | Update product + images (max 5 total) |
| `destroy` | DELETE /products/{id} | yes | Delete product + remove images from storage |
| `reorderImages` | PATCH /products/{id}/images/reorder | yes | Update sort_order on product images |
| `getMasineZaFarb` | GET /masine-za-farbanje | no | Category page — airless machines |
| `getMasineZaPesk` | GET /masine-za-peskarenje | no | Category page — sandblasting machines |

### QuestionController — PARTIAL (`app/Http/Controllers/QuestionController.php`)
| Method | Status | Description |
|--------|--------|-------------|
| `index` | Done | GET /questions (auth) — list all, latest first |
| `store` | Done | POST /contact — save submission, honeypot on `website` field |
| `create/show/edit/update/destroy` | **Not implemented** | Empty stubs |

### SitemapController (`app/Http/Controllers/SitemapController.php`)
- `index` — GET /sitemap.xml — generates XML sitemap (static pages + all product slugs)

### ProfileController — **DO NOT TOUCH**

---

## Models

### Product (`app/Models/Product.php`)
- **Fillable:** `title`, `price`, `discount`, `description`, `technical_data`, `category`
- **Auto-generated:** `slug` from title on create/update (Str::slug)
- **Relations:**
  - `images()` — hasMany ProductImage, ordered by sort_order
  - `related()` — belongsToMany Product (pivot: product_related)
  - `relatedByOthers()` — inverse belongsToMany

### ProductImage (`app/Models/ProductImage.php`)
- **Fillable:** `product_id`, `path`, `sort_order`
- **Relations:** `product()` belongsTo Product

### Question (`app/Models/Question.php`)
- **Fillable:** `name`, `firm`, `email`, `phone`, `message`

### User — Standard Breeze model

---

## Database Tables

| Table | Key Columns |
|-------|-------------|
| `products` | id, title, slug, price (decimal 10,2), discount (int), description, technical_data, category |
| `product_images` | id, product_id (FK cascade), path, sort_order (default 0) |
| `product_related` | id, product_id, related_product_id (both FK cascade, unique pair) |
| `questions` | id, name, firm, email, phone, message |
| `users` | id, name, email, password |

---

## Form Requests

### ProductStoreRequest
- Requires auth
- `title`: required, max 255
- `price` / `discount`: required, numeric, min 0
- `description` / `technical_data`: required string
- `images`: required array 1–5, each jpg/jpeg/png/webp max 4MB
- `related`: nullable array max 5, each must exist in products table
- `category`: nullable string max 100

### ProductUpdateRequest
- Same as store but `images` is nullable (min 0)

---

## Views Structure
```
resources/views/
├── layouts/
│   ├── app.blade.php              ← authenticated admin layout
│   ├── guest.blade.php            ← public layout
│   ├── navigation.blade.php       ← auth nav
│   └── guest-navigation.blade.php
├── components/
│   ├── (inputs, buttons, modal, dropdown)
│   └── sections/
│       ├── hero-section.blade.php
│       ├── categories-section.blade.php
│       ├── addons-hero.blade.php
│       └── basic-info-list.blade.php
├── products/
│   ├── index, show, create, edit .blade.php
│   ├── airlesscategory.blade.php
│   └── peskarenjecategory.blade.php
├── questions/
│   └── index.blade.php
├── auth/           ← Breeze auth views
├── profile/        ← DO NOT TOUCH
├── welcome.blade.php
├── contact.blade.php
└── sitemap.blade.php
```

---

## Known Gaps
1. **QuestionController** — admin cannot edit or delete questions, only view them.
2. **No reply/manage UI** for contact form submissions.
