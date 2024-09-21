<div>
    <section>
        <!--Banner -->
        <div class="max-w-[85rem] px-4 py-4 sm:px-6 lg:px-8 mx-auto">
            <!-- Grid -->
            <div class="flex justify-center max-[835px]:flex-col text-foreground">
                <div class="flex items-center w-full min-[835px]:w-full">
                    <div class="grow flex items-center gap-x-2">
                        <a class="hover:scale-110 transition-transform duration-300 ease-in-out shadow-2xl shadow-neutral-400/5 hover:shadow-neutral-500/10 dark:shadow-neutral-400/5 dark:hover:shadow-neutral-500/10 rounded-lg"
                           href="{{route
                        ('student.home')}}">
                            <x-heroicon-o-chevron-left class="w-6 h-6 text-gray-800 dark:text-neutral-200"/>
                        </a>
                        <p class="text-2xl text-gray-800 font-semibold dark:text-neutral-200">
                            {!! __('History')!!} ({{$request->title}})
                        </p>
                    </div>
                </div>
            </div>
            <!-- End Grid -->
        </div>
        <!-- End Banner -->
        <!--====== START BODY =======-->
        <!-- Announcement Banner -->
        <div class="max-w-[85rem] px-4 py-4 sm:px-6 lg:px-8 mx-auto">

            <!-- End Announcement Banner -->
            <!-- Table Section -->
            <div class=" px-4 py-10 sm:px-6 lg:px-8 lg:py-14 w-full">
                <!-- Card -->
                <div class="flex flex-col">
                    <div class="-m-1.5 overflow-x-auto">
                        <div class="p-1.5 min-w-full inline-block align-middle">
                            <div
                                class="divide-y divide-gray-200 overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:divide-white/10 dark:bg-gray-900 dark:ring-white/10">

                                <div class="overflow-x-auto bg-white dark:bg-gray-900">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead>
                                        <tr>
                                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                {!! __('Date') !!}
                                            </th>
                                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                {!! __('Event') !!}
                                            </th>
                                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                {!! __('Status') !!}
                                            </th>
                                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                {!! __('Assigned by') !!}
                                            </th>
                                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                {!! __('Assigned to') !!}
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody
                                            class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @php
                                            function getStatusColor($status){
                                                if($status){
                                               $color = \App\Enums\SchoolRequestStatus::tryFrom($status)->color();
                                                }else{
                                                    $color = 'warning';
                                                }
                                               return $color;
                                            }
                                        @endphp
                                        @foreach($activities as $activity)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900 dark:text-gray-100">
                                                    {{ $activity->created_at->format('d-m-Y H:i') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                                                    <x-filament::badge color="info">{{ __($activity->event)
                                                    }}</x-filament::badge>
                                                </td>
                                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900 dark:text-gray-100">
                                                    @php
                                                        $stat = $activity->properties['status'] ?? '';
                                                        if($stat){
                                                            $status = \App\Enums\SchoolRequestStatus::tryFrom($activity->properties['status'])->label();
                                                            }else{
                                                                $status = null;
                                                            }
                                                    @endphp
                                                    <x-filament::badge
                                                        color="{{getStatusColor($stat)
                                                            }}">{{$status}}</x-filament::badge>
                                                </td>
                                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900 dark:text-gray-100">
                                                    {{ $activity->properties['old_assignee'] ?? 'N/A'}}
                                                </td>
                                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900 dark:text-gray-100">
                                                    {{ $activity->properties['new_assignee'] ?? 'N/A'}}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Card -->
            </div>
        </div>
    </section>

</div>
