<x-consumer-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Farm Owner Registration</h2>
            <form action="{{ route('consumer.register-farm-owner')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">

                    <div class="sm:col-span-2">
                        <h3 class="mb-4 text-lg font-medium text-gray-900 dark:text-white">Farm Information</h3>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="farm_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Farm Name</label>
                        <input type="text" name="farm_name" id="farm_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="farm_address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Farm Address</label>
                        <input type="text" name="farm_address" id="farm_address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                    </div>

                    <div>
                        <label for="farm_size" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Farm Size (hectares)</label>
                        <input type="text" name="farm_size" id="farm_size" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                    </div>

                    <div>
                        <label for="farm_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Farm Type</label>
                        <select name="farm_type" id="farm_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                            <option value="">Select farm type</option>
                            <option value="Crop Farm">Crop Farm</option>
                            <option value="Livestock Farm">Livestock Farm</option>
                            <option value="Mixed Farm">Mixed Farm</option>
                            <option value="Poultry Farm">Poultry Farm</option>
                            <option value="Fish Farm">Fish Farm</option>
                        </select>
                    </div>

                    <div>
                        <label for="contact_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact Number</label>
                        <input type="tel" name="contact_number" id="contact_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="farm_description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Farm Description</label>
                        <textarea id="farm_description" name="farm_description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"></textarea>
                    </div>


                    <div class="sm:col-span-2">
                        <h3 class="mb-4 text-lg font-medium text-gray-900 dark:text-white">Business Permit Information</h3>
                    </div>

                    <div>
                        <label for="business_permit_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Business Permit Number</label>
                        <input type="text" name="business_permit_number" id="business_permit_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                    </div>

                    <div>
                        <label for="business_permit_image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Business Permit Image</label>
                        <input type="file" name="business_permit_image" id="business_permit_image" accept="image/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" required>
                    </div>

                    <div class="sm:col-span-2">
                        <h3 class="mb-4 text-lg font-medium text-gray-900 dark:text-white">Valid ID Information</h3>
                    </div>

                    <div>
                        <label for="valid_id_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Valid ID Type</label>
                        <select name="valid_id_type" id="valid_id_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                            <option value="">Select ID type</option>
                            <option value="Passport">Passport</option>
                            <option value="Driver's License">Driver's License</option>
                            <option value="National ID">National ID</option>
                            <option value="SSS ID">SSS ID</option>
                            <option value="PhilHealth ID">PhilHealth ID</option>
                        </select>
                    </div>

                    <div>
                        <label for="valid_id_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Valid ID Number</label>
                        <input type="text" name="valid_id_number" id="valid_id_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="valid_id_image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Valid ID Image</label>
                        <input type="file" name="valid_id_image" id="valid_id_image" accept="image/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" required>
                    </div>
                </div>

                <div class="flex items-center space-x-4 mt-6">
                    <button type="submit" class="text-white bg-green-500 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Submit
                    </button>
                    <button type="button" onclick="window.history.back()" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
      </section>
</x-consumer-layout>
