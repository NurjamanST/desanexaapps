<section>
    {{-- Settings Heading --}}
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Tambah Data Staff') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Tambahkan data staff kedalam kartu disini:') }}
        </flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    {{-- Settings Content --}}
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        {{-- breadcrumbs --}}
        <flux:breadcrumbs>
            @if (auth()->user()->role === App\Enums\UserRole::Kepdesa)
                <flux:breadcrumbs.item :href="route('kepdesa.dashboard')">Dasbor</flux:breadcrumbs.item>
                <flux:breadcrumbs.item>Tambah Data Staff</flux:breadcrumbs.item>
            @endif
            @if (auth()->user()->role === App\Enums\UserRole::Staffdesa)
                <flux:breadcrumbs.item :href="route('staffdesa.dashboard')">Dasbor</flux:breadcrumbs.item>
                <flux:breadcrumbs.item>Tambah Data Staff
                </flux:breadcrumbs.item>
            @endif

        </flux:breadcrumbs>
        {{-- End breadcrumbs --}}

        {{-- Content --}}
        <div>

            <div class="overflow-x-auto my-5">

                <form enctype="multipart/form-data">
                    <div class="flex justify-center mb-6 ">
                        <figure
                            class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 p-1 text-center">
                            <img class="h-auto max-w-24 rounded-sm mx-auto p-1" src="{{ $foto_url }}"
                                alt="image description">
                            {{-- <figcaption class="mt-2 text-sm text-gray-500 dark:text-gray-400">Image caption</figcaption> --}}
                        </figure>
                    </div>
                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label for="first_name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">UID</label>
                            <input type="text" id=""
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="John" value="{{ $data1->uid }}" disabled />

                            <input type="hidden" id="uid" name="uid"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="John" value="{{ $data1->uid }}" required />
                        </div>
                        <div>
                            <label for="company"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No
                                Identitas</label>
                            <input type="text" id="no_identitas" name="no_identitas"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="3101234567890123" value="{{ $data1->no_identitas }}" required disabled />
                        </div>
                        <div>
                            <label for="last_name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                Lengkap</label>
                            <input type="text" id="nama" name="nama"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Rahina Iraina" value="{{ $data1->nama }}" required disabled />
                        </div>

                        <div>
                            <label for="tampat_lahir"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tampat
                                Lahir</label>
                            <input type="tel" id="tempat" name="tempat"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Bandung" value="{{ $data1->tempat }}" required disabled />
                        </div>
                        <div>
                            <label for="website"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                                Lahir</label>
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="" value="{{ $data1->tanggal_lahir }}" required disabled />
                        </div>

                        <div>
                            <label for="visitors"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis
                                Kelamin</label>
                            <select id="jenis_kelamin" name="jenis_kelamin" disabled
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @if ($data1->jenis_kelamin === 'laki-laki')
                                    <option value="laki-laki" selected>Laki-laki</option>
                                    <option value="perempuan">Perempuan</option>
                                @elseif ($data1->jenis_kelamin === 'perempuan')
                                    <option value="perempuan" selected>Perempuan</option>
                                    <option value="laki-laki">Laki-laki</option>
                                @endif
                            </select>
                        </div>
                        <div>
                            <label for="website"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No
                                Handphone</label>
                            <input type="number" id="phone" name="phone"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="08123456789" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}"
                                value="{{ $data1->phone }}" required disabled   />
                        </div>
                        <div>
                            <label for="website"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jabatan</label>
                            <input type="text" id="kelas_posisi" name="kelas_posisi"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Staff" value="{{ $data1->kelas_posisi }}" required disabled />
                        </div>
                        <div>
                            <label for="website"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Instansi</label>
                            <input type="text" id="instansi" name="instansi"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="" value="{{ $data1->instansi }}" required disabled />
                        </div>
                        <div>
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                            <textarea id="alamat" cols="10" rows="2" name="alamat"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Jl. Citeureup No.06 Cijantung Bandung" disabled>{{ $data1->alamat }}</textarea>
                        </div>
                    </div>

                    <button type="button"
                        onclick="event.preventDefault(); window.location.href='{{ route('staffdesa.sdm.read') }}'"
                        class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Kembali</button>
                </form>

            </div>
        </div>
</section>

{{-- <script>
    document.getElementById("createForm").addEventListener("submit", function(e) {
        e.preventDefault();

        const form = document.getElementById("createForm");
        const formData = new FormData(form); // Ambil semua data dari form termasuk file

        const id = "{{ $data1->id }}"; // Ambil ID dari data yang sedang diupdate

        fetch(`http://client_rfid.test/api/sdm/${id}/update`, {
                method: "POST",
                body: formData,
                headers: {
                    // Jangan set Content-Type! Biarkan browser yg handle boundary multipart
                }
            })
            .then(response => {
                if (!response.ok) throw new Error("Gagal menyimpan data");
                return response.json();
            })
            .then(data => {
                alert("Data berhasil disimpan!");
                window.location.href = "{{ route('staffdesa.sdm.read') }}";
            })
            .catch(error => {
                console.error("Error kirim data:", error);
                alert("Terjadi kesalahan saat menyimpan data.");
            });
    });
</script> --}}
