<div class="fixed inset-0 z-50 flex items-center justify-center bg-black backdrop-opacity-50">
    <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-full max-w-md shadow-lg">

        <h2 class="text-lg font-semibold mb-4">Edit Jenis Dokumen</h2>

        <!-- Input Name -->
        <flux:input label="Name" wire:model="name" />

        <!-- Input Submission Requirements -->
        <flux:input
            label="Submission Requirements"
            wire:model="submission_requirements"
            placeholder='["nama", "nik", "ttl"]'
            help="Format JSON Array"
        />
        <flux:error field="submission_requirements" />

        <!-- Tombol Simpan & Batal -->
        <div class="flex justify-end mt-4 space-x-2">
            <flux:button wire:click="closeModal" variant="filled" size="sm">Batal</flux:button>
            <flux:button wire:click="update" variant="primary" size="sm">Simpan Perubahan</flux:button>
        </div>

    </div>
</div>
