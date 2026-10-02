\# Dokumentasi 5 Query Tinker TR 11



1\. Menghitung Jumlah Produk



\### Query

Product::count();



\-> 50



2\. Eager Loading Product dan Category



\### Query

Product::with('category')->first();



\-> Query ini mengambil satu data produk sekaligus memuat relasi category menggunakan eager loading.



3\. Menghitung Order Milik User



\### Query

User::first()->orders->count();



\-> Query ini mengambil user pertama kemudian menghitung jumlah order yang dimilikinya melalui relasi orders



4\. Menghitung Total Harga Order



\###Query

Order::withSum('orderItems as total', 'price')->first();



\->Query ini mengambil order pertama dan menggunakan withSum() untuk menghitung jumlah nilai price dari order items.



5\. Filter Produk Berdasarkan Kategori



\###Query

Product::whereRelation('category', 'name', 'Elektronik')->get();



\->Query ini mengambil produk yang memiliki relasi kategori dengan nama Elektronik.



\--------------

Selain lima query di atas, model Product memiliki scope:

Product::inStock()->count();
->Scope tersebut mengambil produk yang memiliki stok lebih dari 0.





