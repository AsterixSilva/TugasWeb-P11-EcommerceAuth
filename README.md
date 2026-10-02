# Tugas Web P11 - E-Commerce DB + Secure Auth

Project Tugas Rutin 11 menggunakan Laravel yang mencakup database E-Commerce, Eloquent ORM, authentication, multi-role authorization, middleware, dan Policy.

## Teknologi

- Laravel
- PHP
- MySQL
- Laravel Breeze
- Blade
- Eloquent ORM
- Vite
- Pest

## Fitur

### 1. E-Commerce Database

Database terdiri dari tabel:

- `users`
- `categories`
- `products`
- `orders`
- `order_items`
- `tags`
- `product_tag`
- `posts`

Relasi yang digunakan:

- User → Products
- User → Orders
- User → Posts
- Category → Products
- Product → Category
- Product → User
- Product ↔ Tags
- Order → Order Items
- Order Item → Product
- Post → User

Foreign key digunakan untuk menjaga hubungan antar tabel.

## 2. Product CRUD

Tersedia fitur:

- Menampilkan produk
- Menambahkan produk
- Melihat detail produk
- Mengedit produk
- Menghapus produk

Product memiliki relasi dengan:

- Category
- User
- Tag

## 3. Category CRUD

Tersedia fitur:

- Menampilkan kategori
- Menambahkan kategori
- Melihat detail kategori
- Mengedit kategori
- Menghapus kategori

Halaman kategori juga menampilkan jumlah produk pada setiap kategori.

## 4. Factory & Seeder

Database telah diisi menggunakan Factory dan Seeder.

Data yang dibuat:

- Minimal 50 Product
- Minimal 5 Category
- Minimal 10 Tag

Product dibuat dengan data seperti:

- Nama
- Slug
- Deskripsi
- Harga
- Stock
- Category
- User

## 5. Eloquent Scope

Model `Product` memiliki scope:

```php
Product::inStock()->count();
```

Scope `inStock()` digunakan untuk mengambil produk yang memiliki stock lebih dari 0.

## 6. Eloquent Query

Beberapa query yang digunakan:

### Menghitung produk

```php
Product::count();
```

### Eager Loading Category

```php
Product::with('category')->first();
```

### Menghitung Order User

```php
User::first()->orders->count();
```

### Menghitung total harga Order

```php
Order::withSum('orderItems as total', 'price')->first();
```

### Filter produk berdasarkan Category

```php
Product::whereRelation('category', 'name', 'Elektronik')->get();
```

Dokumentasi query tersedia di:

`docs/tinker-queries.md`

## 7. Authentication

Authentication menggunakan Laravel Breeze.

Fitur:

- Register
- Login
- Logout
- Dashboard
- Profile

## 8. Multi-Role

Terdapat tiga role:

- `admin`
- `editor`
- `user`

Role disimpan pada tabel `users`.

### Hak Akses

| Role   | Staff Route | Admin Route |
| ------ | :---------: | :---------: |
| Admin  |      ✓      |      ✓      |
| Editor |      ✓      |      ✗      |
| User   |      ✗      |      ✗      |

Custom middleware `RoleMiddleware` digunakan untuk membatasi akses berdasarkan role.

## 9. Post Policy

`PostPolicy` digunakan untuk mengatur authorization pada Post.

Policy digunakan untuk:

- Update Post
- Delete Post

Aturan:

- Pemilik Post dapat mengedit dan menghapus Post miliknya.
- Admin dapat mengedit dan menghapus Post.
- Editor dapat mengedit dan menghapus Post.
- User lain tidak dapat mengedit atau menghapus Post milik user lain.

Authorization dilakukan menggunakan:

```php
Gate::authorize('update', $post);
```

dan:

```php
Gate::authorize('delete', $post);
```

## 10. Route Protection

Route Product dan Category dilindungi menggunakan authentication middleware:

```php
Route::middleware('auth')->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
});
```

Route berdasarkan role juga digunakan:

```php
Route::middleware(['auth', 'role:admin'])->get('/admin-test', function () {
    return 'Halaman Admin berhasil diakses.';
});
```

```php
Route::middleware(['auth', 'role:admin,editor'])->get('/staff-test', function () {
    return 'Halaman Staff berhasil diakses.';
});
```

## 11. Pengujian Authorization

Pengujian dilakukan menggunakan:

- User yang belum login
- User biasa
- Editor
- Admin
- Browser Incognito

Hasil pengujian:

- User belum login diarahkan ke Login.
- User yang sudah login dapat mengakses Product.
- User biasa ditolak dari Staff Route.
- Editor dapat mengakses Staff Route.
- Editor ditolak dari Admin Route.
- User biasa ditolak ketika mencoba mengedit Post milik Admin.
- Policy Delete juga menolak user yang tidak memiliki izin.

## 12. Instalasi Project

Clone repository:

```bash
git clone https://github.com/AsterixSilva/TugasWeb-P11-EcommerceAuth.git
```

Masuk ke folder:

```bash
cd TugasWeb-P11-EcommerceAuth
```

Install dependency PHP:

```bash
composer install
```

Install dependency JavaScript:

```bash
npm install
```

Copy environment:

```bash
copy .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

Atur database pada `.env`, kemudian jalankan:

```bash
php artisan migrate
```

Build frontend:

```bash
npm run build
```

Jalankan Laravel:

```bash
php artisan serve
```

## 13. Akun Pengujian

### Admin

```text
Email    : admin@gmail.com
Password : password123
Role     : admin
```

### Editor

```text
Email    : editor@gmail.com
Password : password123
Role     : editor
```

> Password di atas digunakan untuk kebutuhan pengujian project.

## 14. Struktur Dokumentasi

```text
TugasWeb-P11-EcommerceAuth/
│
├── app/
│   ├── Http/
│   ├── Models/
│   └── Policies/
│
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
│
├── docs/
│   └── tinker-queries.md
│
├── resources/
│   └── views/
│
├── routes/
│   ├── web.php
│   └── auth.php
│
└── README.md
```

## 15. Status Tugas

- [✔] Database E-Commerce
- [✔] Foreign Key
- [✔] Eloquent Relationships
- [✔] Product CRUD
- [✔] Category CRUD
- [✔] Factory
- [✔] Seeder 50+ Product
- [✔] Eloquent Scope
- [✔] Tinker Queries
- [✔] Laravel Breeze
- [✔] Login/Register/Logout
- [✔] Multi-Role
- [✔] Custom Middleware
- [✔] PostPolicy
- [✔] Route Protection
- [✔] Incognito Testing
- [✔] Dokumentasi
