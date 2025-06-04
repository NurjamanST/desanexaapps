{{-- Modal Form Buat Rukun Warga --}}
<flux:modal name="add_laporan-penduduk" class="w-full">
    <form wire:submit="saveLapDuk" class="p-6">
        @csrf

        <div class="space-y-6">

            <div>
                <flux:heading size="lg">Form Laporan Penduduk</flux:heading>
                <flux:text class="mt-2">Laporan Penduduk.</flux:text>
            </div>

            <!-- Nama Laporan > String -->
            <div>
                <flux:input
                    wire:model.live="form.nama_laporan"
                    label="Name"
                    type="text"
                    autofocus
                    autocomplete="name"
                    placeholder="e.g. Jalan Rusak Daerah **** "
                />
                <flux:error field="form.name" />
            </div>

            <!-- Bukti Laporan > File Upload -->
            <div>
                <flux:input
                    wire:model.live="form.bukti_laporan"
                    label="Bukti Laporan"
                    type="file"
                    help="Upload File (.docx, .pdf, .png, .jpeg, .jpg)"
                />
                <flux:error field="form.bukti_laporan" />
            </div>

            <!-- Tombol Submit -->
            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" class="w-full">{{ __("Simpan Data") }}</flux:button>
            </div>

        </div>
    </form>
</flux:modal>
