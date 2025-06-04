<x-layouts.app :title="__('Admin Apps Dashboard')">
    {{-- Settings Heading --}}
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Tidak Terpakai') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Manage the document type data from here:') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>
    {{-- Settings Content --}}
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        {{-- breadcrumbs --}}
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('adminapps.dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('adminapps.document_type.read')">Document Type</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        {{-- End breadcrumbs --}}

        {{-- Contents --}}
        <livewire:document_type.read/>

    </div>
</x-layouts.app>
