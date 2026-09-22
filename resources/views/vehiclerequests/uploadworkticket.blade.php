<x-app-layout>
    <x-slot name="header">Upload Work Ticket</x-slot>

    <form method="POST" action="{{ route('vehiclerequests.uploadWorkTicket', $vehicleRequest) }}" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <x-input-label for="work_ticket" value="Work Ticket" />
            <input id="work_ticket" type="file" name="work_ticket" class="block w-full mt-1">
        </div>

        <x-primary-button>Upload</x-primary-button>
    </form>
</x-app-layout>