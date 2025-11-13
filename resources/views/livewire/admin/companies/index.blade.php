<div>
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">
            Companies
        </flux:heading>
        <flux:subheading size="lg" class="mb-6">
            List of all companies
        </flux:subheading>
        <flux:separator />
    </div>

    <div class="flex flex-col">
        <div class="overflow">
            <div class="inline-block min-w-full py-2 align-middle">
                <div class="overflow-hidden shadow-sm ring-1 ring-black ring-opacity-5">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-gray-900">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-gray-900">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-gray-900">
                                    Created At
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach ($companies as $company)
                                <tr>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                                        {{ $company->name }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                                        {{ $company->email }}
                                    </td>
        </div>
    </div>
</div>
