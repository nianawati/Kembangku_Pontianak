@extends('karyawan.layout')
@section('content')
    <style>
        .dgrid {
            width: 100%;
            height: fit-content;
            padding: 10px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            justify-content: center;
            align-items: center;
            align-content: center;
            justify-items: center;
            gap: 10px;
        }

        .dgrid-item {
            width: 100%;
            height: fit-content;
            padding: 10px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            justify-content: center;
            align-items: center;
            align-content: center;
            justify-items: center;
            gap: 10px;
        }

        .mmodal-hide {
            transition: 0.5s all ease-in-out;
            display: flex;
            /* opacity: 0; */
            overflow-x: hidden;
            left: -100%;
            /* left: 0%; */
            /* width: 0%; */
        }

        .mmodal-show1 {
            transition: 0.5s all ease-in-out;
            display: flex;
            overflow-x: hidden;
            left: 50%;
            /* opacity: 1.0; */
            /* width: 100%; */
        }

        .mmodal-show2 {
            transition: 0.5s all ease-in-out;
            display: flex;
            overflow-x: hidden;
            left: 0%;
            /* opacity: 1.0; */
            /* width: 100%; */
        }
    </style>
    <div class="dgrid">
        @foreach ($Unit as $unit)
            <div nama_unit="{{ $unit->nama_unit }}" biaya_jasa="{{ $unit->biaya_jasa }}"
                class="cursor-pointer card-items flex-shrink-0 flex flex-col justify-between items-center m-6 relative overflow-hidden bg-pink-400 rounded-lg w-full h-full shadow-lg">
                <svg class="absolute bottom-0 left-0 mb-8" viewBox="0 0 375 283" fill="none"
                    style="transform: scale(1.5); opacity: 0.1;">
                    <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)"
                        fill="white" />
                    <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)"
                        fill="white" />
                </svg>
                <div class="relative pt-10 px-10 flex items-center justify-center">
                    <div class="block absolute w-48 h-48 bottom-0 left-0 -mb-24 ml-3"
                        style="background: radial-gradient(rgb(194, 55, 194), transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;">
                    </div>
                    <img class="relative w-35 rounded-lg shadow-lg" src="{{ '/uploads/' . $unit->foto }}" alt="">
                </div>
                <div class="relative text-white px-6 pb-6 mt-6">
                    <span class="block opacity-75 -mb-1 text-center">Kembangku</span>
                    <div class="flex gap-[5px] justify-between flex-col">
                        <span class="block font-bold text-xl">{{ $unit->nama_unit }}</span>
                        <span class="block font-semibold text-md text-center">Biaya Jasa</span>
                        <span
                            class="bg-pink-500 rounded-full text-slate-100 text-xs font-bold px-3 py-2 leading-none flex justify-center items-center">
                            Rp. {{ number_format($unit->biaya_jasa, 0, ',', '.') . ',00' }}
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div id="sidebar_menus"
        class="overflow-y-auto mmodal-hide w-[50%] z-20 h-full pb-[260px] bg-white fixed bottom-0 right-0 shadow-lg">
        <div class="dgrid-item">
            @php
                $index = 0;
            @endphp
            @foreach ($Kategori as $kategori)
                <div
                    class="cursor-pointer items-category flex flex-col justify-between items-center relative overflow-hidden rounded-lg w-full h-full shadow-lg">
                    <div class="relative items-center w-full h-[200px] flex justify-center">
                        <img class="relative w-full object-cover h-full" src="{{ '/foto_bunga/' . $kategori->foto }}"
                            alt="">
                        <div class="w-full h-fit absolute bottom-0 left-0 p-[20px]"
                            style="background: linear-gradient(rgba(0,0,0,0),rgba(0,0,0,1.0));">
                            <span class="block opacity-75 -mb-1 text-white">Kembangku</span>
                            <span class="block font-semibold text-xl text-white">{{ $kategori->nama_bunga }}</span>
                        </div>
                    </div>
                    <div class="flex w-full justify-between items-start flex-col text-slate-700 px-6 pb-6 mt-6">
                        <div class="flex w-full gap-[20px] justify-between">
                            <span default_jumlah="{{ $kategori->jumlah_bunga_dijual }}" class="block text-lg tersedia"
                                nama_barang="{{ $kategori->nama_bunga }}">Tersedia:
                                {{ $kategori->jumlah_bunga_dijual }}</span>
                            <span
                                class=" bg-pink-500 rounded-full text-slate-100 text-xs font-bold px-3 py-2 leading-none flex items-center">
                                Rp. {{ $kategori->harga_bunga }}
                            </span>
                        </div>
                        <div class="flex w-full justify-center items-center gap-[10px]">
                            <label class="text-sm" for="jumlah_bunga{{ $index }}">Jumlah bunga yang
                                digunakan</label>
                            <input min="0" max="{{ $kategori->jumlah_bunga_dijual }}" value="0"
                                nama_barang="{{ $kategori->nama_bunga }}" oninput="setItems(this)"
                                id="jumlah_bunga{{ $index }}"
                                class="w-full input_nilai border-2 font-bold border-pink-500 rounded-lg p-[5px] px-[10px]"
                                type="number" placeholder="Jumlah bunga" />
                        </div>
                    </div>
                </div>
                @php
                    $index++;
                @endphp
            @endforeach
            @php
                $index = 0;
            @endphp
            @foreach ($BarangMasuk as $barangMasuk)
                <div
                    class="cursor-pointer items-category flex flex-col justify-between items-center relative overflow-hidden rounded-lg w-full h-full shadow-lg">
                    <div class="relative items-center w-full h-[200px] flex justify-center">
                        <img class="relative w-full object-cover h-full" src="{{ '/foto_barang/' . $barangMasuk->foto }}"
                            alt="">
                        <div class="w-full h-fit absolute bottom-0 left-0 p-[20px]"
                            style="background: linear-gradient(rgba(0,0,0,0),rgba(0,0,0,1.0));">
                            <span class="block opacity-75 -mb-1 text-white">Kembangku</span>
                            <span class="block font-semibold text-xl text-white">{{ $barangMasuk->nama_barang }}</span>
                        </div>
                    </div>
                    <div class="flex w-full justify-between items-start flex-col text-slate-700 px-6 pb-6 mt-6">
                        <div class="flex w-full gap-[20px] justify-between">
                            <span default_jumlah="{{ $barangMasuk->jumlah_barang }}" class="block text-lg tersedia"
                                nama_barang="{{ $barangMasuk->nama_barang }}">Tersedia:
                                {{ $barangMasuk->jumlah_barang }}</span>
                            <span
                                class=" bg-pink-500 rounded-full text-slate-100 text-xs font-bold px-3 py-2 leading-none flex items-center">
                                Rp. {{ $barangMasuk->harga_barang }}
                            </span>
                        </div>
                        <div class="flex justify-center w-full items-center gap-[10px]">
                            <label class="text-sm" for="jumlah_bunga{{ $index }}">Jumlah barang yang
                                digunakan</label>
                            <input min="0" value="0" max="{{ $barangMasuk->jumlah_barang }}"
                                nama_barang="{{ $barangMasuk->nama_barang }}" oninput="setItems(this)"
                                id="jumlah_bunga{{ $index }}"
                                class="w-full input_nilai_barang border-2 input_nilai_barang font-bold border-pink-500 rounded-lg p-[5px] px-[10px]"
                                type="number" placeholder="Jumlah bunga" />
                        </div>
                    </div>
                </div>
                @php
                    $index++;
                @endphp
            @endforeach
        </div>
    </div>

    <div id="sidebar_inputs"
        class="h-full mmodal-hide z-20 fixed w-[50%] bg-white top-0 right-0 shadow-lg justify-between items-center flex-col">
        
        <div class="w-full h-full p-[15px] flex justify-center items-center">
            <div class="w-[50%] h-full flex justify-between items-center flex-col">
                <div class="h-[300px] w-full flex-col flex justify-start items-center gap-[10px] p-[10px] overflow-y-auto">
                    <h1 class="text-xl pt-[20px] m-0 p-0 w-full font-bold text-slate-900">Items: </h1>
                    <div id="items_parent"
                        class="flex-col w-full overflow-y-auto h-fullrounded-lg flex justify-start items-center gap-[10px]">
                        <div id="start_items"
                            class="w-full h-fit flex bg-pink-500 p-[5px] rounded-lg justify-between items-center">
                            <span class="text-purple-50 w-full text-sm nama">Bunga Rotan</span>
                            <span class="text-purple-50 w-full text-sm jumlah">Jumlah : 100</span>
                            <span class="text-purple-50 w-full text-sm total">Total : Rp. 200000</span>
                        </div>
                    </div>
                </div>
                <div class="h-fit w-full flex justify-center items-start flex-col">
                    <h1 class="text-xl py-[10px] px-[20px] text-slate-900 w-full">
                        Sub Total :
                    </h1>
                    <p id="sub_total" class="text-slate-900 text-pretty text-2xl font-extrabold px-[20px] break-words"
                        style="word-break: break-word">
                        Rp. 0,00
                    </p>
                    <h1 class="text-xl py-[10px] px-[20px] text-slate-900 w-full">
                        Biaya Jasa :
                    </h1>
                    <p id="biaya_jasa" class="text-slate-900 text-pretty text-2xl font-extrabold px-[20px] break-words"
                        style="word-break: break-word">
                        Rp. 0,00
                    </p>
                    <h1 class="text-xl py-[10px] px-[20px] text-slate-900 w-full">
                        Total :
                    </h1>
                    <p id="total_harga" class="text-slate-900 text-pretty text-3xl font-extrabold px-[20px] break-words"
                        style="word-break: break-word">
                        Rp. 0,00
                    </p>
                </div>
            </div>
            <div class="w-[50%] h-full flex justify-between items-center flex-col">
                <div class="h-fit w-full gap-[10px] px-[10px] flex justify-center items-center flex-col">
                    <div class="w-full h-fit gap-[5px] flex justify-center items-start flex-col">
                        <label for="nama_pembeli" class="text-md mb-2 m-0 p-0 text-slate-900">Nama Pembeli</label>
                        <input id="nama_pembeli" type="text" placeholder="Nama"
                            class="border-2 border-pink-500 outline-none w-full text-slate-800 rounded-lg p-[5px]" />
                    </div>
                    <div class="w-full h-fit gap-[5px] flex justify-center items-start flex-col">
                        <label for="pembayaran" class="text-md mb-2 m-0 p-0 text-slate-900">Pembayaran</label>
                        <input min="0" value="0" oninput="updatePembayaran(this)" id="pembayaran" type="number"
                            placeholder="Rp. 000"
                            class="border-2 border-pink-500 outline-none w-full text-slate-800 rounded-lg p-[5px]" />
                    </div>
                    <div class="w-full h-fit flex justify-center items-start flex-col">
                        <label for="kembalian" class="text-md mb-2 m-0 p-0 text-slate-900">Kembalian</label>
                        <b id="kembalian" readonly type="number" placeholder="Rp. 000"
                            class="w-full text-black border-pink-500 rounded-lg p-[5px]">Rp. 0,00</b>
                    </div>
                    
                </div>
                <div class="h-fit w-full flex-col flex justify-start items-start gap-[10px] p-[10px] overflow-y-auto">
                    <h1 class="text-xl px-[20px] pt-[20px] m-0 p-0 w-full font-bold text-slate-900">Menu</h1>
                    <div class="w-full h-fit gap-[5px] flex justify-center items-start flex-col">
                        <label for="pesanan" class="text-md m-0 p-0 text-slate-900">Total Pesanan</label>
                        <input id="pesanan" min="1" value="1" type="number" placeholder="0"
                            class="border-2 border-pink-500 outline-none w-full text-slate-800 rounded-lg p-[5px]"
                            type="text" />
                    </div>
                    <button id="tambah_order" class="w-full rounded-lg bg-pink-500 text-purple-50 p-[10px]">
                        Tambah Transaksi
                    </button>
                    <button id="close_modal" class="w-full rounded-lg bg-red-100 text-red-700 p-[10px]">
                        Batalkan Transaksi
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div
        id="struk"
        class="fixed w-[400px] gap-[20px] h-[95%] p-[20px] overflow-y-auto rounded-lg bg-slate-100 shadow-lg hidden items-center justify-start flex-col left-0 right-0 top-0 bottom-0 m-auto z-40">
        <h1 class="text-2xl font-bold">Struk Belanja</h1>

        <div id="struk_belanja" class="bg-white rounded-lg p-[1rem] serif flex-col flex justify-center items-center">
            <b class="text-xl">Kembangku Pontianak</b>
            <span class="text-sm just text-center">
                Jalan Wonodadi 1 (Ayani 2/ Arteri Supadio) Gg. H. Bungkus
            </span>
            <span class="text-sm just text-center">
                Ig: @kembangku_pontianak
            </span>
            <div class="line-c w-full"></div>

            <div class="w-full flex justify-center items-center flex-wrap">
                <div class="w-[60%] h-[50px] flex justify-center items-center flex-col">
                    <p id="tanggal_struk" class="text-sm just text-left w-full">17/01/2025 13:21</p>
                    <p id="id_struk" class="text-sm just text-left w-full">Id: 3</p>
                </div>
                <div class="w-[40%] h-fit flex justify-right items-center justify-start flex-col">
                    <p id="struk_nama" class="text-sm just text-left w-full">Nama Pembeli: Nuri</p>
                </div>
            </div>

            <div class="line-c w-full"></div>

            <div id="daftar_item" class="w-full h-fit">

            </div>

            <p id="jenis_jasa" class="text-sm mt-[20px] just text-left w-full">
                Jenis Jasa: #
            </p>
            <div class="line-c w-full"></div>
            <table id="sub_totale" class="text-sm w-full">
                
            </table>
        </div>
        <button id="print_struk"
            class="px-4 py-2 bg-pink-500 text-white rounded hover:bg-pink-600 focus:outline-none w-full focus:ring-2 focus:ring-pink-300">
            Print Struk
        </button>
        <button id="close_struk"
            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 focus:outline-none w-full focus:ring-2 focus:ring-red-300">
            Tutup
        </button>
    </div>

    <script>
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

        const data = {
            total: 0,
            nama_pembeli: "",
            nama_produk: "",
            biaya_jasa: 0,
            pembayaran: 0,
            kembalian: 0,
            total_pesanan: 0,
            sub_total: 0,
            items: {}
        };

        const data_bunga =
            <?php
            echo $Kategori;
            ?>;

        const data_barang =
            <?php
            echo $BarangMasuk;
            ?>;

        const all_items = [];
        tambah_order.disabled = true;
        const node = start_items.cloneNode(true);
        start_items.remove();

        data_bunga.forEach(d => {

            const _node = node.cloneNode(true);
            const nama = _node.querySelector(".nama");
            const jumlah = _node.querySelector(".jumlah");
            const total = _node.querySelector(".total");
            nama.innerText = d.nama_bunga;
            jumlah.innerText = `Jumlah Bunga : 0`;
            total.innerText = `Total Harga: 0`;
            _node.style.display = "none";

            data.items[d.nama_bunga] = {
                harga_barang: d.harga_bunga,
                jumlah: 0,
                id_kategori: d.id,
                id_bunga: d.id_bunga,
                kategori: d.kategori,
                nama_bunga: d.nama_bunga,
                element: _node
            };

            items_parent.appendChild(_node);
        });

        data_barang.forEach(d => {

            const _node = node.cloneNode(true);
            const nama = _node.querySelector(".nama");
            const jumlah = _node.querySelector(".jumlah");
            const total = _node.querySelector(".total");
            nama.innerText = d.nama_barang;
            jumlah.innerText = `Jumlah Barang : 0`;
            total.innerText = `Total Harga: 0`;
            _node.style.display = "none";

            data.items[d.nama_barang] = {
                harga_barang: d.harga_barang,
                jumlah: 0,
                id_kategori: null,
                id_barang: d.id,
                kategori: d.kategori,
                nama_barang: d.nama_barang,
                element: _node
            };

            items_parent.appendChild(_node);
        });

        data_bunga.forEach(d => {
            observer.Subscribe(
                [
                    `items.${d.nama_bunga}.harga_barang`,
                    `items.${d.nama_bunga}.jumlah`
                ],
                (target) => {

                    const _node = target.element;
                    const jumlah = _node.querySelector(".jumlah");
                    const total = _node.querySelector(".total");

                    const formatter = new Intl.NumberFormat("id-ID", {
                        style: "currency",
                        currency: "IDR"
                    });

                    if (target.jumlah > 0) {
                        _node.style.display = "flex";
                        jumlah.innerText = `Jumlah Bunga : ${target.jumlah}`;
                        total.innerText =
                            `Total Harga: ${formatter.format(target.jumlah * target.harga_barang)}`;
                        const element_tersedia = document.querySelector(
                            `.tersedia[nama_barang="${d.nama_bunga}"]`);
                        const jumlah_tersedia = parseFloat(element_tersedia.getAttribute("default_jumlah"));
                        element_tersedia.innerText = `Tersedia: ${Math.abs(jumlah_tersedia - target.jumlah)}`;
                        updateTotalHarga();
                    } else {
                        _node.style.display = "none";
                        jumlah.innerText = `Jumlah Barang : 0`;
                        total.innerText = `Total Harga: ${formatter.format(0)}`;
                        const element_tersedia = document.querySelector(
                            `.tersedia[nama_barang="${d.nama_bunga}"]`);
                        const jumlah_tersedia = parseFloat(element_tersedia.getAttribute("default_jumlah"));
                        element_tersedia.innerText = `Tersedia: ${Math.abs(jumlah_tersedia - target.jumlah)}`;
                        updateTotalHarga();
                    }

                });
        });

        data_barang.forEach(d => {
            observer.Subscribe(
                [
                    `items.${d.nama_barang}.harga_barang`,
                    `items.${d.nama_barang}.jumlah`
                ],
                (target) => {

                    const _node = target.element;
                    const jumlah = _node.querySelector(".jumlah");
                    const total = _node.querySelector(".total");

                    const formatter = new Intl.NumberFormat("id-ID", {
                        style: "currency",
                        currency: "IDR"
                    });

                    if (target.jumlah > 0) {
                        _node.style.display = "flex";
                        jumlah.innerText = `Jumlah Barang : ${target.jumlah}`;
                        total.innerText =
                            `Total Harga: ${formatter.format(target.jumlah * target.harga_barang)}`;
                        const element_tersedia = document.querySelector(
                            `.tersedia[nama_barang="${d.nama_barang}"]`);
                        const jumlah_tersedia = parseFloat(element_tersedia.getAttribute("default_jumlah"));
                        element_tersedia.innerText = `Tersedia: ${Math.abs(jumlah_tersedia - target.jumlah)}`;
                        updateTotalHarga();
                    } else {
                        _node.style.display = "none";
                        jumlah.innerText = `Jumlah Barang : 0`;
                        total.innerText = `Total Harga: ${formatter.format(0)}`;
                        const element_tersedia = document.querySelector(
                            `.tersedia[nama_barang="${d.nama_barang}"]`);
                        const jumlah_tersedia = parseFloat(element_tersedia.getAttribute("default_jumlah"));
                        element_tersedia.innerText = `Tersedia: ${Math.abs(jumlah_tersedia - target.jumlah)}`;
                        updateTotalHarga();
                    }

                });
        });

        observer.Subscribe("total", (target) => {
            const formatter = new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR"
            });
            total_harga.innerText = formatter.format(target.total).toString();
        });

        observer.Subscribe("pembayaran", (target) => {
            bind.kembalian = target.pembayaran - target.total;
        });

        observer.Subscribe("sub_total",(target)=>{
            const formatter = new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR"
            });
            sub_total.innerText = formatter.format(target.sub_total); 
        });

        observer.Subscribe("kembalian", (target) => {
            const formatter = new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR"
            });
            if (target.kembalian >= 0) {
                tambah_order.disabled = false;
            } else {
                tambah_order.disabled = true;
            }
            kembalian.innerText = formatter.format(target.kembalian);
        });

        function updatePembayaran(element) {
            bind.pembayaran = element.value;
        }

        function updateTotalHarga() {
            const keys = Object.keys(bind.items);

            let total = 0;
            for (let key of keys) {
                total += bind.items[key].jumlah * bind.items[key]["harga_barang"];
            }

            bind.sub_total = total;
            bind.total = (total  + parseFloat(bind.biaya_jasa)) * pesanan.value;
            bind.pembayaran = pembayaran.value;

        }

        const bind = reactive(data);

        function setItems(element) {
            if (element.value.length === 0) {
                element.value = 0;
            }
            const nama_item = element.getAttribute('nama_barang');
            bind.items[nama_item].jumlah = parseFloat(element.value);
            bind.items[nama_item].input_element = element;
        }

        const cards = document.querySelectorAll(".card-items");
        const biaya_jasa = document.querySelector("#biaya_jasa");
        cards.forEach(d => {
            d.onclick = _ => {
                bind.nama_produk = d.getAttribute("nama_unit");
                bind.biaya_jasa = d.getAttribute("biaya_jasa");
                const formatter = new Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR"
                });
                biaya_jasa.innerHTML = formatter.format(bind.biaya_jasa);
                updateTotalHarga();
                sidebar_menus.classList.add("mmodal-show2");
                sidebar_inputs.classList.add("mmodal-show1");
                sidebar_inputs.classList.remove("mmodal-hide");
                sidebar_menus.classList.remove("mmodal-hide");
            }
        });


        function clear_all() {
            sidebar_inputs.classList.add("mmodal-hide");
            sidebar_menus.classList.add("mmodal-hide");
            sidebar_menus.classList.remove("mmodal-show2");
            sidebar_inputs.classList.remove("mmodal-show1");
            pembayaran.value = 0;

            bind.total = 0;
            bind.kembalian = 0;
            bind.pembayaran = 0;

            const keys = Object.keys(bind.items);
            for (let key of keys) {
                bind.items[key].jumlah = 0;
            }

            document.querySelectorAll(".input_nilai").forEach(d => {
                d.value = 0;
            });
        }

        close_modal.onclick = _ => {

            clear_all();

        };

        nama_pembeli.oninput = _ => {
            bind.nama_pembeli = nama_pembeli.value;
        };

        pesanan.oninput = _ => {
            updateTotalHarga();
            if (pesanan.value.length === 0) {
                pesanan.value = 1;
            }
            bind.total_pesanan = parseFloat(pesanan.value);
            // bind.total = bind.total * pesanan.value;
            updateTotalHarga();
            bind.pembayaran = pembayaran.value;
        };

        async function toast(message) {
            return new Promise((res, rej) => {
                let x = document.querySelector("#snackbar");
                x.innerHTML = message;
                x.classList.add("show");
                setTimeout(function() {
                    x.classList.remove("show");
                    res(true);
                }, 3000);
            });
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
        ){
            // Membuat elemen div utama
            const container = document.createElement('div');
            container.className = 'w-full flex justify-center items-center flex-wrap mb-[10px]';

            // Membuat div untuk bagian kiri
            const leftDiv = document.createElement('div');
            leftDiv.className = 'w-[60%] h-[50px] flex justify-center items-center flex-col';

            // Menambahkan elemen bold untuk judul
            const title = document.createElement('b');
            title.className = 'text-sm just text-left w-full';
            title.textContent = nama;

            // Menambahkan paragraf untuk deskripsi
            const description = document.createElement('p');
            description.className = 'text-sm just text-left w-full';
            description.textContent = `Jumlah ${jumlah}, harga ${formatToRupiah(harga)}`;

            // Menyusun elemen dalam leftDiv
            leftDiv.appendChild(title);
            leftDiv.appendChild(description);

            // Membuat div untuk bagian kanan
            const rightDiv = document.createElement('div');
            rightDiv.className = 'w-[40%] h-[50px] flex justify-right items-center justify-start flex-col';

            // Menambahkan paragraf untuk harga total
            const totalPrice = document.createElement('p');
            totalPrice.className = 'text-sm just text-left w-full';
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
        ){
            // Membuat elemen <tr>
            const row = document.createElement('tr');
            row.className = 'flex';
            // Membuat elemen <td> untuk label "Sub Total"
            const labelCell = document.createElement('td');
            labelCell.className = 'w-[40%]';
            const boldText = document.createElement('b');
            boldText.textContent = label;
            labelCell.appendChild(boldText);

            // Membuat elemen <td> untuk tanda ":"
            const colonCell = document.createElement('td');
            colonCell.className = 'w-[20%]';
            colonCell.textContent = ':';

            // Membuat elemen <td> untuk nilai "Rp 40.000,00"
            const valueCell = document.createElement('td');
            valueCell.className = 'w-[40%] text-right';
            valueCell.textContent = nilai;

            // Menyusun elemen <td> ke dalam <tr>
            row.appendChild(labelCell);
            row.appendChild(colonCell);
            row.appendChild(valueCell);

            return row;
        }

        close_struk.onclick = _=>{
            struk.classList.add("hidden");
            struk.classList.remove("flex");
        }

        // mengirimkan order ke server
        // ketika tombol tambah order di klik
        tambah_order.onclick = async _ => {

            const body = {
                total: parseFloat(bind.total),
                total_pesanan: parseFloat(pesanan.value),
                nama_pembeli: bind.nama_pembeli,
                pembayaran: parseFloat(bind.pembayaran),
                kembalian: parseFloat(bind.kembalian),
                biaya_jasa: parseFloat(bind.biaya_jasa),
                nama_produk: bind.nama_produk,
                items: Object.keys(bind.items).map(d => bind.items[d]).filter(d => d.jumlah > 0)
            };

            [...daftar_item.children].forEach(d => d.remove());

            const t = new Date();
            tanggal_struk.innerHTML = `${t.getDate()}/${t.getMonth()+1}/${t.getFullYear()} ${t.getHours()}:${t.getMinutes()}`;

            struk_nama.innerHTML = `Nama Pembeli: ${body.nama_pembeli}`;

            jenis_jasa.innerHTML = `Jenis Jasa: ${body.nama_produk}`;

            let sub_total = 0;
            body.items.forEach(d =>{
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

            // ini ajax
            const raw_data = await fetch("<?= route('test') ?>", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "<?= csrf_token() ?>",
                    "Authorization": "Bearer <?= session('kembangku_user_token') ?>",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(body)
            });

            const result = await raw_data.json();
            console.log(result, body);
            toast(result.message);
            if (result.status) {

                id_struk.innerHTML = `Id: ${result.struk_id}`;
                struk.classList.add("flex");
                struk.classList.remove("hidden");
                for (let item of Object.keys(bind.items)) {
                    if (bind.items[item].kategori === "bunga" && bind.items[item].jumlah > 0) {
                        const element_input_nilai = document.querySelector(
                            `.input_nilai[nama_barang="${bind.items[item].nama_bunga}"]`);
                        const element_tersedia = document.querySelector(
                            `.tersedia[nama_barang="${bind.items[item].nama_bunga}"]`);
                        const jumlah_default = parseFloat(element_tersedia.getAttribute("default_jumlah"));
                        element_input_nilai.max = jumlah_default - bind.items[item].jumlah;
                        element_tersedia.setAttribute("default_jumlah", jumlah_default - bind.items[item].jumlah);
                        element_tersedia.innerHTML =
                            `Tersedia: ${Math.abs(jumlah_default - bind.items[item].jumlah)}`;
                    }

                    if (bind.items[item].kategori === "barang" && bind.items[item].jumlah > 0) {
                        const element_input_nilai = document.querySelector(
                            `.input_nilai_barang[nama_barang="${bind.items[item].nama_barang}"]`);
                        const element_tersedia = document.querySelector(
                            `.tersedia[nama_barang="${bind.items[item].nama_barang}"]`);
                        const jumlah_default = parseFloat(element_tersedia.getAttribute("default_jumlah"));
                        element_input_nilai.max = jumlah_default - bind.items[item].jumlah;
                        element_tersedia.setAttribute("default_jumlah", jumlah_default - bind.items[item].jumlah);
                        element_tersedia.innerHTML =
                            `Tersedia: ${Math.abs(jumlah_default - bind.items[item].jumlah)}`;
                    }
                }

                pembayaran.value = 0;

                bind.total = 0;
                bind.kembalian = 0;
                bind.pembayaran = 0;

                const keys = Object.keys(bind.items);
                for (let key of keys) {
                    bind.items[key].jumlah = 0;
                }

                document.querySelectorAll(".input_nilai").forEach(d => {
                    d.value = 0;
                });
            }
            //ini akhir dari ajax
        };
    </script>
@endsection
