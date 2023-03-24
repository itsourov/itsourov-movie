<x-admin-layout>
    <div class="px-2 py-4">
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden  sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-none">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th scope="col"
                                        class="px-3 py-3 text-left text-xs font-medium  uppercase tracking-wider">
                                        No.</th>
                                    <th scope="col"
                                        class="px-3 py-3 text-left text-xs font-medium  uppercase tracking-wider">
                                        Amount</th>
                                    <th scope="col"
                                        class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                        currency</th>
                                    <th scope="col"
                                        class="px-3 py-3 text-left text-xs font-medium  uppercase tracking-wider">
                                        Customer number</th>
                                    <th scope="col"
                                        class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                        merchantInvoiceNumber</th>
                                    <th scope="col"
                                        class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                        paymentID</th>
                                    <th scope="col"
                                        class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                        trxID</th>
                                    <th scope="col"
                                        class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                        transactionStatus</th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach ($bkashTransactions as $bt)
                                    <tr
                                        class="{{ $loop->iteration % 2 == 0 ? 'bg-gray-50 dark:bg-gray-800' : 'bg-white dark:bg-gray-700' }}">


                                        <td class="px-3 py-3 whitespace-nowrap text-sm ">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-3 py-3 whitespace-nowrap text-sm ">
                                            {{ $bt->amount }}
                                        </td>
                                        <td class="px-3 py-3 whitespace-nowrap text-sm ">
                                            {{ $bt->currency }}
                                        </td>
                                        <td class="px-3 py-3 whitespace-nowrap text-sm ">
                                            {{ $bt->customerMsisdn }}
                                        </td>
                                        <td class="px-3 py-3 whitespace-nowrap text-sm ">
                                            {{ $bt->merchantInvoiceNumber }}
                                        </td>
                                        <td class="px-3 py-3 whitespace-nowrap text-sm ">
                                            {{ $bt->paymentID }}
                                        </td>
                                        <td class="px-3 py-3 whitespace-nowrap text-sm ">
                                            {{ $bt->trxID }}
                                        </td>
                                        <td class="px-3 py-3 whitespace-nowrap text-sm ">
                                            {{ $bt->transactionStatus }}
                                        </td>
                                        <td class="px-3 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                                            <a href="{{ route('admin.bt.show', $bt->id) }}" type="button"
                                                data-te-ripple-init data-te-ripple-color="light"
                                                class="inline-block rounded bg-primary-500 px-6 pt-2.5 pb-2 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)]">
                                                View
                                            </a>
                                        </td>
                                        {{-- <td class="px-3 py-3 whitespace-nowrap text-xs font-bold ">
                                            <p class="border dark:border-gray-500 rounded w-min p-1">
                                                {{ $link->quality }}</p>
                                        </td>
                                        <td class="px-3 py-3 whitespace-nowrap text-sm ">{{ $link->language }}
                                        </td>
                                        <td class="px-3 py-3 whitespace-nowrap text-sm ">
                                            {{ $link->click_count }}
                                        </td>
                                        <td class="px-3 py-3 whitespace-nowrap text-sm ">
                                            {{ $link->updated_at->diffForHumans() }}
                                        </td> --}}
                                        {{-- <td class="px-3 py-3 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="#"
                                                    class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                            </td> --}}
                                    </tr>
                                @endforeach


                                <!-- More people... -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>
