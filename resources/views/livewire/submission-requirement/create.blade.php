{{-- Modal Form Buat Rukun Warga --}}
<flux:modal name="add_submission-requirement" class="w-full">
    <form wire:submit="saveSubReq" class="p-6">
        @csrf

        <div class="space-y-6">

            <div>
                <flux:heading size="lg">Form Upload Berkas Persyaratan</flux:heading>
                <flux:text class="mt-2">Upload Berkas Persyaratan.</flux:text>
            </div>

            <!-- Nama Persyaratan > String -->
            <div>
                <flux:input
                    wire:model.live="form.name"
                    label="Name"
                    type="text"
                    autofocus
                    autocomplete="name"
                    placeholder="e.g. KTP"
                />
                <flux:error field="form.name" />
            </div>

            <!-- File Persyaratan > File Upload -->
            <div>
                <flux:input
                    wire:model.live="form.file_persyaratan"
                    label="File Persyaratan"
                    type="file"
                    help="Upload File (.docx, .pdf, .png, .jpeg, .jpg)"
                />
                <flux:error field="form.file_persyaratan" />
            </div>

            <!-- Tombol Submit -->
            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" class="w-full">{{ __("Simpan Data") }}</flux:button>
            </div>

        </div>
    </form>
</flux:modal>
