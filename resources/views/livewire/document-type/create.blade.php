{{-- Modal Form Buat Jenis Dokumen --}}
<flux:modal name="add_document_type" class="w-full">
    <form wire:submit="saveDoctype" class="p-6">
        @csrf

        <div class="space-y-6">

            <div>
                <flux:heading size="lg">Form Buat Jenis Dokumen</flux:heading>
                <flux:text class="mt-2">Tambahkan Berbagai Jenis Dokumen.</flux:text>
            </div>

            <!-- Name > String -->
            <div>
                <flux:input
                    wire:model.live="form.name"
                    label="Name"
                    type="text"
                    autofocus
                    autocomplete="name"
                    placeholder="e.g. Surat Domisili"
                />
                <flux:error field="form.name" />
            </div>

            <!-- Template Layout > File Upload -->
            <div>
                <flux:input
                    wire:model.live="form.template_layout"
                    label="File Template Document"
                    type="file"
                    help="Upload template (.docx, .pdf)"
                />
                <flux:error field="form.template_layout" />
            </div>

            <!-- Submission Requirements > json -->
            <div>
                <flux:input
                    wire:model.live="form.submission_requirements"
                    label="Submission Requirements"
                    type="text"
                    placeholder="e.g. [&#34;KTP&#34;, &#34;KK&#34;, &#34;...&#34;]"
                    help="Format JSON Array"
                />
                <flux:text class="text-xs text-gray-500 mt-1">
                    Contoh format JSON: ["KTP", "KK", "Surat Nikah"]
                </flux:text>
                <flux:error field="form.submission_requirements" />
            </div>

            <!-- Tombol Submit -->
            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" class="w-full">{{ __("Simpan Data") }}</flux:button>
            </div>

        </div>
    </form>
</flux:modal>
