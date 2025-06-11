<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // Daftar kategoris yang tersedia
    private $kategoris = [
        'elektronik' => [
            'name' => 'Elektronik',
            'icon' => 'M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z',
            'color' => 'red'
        ],
        'fashion' => [
            'name' => 'Fashion',
            'icon' => 'M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4 4 4 0 004-4V5z',
            'color' => 'pink'
        ],
        'buku' => [
            'name' => 'Buku',
            'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
            'color' => 'blue'
        ],
        'alat' => [
            'name' => 'Alat',
            'icon' => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z',
            'color' => 'green'
        ],
        'olahraga' => [
            'name' => 'Olahraga',
            'icon' => 'M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm0 18a8 8 0 110-16 8 8 0 010 16z',
            'color' => 'yellow'
        ],
        'lainnya' => [
            'name' => 'Lainnya',
            'icon' => 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z',
            'color' => 'purple'
        ]
    ];

    public function index()
    {
        return view('kategori.index', [
            'kategoris' => $this->kategoris
        ]);
    }

    public function show($slug)
    {
        // Cek apakah kategoris exist
        if (!isset($this->kategoris[$slug])) {
            abort(404, 'Kategori tidak ditemukan');
        }

        $kategoris = $this->kategoris[$slug];
        
        // Ambil produk berdasarkan kategoris
        $produk = Product::where('kategori', $slug)
                        ->where('status', 'tersedia')
                        ->orderBy('created_at', 'desc')
                        ->paginate(12);

        return view('kategori.show', [
            'kategori' => $kategoris,
            'slug' => $slug,
            'produk' => $produk
        ]);
    }
}