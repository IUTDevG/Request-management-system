<div>
    <!-- Toast -->
    <div class="animate-pulse">
        <!-- Status Toast -->
        <div class="hidden" id="statusToast">
            <div class="flex items-center p-4 mb-4 text-green-600 bg-green-200 rounded-lg dark:bg-green-800 dark:text-green-200" role="alert">
                <div class="text-sm font-medium">
                    Status message
                </div>
            </div>
        </div>
        <!-- Error Toast -->
        <div class="hidden" id="errorToast">
            <div class="flex items-center p-4 mb-4 text-red-600 bg-red-200 rounded-lg dark:bg-red-800 dark:text-red-200" role="alert">
                <div class="text-sm font-medium">
                    Error message
                </div>
            </div>
        </div>
    </div>
    <!-- End Toast -->

    <!-- Start Body -->
    <section>
        <!-- Banner -->
        <div class="animate-pulse max-w-[85rem] px-4 py-4 sm:px-6 lg:px-8 mx-auto">
            <div class="flex justify-center max-[835px]:flex-col">
                <div class="flex items-center w-full min-[835px]:w-full">
                    <div class="grow">
                        <div class="h-8 bg-gray-300 rounded-md dark:bg-gray-700 w-1/2 mb-2"></div>
                        <div class="h-4 bg-gray-300 rounded-md dark:bg-gray-700 w-1/3 mb-2"></div>
                    </div>
                </div>
                <!-- Button -->
                <div class="text-center sm:text-start flex sm:justify-start sm:items-center gap-x-3 md:gap-x-4">
                    <div class="h-10 bg-gray-300 rounded-md dark:bg-gray-700 w-32"></div>
                </div>
            </div>
        </div>
        <!-- End Banner -->

        <!-- Announcement Banner -->
        <div class="animate-pulse max-w-[85rem] px-4 py-4 sm:px-6 lg:px-8 mx-auto min-[835px]:flex min-[835px]:justify-end">
            <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0 sm:space-x-4">
                <!-- Search Input -->
                <div class="w-full sm:w-auto">
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <div class="h-6 w-6 bg-gray-300 rounded-full dark:bg-gray-700"></div>
                        </div>
                        <div class="h-10 bg-gray-300 rounded-md dark:bg-gray-700 w-full pl-10"></div>
                    </div>
                </div>

                <!-- Filter Dropdown -->
                <div class="relative inline-block text-left w-full sm:w-auto">
                    <div class="h-10 bg-gray-300 rounded-md dark:bg-gray-700 w-40"></div>
                </div>
            </div>
        </div>
        <!-- End Announcement Banner -->

        <!-- Table Section -->
        <div class="animate-pulse max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
            <!-- Card -->
            <div class="flex flex-col">
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div class="divide-y divide-gray-200 overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:divide-white/10 dark:bg-gray-900 dark:ring-white/10">
                            <!-- Header -->
                            <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-neutral-700">
                                <div>
                                    <div class="h-6 bg-gray-300 rounded-md dark:bg-gray-700 w-1/4 mb-2"></div>
                                    <div class="h-4 bg-gray-300 rounded-md dark:bg-gray-700 w-1/3"></div>
                                </div>
                            </div>

                            <!-- Table Body -->
                            <div class="p-6">
                                <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
                                    <!-- Repeat this block for each row in the skeleton table -->
                                    <div class="h-6 bg-gray-300 rounded-md dark:bg-gray-700 mb-2"></div>
                                    <div class="h-6 bg-gray-300 rounded-md dark:bg-gray-700 mb-2"></div>
                                    <div class="h-6 bg-gray-300 rounded-md dark:bg-gray-700 mb-2"></div>
                                    <div class="h-6 bg-gray-300 rounded-md dark:bg-gray-700 mb-2"></div>
                                </div>
                            </div>

                            <!-- Footer -->
                            <div class="px-6 py-4 gap-3 flex justify-between items-center border-t border-gray-200 dark:border-neutral-700">
                                <div class="h-6 bg-gray-300 rounded-md dark:bg-gray-700 w-1/4"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Card -->
        </div>
    </section>
    <!-- End Body -->
</div>
