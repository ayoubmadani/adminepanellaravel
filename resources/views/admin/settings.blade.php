@extends('admin.layout.main')
@section('content')
    <div class="page-transition" id="settings-page">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Store Settings</h1>
            <button class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                <i class="fas fa-save mr-2"></i> Save Changes
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <div class="lg:col-span-2">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 mb-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">General Settings</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Store Name</label>
                            <input
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                type="text" value="ShopAdmin Store">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Store Email</label>
                            <input
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                type="email" value="contact@shopadmin.com">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Store Phone</label>
                            <input
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                type="tel" value="+1 (555) 123-4567">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Store Address</label>
                            <textarea
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                rows="3">123 Business Street, Suite 100
New York, NY 10001
United States</textarea>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Payment Settings</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Currency</label>
                            <select
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option>US Dollar (USD)</option>
                                <option>Euro (EUR)</option>
                                <option>British Pound (GBP)</option>
                                <option>Japanese Yen (JPY)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Payment Methods</label>
                            <div class="space-y-2">
                                <div class="flex items-center">
                                    <input checked class="h-4 w-4 text-blue-500 focus:ring-blue-500 border-gray-300 rounded"
                                        id="credit-card" type="checkbox">
                                    <label class="ml-2 block text-sm text-gray-700" for="credit-card">Credit/Debit
                                        Card</label>
                                </div>
                                <div class="flex items-center">
                                    <input checked class="h-4 w-4 text-blue-500 focus:ring-blue-500 border-gray-300 rounded"
                                        id="paypal" type="checkbox">
                                    <label class="ml-2 block text-sm text-gray-700" for="paypal">PayPal</label>
                                </div>
                                <div class="flex items-center">
                                    <input class="h-4 w-4 text-blue-500 focus:ring-blue-500 border-gray-300 rounded"
                                        id="bank-transfer" type="checkbox">
                                    <label class="ml-2 block text-sm text-gray-700" for="bank-transfer">Bank
                                        Transfer</label>
                                </div>
                                <div class="flex items-center">
                                    <input class="h-4 w-4 text-blue-500 focus:ring-blue-500 border-gray-300 rounded"
                                        id="cash-on-delivery" type="checkbox">
                                    <label class="ml-2 block text-sm text-gray-700" for="cash-on-delivery">Cash on
                                        Delivery</label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Stripe API Key</label>
                            <input
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                type="password" value="sk_test_51J4jk2KZvKYlo2Ck">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">PayPal Client ID</label>
                            <input
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                type="password" value="AeA6Q3Dx4p4g4i4o4s4u4w4y4">
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 mb-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Store Logo</h2>
                    <div class="flex flex-col items-center">
                        <div class="w-32 h-32 rounded-full bg-gray-200 mb-4 flex items-center justify-center">
                            <i class="fas fa-store text-gray-400 text-3xl"></i>
                        </div>
                        <div class="text-center">
                            <label class="cursor-pointer" for="file-upload">
                                <span class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 inline-block">
                                    <i class="fas fa-upload mr-2"></i> Upload Logo
                                </span>
                                <input class="sr-only" id="file-upload" name="file-upload" type="file">
                            </label>
                            <p class="text-xs text-gray-500 mt-2">JPG, GIF or PNG. Max size of 1MB.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Store Maintenance</h2>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Maintenance Mode</label>
                                <p class="text-xs text-gray-500">Temporarily take your store offline</p>
                            </div>
                            <label class="inline-flex items-center cursor-pointer">
                                <input class="sr-only peer" type="checkbox" value="">
                                <div
                                    class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-500">
                                </div>
                            </label>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Maintenance Message</label>
                            <textarea
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="We'll be back soon!" rows="3">Our store is currently undergoing maintenance. We apologize for the inconvenience and will be back shortly.</textarea>
                        </div>
                        <div>
                            <button class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                                <i class="fas fa-trash mr-2"></i> Clear Cache
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
