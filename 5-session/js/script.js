const products = [
  {
    id: 1,
    nama_product: "Logitech MX Master 3S",
    harga: 1500000,
    deskripsi: "Mouse wireless ergonomis dengan sensor 8K DPI dan klik senyap.",
    gambar: "img/p1.webp",
    kategori: "Electronics"
  },
  {
    id: 2,
    nama_product: "Keychron K2 Mechanical Keyboard",
    harga: 1200000,
    deskripsi: "Keyboard mekanik wireless dengan layout 75% dan RGB backlight.",
    gambar: "img/p2.webp",
    kategori: "Electronics"
  },
  {
    id: 3,
    nama_product: "Monitor Dell UltraSharp 27",
    harga: 6500000,
    deskripsi: "Monitor resolusi 4K dengan akurasi warna tinggi untuk desainer.",
    gambar: "img/p3.webp",
    kategori: "Electronics"
  },
  {
    id: 4,
    nama_product: "Meja Kerja Kayu Jati",
    harga: 2500000,
    deskripsi: "Meja kerja minimalis berbahan kayu jati solid dengan finishing halus.",
    gambar: "img/p4.webp",
    kategori: "Home Living"
  },
  {
    id: 5,
    nama_product: "Lampu Meja LED Smart",
    harga: 450000,
    deskripsi: "Lampu meja yang bisa diatur kecerahan dan temperatur warnanya via aplikasi.",
    gambar: "img/p5.webp",
    kategori: "Home Living"
  },
  {
    id: 6,
    nama_product: "Kursi Ergonomis ErgoPlus",
    harga: 3200000,
    deskripsi: "Kursi kantor dengan sandaran lumbar support dan bahan mesh premium.",
    gambar: "img/p6.webp",
    kategori: "Home Living"
  },
  {
    id: 7,
    nama_product: "Tanaman Hias Monstera",
    harga: 150000,
    deskripsi: "Tanaman hias indoor untuk mempercantik sudut ruangan.",
    gambar: "img/p7.webp",
    kategori: "Home Living"
  },
  {
    id: 8,
    nama_product: "Jaket Bomber Oversize",
    harga: 350000,
    deskripsi: "Jaket bomber bahan taslan tahan angin dengan potongan oversize.",
    gambar: "img/p8.webp",
    kategori: "Apparel"
  },
  {
    id: 9,
    nama_product: "Kaos Polos Cotton Combed 30s",
    harga: 85000,
    deskripsi: "Kaos bahan katun premium yang lembut dan menyerap keringat.",
    gambar: "img/p9.webp",
    kategori: "Apparel"
  },
  {
    id: 10,
    nama_product: "Celana Chino Slim Fit",
    harga: 275000,
    deskripsi: "Celana chino stretch yang nyaman untuk acara formal maupun santai.",
    gambar: "img/p10.webp",
    kategori: "Apparel"
  }
];

let kontainer = document.getElementById("tempatProduk");
let inputCari = document.getElementById("inputCari");
let pilihKategori = document.getElementById("pilihKategori");

function tampilkanProduk(daftar) {
    kontainer.innerHTML = "";

    for (let i = 0; i < daftar.length; i++) {
        let p = daftar[i];
        
    
        let kartu = `
            <div class="col">
                <div class="card shadow-sm">
                    <div class="bungkus-gambar">
                        <img src="${p.gambar}" alt="${p.nama_product}">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">${p.nama_product}</h5>
                        <p class="text-muted small">${p.kategori}</p>
                        <p class="card-text">${p.deskripsi}</p>
                        <h6 class="text-primary">Harga: ${p.harga}</h6>
                    </div>
                </div>
            </div>
        `;
        kontainer.innerHTML = kontainer.innerHTML + kartu;
    }
}

inputCari.addEventListener("keyup", function() {
    let ketikan = inputCari.value.toLowerCase();
    let hasilCari = [];

    for (let i = 0; i < products.length; i++) {
        let nama = products[i].nama_product.toLowerCase();
        if (nama.includes(ketikan)) {
            hasilCari.push(products[i]);
        }
    }
    tampilkanProduk(hasilCari);
});

pilihKategori.addEventListener("change", function() {
    let pilihan = pilihKategori.value;
    let hasilFilter = [];

    if (pilihan == "Semua") {
        tampilkanProduk(products);
    } else {
        for (let i = 0; i < products.length; i++) {
            if (products[i].kategori == pilihan) {
                hasilFilter.push(products[i]);
            }
        }
        tampilkanProduk(hasilFilter);
    }
});


tampilkanProduk(products);