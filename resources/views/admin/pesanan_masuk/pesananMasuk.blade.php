@extends('dashboard')
@section('content')
@if (session('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
@endif
<style>
    html,
    body {
        width: 100%;
        height: 100%;
        margin: 0px;
        padding: 0px;
    }

    .serif {
        font-family: "Courier New", Courier, monospace !important;
    }

    .serif>* {
        font-family: "Courier New", Courier, monospace !important;
    }

    .just {
        word-wrap: break-word;
    }

    .line-c {
        border: 1px dashed gray;
        margin: 10px;
        height: 1px;
    }

    p {
        margin: 0px;
        padding: 0px;
    }

    #page-top,
    #wrapper,
    #content-wrapper,
    #content {
        height: 100%;
    }

    #snackbar {
        visibility: hidden;
        min-width: 250px;
        margin-left: -125px;
        color: #fff;
        text-align: center;
        border-radius: 10px;
        padding: 16px;
        position: fixed;
        z-index: 9999;
        left: 50%;
        bottom: -20%;
        font-size: 17px;
        transition: 0.5s all;
    }

    #snackbar.show {
        visibility: visible;
        transition: 0.5s all;
        bottom: 10%;
    }

    .brand-name {
        text-decoration: none !important;
    }

    .name-color {
        color: rgb(150, 46, 119);
        margin-left: 15px;
    }
