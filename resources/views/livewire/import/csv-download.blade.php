<section>
    {{-- Settings Heading --}}
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Download Data Presensi') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Download data presensi disini:') }}
        </flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    {{-- Settings Content --}}
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        {{-- breadcrumbs --}}
        <flux:breadcrumbs>
            @if (auth()->user()->role === App\Enums\UserRole::Kepdesa)
                <flux:breadcrumbs.item :href="route('kepdesa.dashboard')">Dasbor</flux:breadcrumbs.item>
                <flux:breadcrumbs.item>Download Data Presensi</flux:breadcrumbs.item>
            @endif
            @if (auth()->user()->role === App\Enums\UserRole::Staffdesa)
                <flux:breadcrumbs.item :href="route('staffdesa.dashboard')">Dasbor</flux:breadcrumbs.item>
                <flux:breadcrumbs.item>Download Data Presensi
                </flux:breadcrumbs.item>
            @endif

        </flux:breadcrumbs>
        {{-- End breadcrumbs --}}

        {{-- Content --}}
        <div>

            <div class="overflow-x-auto my-5">



                <form class="max-w-sm mx-auto" id="formDownload">
                    <div class="mb-5">
                        <label for="date"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Awal</label>
                        <input type="date" id="tgl_awal" name="tgl_awal"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="name@flowbite.com" required />
                    </div>
                    <div class="mb-5">
                        <label for="date"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">tanggal Akhir</label>
                        <input type="date" id="tgl_akhir" name="tgl_akhir"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required />
                    </div>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </form>


            </div>
        </div>
</section>

<script>
    document.getElementById('formDownload').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = document.getElementById("formDownload");
        const formData = new FormData(form); // Ambil semua data dari form termasuk file

        // console.log("Data yang akan dikirim:", Object.fromEntries(formData.entries()));

        fetch('http://client_rfid.test/api/laporan/csv-download', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.blob())
            .then(blob => {
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = "laporan.csv"; // Ganti sesuai nama file
                document.body.appendChild(a);
                a.click();
                a.remove();
                window.URL.revokeObjectURL(url);

                alert("Data berhasil di-download!");
            })
            .catch(error => {
                console.error(error);
                alert("Gagal download data!");
            });
    });
</script>