</style>
<div class="table-responsive">
    <table id="table" class="table table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pesanan</th>
                <th>Tanggal Pesanan</th>
                <th>Nama Produk</th>
                <th>ID Bunga Keluar</th>
                <th>ID Barang Keluar</th>
                <th>Status Pesanan</th>
                <th>Total Tagihan</th>
                <th>Jumlah Pesanan</th>
                <th>Biaya Jasa</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;   
            @endphp
            @foreach ($PesananMasuk as $u)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $u->nama_pesanan }}</td>
                    <td>{{ $u->tanggal_pesanan }}</td>
                    <td>{{ $u->nama_produk }}</td>
                    <td>{{ $u->id_bunga_keluar }}</td>
                    <td>{{ $u->id_barang_keluar }}</td>
                    <td>{{ $u->status_pesanan }}</td>
                    <td>{{ $u->total_tagihan }}</td>
                    <td>{{ $u->jumlah_pesanan }}</td>
                    <td>{{ $u->biaya_jasa }}</td>
                    <td>
                        <div class="flex gap-2 justify-center items-center">
                            <a href="{{ route('pesanan_masuk.pesananMasuk.edit', $u->id) }}" class="btn btn-warning">
                                Edit
                            </a>
                            <b onclick="getData('{{$u->id_barang_keluar}}','{{$u->id_bunga_keluar}}',{{$u}})"
                                class="btn print_struk btn-info">
                                Cetak Struk
                            </b>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div id="struk" class="modal fade" tabindex="-1" data-bs-backdrop="true" data-bs-keyboard="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 450px;">
        <div class="modal-content bg-light shadow rounded-lg" style="height: 95%;">
            <div class="modal-header border-bottom-0 pb-0">
                <h1 class="modal-title fs-4 fw-bold">Struk Belanja</h1>
            </div>

            <div class="modal-body serif p-3 d-flex flex-column justify-content-center align-items-center">
                <div id="struk_belanja" class="bg-white rounded-lg p-3 text-center">
                    <b class="d-block fs-5">Kembangku Pontianak</b>
                    <span class="d-block small text-muted">
                        Jalan Wonodadi 1 (Ayani 2/ Arteri Supadio) Gg. H. Bungkus
                    </span>
                    <span class="d-block small text-muted">
                        Ig: @kembangku_pontianak
                    </span>
                    <hr class="my-2">

                    <div class="row">
                        <div class="col-7">
                            <p id="tanggal_struk" class="small text-start mb-1">17/01/2025 13:21</p>
                            <p id="id_struk" class="small text-start mb-1">Id: 3</p>
                        </div>
                        <div class="col-5">
                            <p id="struk_nama" class="small text-start mb-1">Nama Pembeli: Nuri</p>
                        </div>
                    </div>

                    <hr class="my-2">

                    <div id="daftar_item" class="w-100"></div>

                    <p id="jenis_jasa" class="small mt-3 text-start w-100">
                        Jenis Jasa: #
                    </p>

                    <hr class="my-2">

                    <table id="sub_totale" class="small w-100"></table>
                </div>
            </div>

            <div class="modal-footer d-flex flex-column">
                <button id="print_struk" class="btn btn-primary w-100 mb-2">
                    Print Struk
                </button>
                <button id="close_struk" class="btn btn-danger w-100">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap JS (with Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>

    document.getElementById("print_struk").addEventListener("click", function () {
        const element = document.getElementById("struk_belanja"); // Elemen yang ingin dicetak
        const options = {
            margin: 0, // Mengatur margin (gunakan margin kecil agar sesuai dengan kertas struk)
            filename: "struk_belanja.pdf", // Nama file PDF
            image: { type: "jpeg", quality: 1.0 }, // Menggunakan kualitas gambar terbaik
            html2canvas: { scale: 2 }, // Mengatur kualitas rendering
            jsPDF: { unit: "mm", format: "a6", orientation: "portrait" }, // Format A6 dan orientasi portrait
        };
        html2pdf().set(options).from(element).save();
    });

    async function getBungaKeluar(id) {
        const raw = await fetch(`/admin/bunga-keluar/${id}`, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        });
        const result = await raw.json();
        return result;
    }

    async function getBarangKeluar(id) {
        const raw = await fetch(`/admin/barang-keluar/${id}`, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        });
        const result = await raw.json();
        return result;
    }

    class Observer {

        fn_call = {};

        Subscribe(target, callback) {

            if (target instanceof Array) {
                for (let _target of target) {
                    if (this.fn_call.hasOwnProperty(_target)) {
                        this.fn_call[_target].push(callback);
                    } else {
                        this.fn_call[_target] = [callback];
                    }
                }
            } else {
                if (this.fn_call.hasOwnProperty(target)) {
                    this.fn_call.push(callback);
                } else {
                    this.fn_call[target] = [callback];
                }
            }

        }

        Emit(target, data) {

            if (target instanceof RegExp) {
                const keys = Object.keys(this.fn_call);
                const found_key = keys.filter(key => key.match(target));
                for (let target_name of found_key) {
                    for (let callback of this.fn_call[target_name]) {
                        callback(data);
                    }
                }
            } else {
                if (this.fn_call.hasOwnProperty(target)) {
                    for (let callback of this.fn_call[target]) {
                        callback(data);
                    }
                }
            }


        }

        UnSubscribe(target) {
            if (this.fn_call.hasOwnProperty(target)) {
                delete this, fn_call[target];
            }
        }
    }

    const observer = new Observer();
    function reactive(obj, parent_property) {
        return new Proxy(obj, {
            set(target, property, value, receiver) {
                const data = Reflect.set(target, property, value, receiver);
                if (!parent_property) {
                    observer.Emit(property, target);
                } else {
                    observer.Emit(`${parent_property}.${property}`, target);
                }
                return data;
            },
            get(target, property, receiver) {
                const data = Reflect.get(target, property, receiver);
                if (data instanceof Object) {
                    if (!parent_property) {
                        return reactive(data, property);
                    }
                    return reactive(data, `${parent_property}.${property}`);
                }
                return data;
            }
        });
    }


    async function getData(id_barang_keluar, id_bunga_keluar, all) {

        const data = {
            total: 0,
            nama_pembeli: "",
            nama_produk: "",
            biaya_jasa: 0,
            pembayaran: 0,
            kembalian: 0,
            total_pesanan: 0,
            sub_total: 0,
            items: {},
            struk_id: 0
        };

        const result = await Promise.all([
            getBarangKeluar(id_barang_keluar),
            getBungaKeluar(id_bunga_keluar)
        ]);

        result.forEach(a => {
            a.forEach(d => {
                if (d.hasOwnProperty('nama_bunga')) {
                    data.items[d.nama_bunga] = {
                        harga_barang: d.harga_bunga,
                        jumlah: d.jumlah_bunga,
                        id_kategori: d.id,
                        id_bunga: d.id_bunga,
                        kategori: 'bunga',
                        nama_bunga: d.nama_bunga
                    };
                }

                if (d.hasOwnProperty('nama_barang')) {
                    data.items[d.nama_barang] = {
                        harga_barang: d.harga_barang,
                        jumlah: d.jumlah_barang,
                        id_kategori: null,
                        id_barang: d.id,
                        kategori: 'barang',
                        nama_barang: d.nama_barang
                    };
                }
            });
        });

        const bind = reactive(data);
        bind.nama_pembeli = all.nama_pesanan;
        bind.total = all.total_tagihan;
        bind.nama_produk = all.nama_produk;
        bind.biaya_jasa = all.biaya_jasa;
        bind.pembayaran = all.pembayaran;
        bind.kembalian = all.kembalian;
        bind.struk_id = all.id;
        bind.total_pesanan = all.jumlah_pesanan;

        PrintStruk(bind);

    }


    function formatToRupiah(amount) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).format(amount);
    }

    function createItemStruk(
        nama,
        jumlah,
        harga,
        total
    ) {
        // Membuat elemen div utama
        const container = document.createElement('div');
        container.style.width = "100%";
        container.className = 'd-flex justify-content-between align-items-center mb-3';

        // Membuat div untuk bagian kiri
        const leftDiv = document.createElement('div');
        leftDiv.className = 'col-8 h-100 d-flex flex-column justify-content-left text-start';

        // Menambahkan elemen bold untuk judul
        const title = document.createElement('b');
        title.className = 'text-sm text-left w-100';
        title.textContent = nama;

        // Menambahkan paragraf untuk deskripsi
        const description = document.createElement('p');
        description.className = 'text-sm text-left w-100';
        description.textContent = `Jumlah ${jumlah}, harga ${formatToRupiah(harga)}`;

        // Menyusun elemen dalam leftDiv
        leftDiv.appendChild(title);
        leftDiv.appendChild(description);

        // Membuat div untuk bagian kanan
        const rightDiv = document.createElement('div');
        rightDiv.className = 'col-4 h-100 d-flex flex-column justify-content-center text-end';

        // Menambahkan paragraf untuk harga total
        const totalPrice = document.createElement('p');
        totalPrice.className = 'text-sm w-100 ';
        totalPrice.textContent = formatToRupiah(total);

        // Menyusun elemen dalam rightDiv
        rightDiv.appendChild(totalPrice);

        // Menyusun kedua div ke dalam container utama
        container.appendChild(leftDiv);
        container.appendChild(rightDiv);

        return container;
    }

    function createRowElement(
        label,
        nilai
    ) {
        // Membuat elemen <tr>
        const row = document.createElement('tr');
        row.className = 'd-flex';

        // Membuat elemen <td> untuk label "Sub Total"
        const labelCell = document.createElement('td');
        labelCell.className = 'col-4';
        const boldText = document.createElement('b');
        boldText.textContent = label;
        labelCell.appendChild(boldText);

        // Membuat elemen <td> untuk tanda ":"
        const colonCell = document.createElement('td');
        colonCell.className = 'col-2 text-center';
        colonCell.textContent = ':';

        // Membuat elemen <td> untuk nilai "Rp 40.000,00"
        const valueCell = document.createElement('td');
        valueCell.className = 'col-6 text-end';
        valueCell.textContent = nilai;

        // Menyusun elemen <td> ke dalam <tr>
        row.appendChild(labelCell);
        row.appendChild(colonCell);
        row.appendChild(valueCell);

        return row;
    }

    const close_struk = document.getElementById('close_struk');

    const struk = new bootstrap.Modal(document.getElementById('struk'));
    close_struk.onclick = _ => {
        struk.hide();
    };

    function PrintStruk(bind) {
        const body = {
            total: parseFloat(bind.total),
            total_pesanan: parseFloat(bind.total_pesanan),
            nama_pembeli: bind.nama_pembeli,
            pembayaran: parseFloat(bind.pembayaran),
            kembalian: parseFloat(bind.kembalian),
            biaya_jasa: parseFloat(bind.biaya_jasa),
            nama_produk: bind.nama_produk,
            items: Object.keys(bind.items).map(d => bind.items[d])
        };

        id_struk.innerHTML = `Id: ${bind.struk_id}`;
        // const struk = new bootstrap.Modal(document.getElementById('struk'));
        struk.show();

        [...daftar_item.children].forEach(d => d.remove());

        const t = new Date();
        tanggal_struk.innerHTML = `${t.getDate()}/${t.getMonth() + 1}/${t.getFullYear()} ${t.getHours()}:${t.getMinutes()}`;

        struk_nama.innerHTML = `Nama Pembeli: ${body.nama_pembeli}`;

        jenis_jasa.innerHTML = `Jenis Jasa: ${body.nama_produk}`;

        let sub_total = 0;
        body.items.forEach(d => {
            sub_total += d.jumlah * d.harga_barang;
            daftar_item.appendChild(
                createItemStruk(
                    d[d.kategori === "bunga" ? 'nama_bunga' : 'nama_barang'],
                    d.jumlah,
                    d.harga_barang,
                    d.jumlah * d.harga_barang
                )
            );
        });

        [...sub_totale.children].forEach(d => d.remove());

        sub_totale.appendChild(
            createRowElement(
                "Sub Total",
                formatToRupiah(sub_total)
            )
        );

        sub_totale.appendChild(
            createRowElement(
                "Biaya Jasa",
                formatToRupiah(body.biaya_jasa)
            )
        );

        sub_totale.appendChild(
            createRowElement(
                "Total",
                formatToRupiah(sub_total + body.biaya_jasa)
            )
        );

        sub_totale.appendChild(
            createRowElement(
                "Bayar",
                formatToRupiah(body.pembayaran)
            )
        );

        sub_totale.appendChild(
            createRowElement(
                "Kembali",
                formatToRupiah(body.kembalian)
            )
        );
    }


</script>
@endsection