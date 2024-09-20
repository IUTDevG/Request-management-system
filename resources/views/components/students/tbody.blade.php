@props(['requests','showCancelModal'])
<tbody class="divide-y divide-gray-200 whitespace-nowrap dark:divide-white/5">

@foreach($requests as $request)
    <tr
        class="[@media(hover:hover)]:transition [@media(hover:hover)]:duration-75 hover:bg-gray-50 dark:hover:bg-white/5"
        wire:key="{{ $request->request_code }}">


        <td class="p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3"
        >
            <div class="">
                <a
                    href="{{ route('student.request.details',$request->request_code) }}"
                    class="flex w-full disabled:pointer-events-none justify-start text-start">
                    <div class="grid w-full gap-y-1 px-3 py-4">

                        <div class="flex ">

                            <div class="flex max-w-max">

                                <div
                                    class="inline-flex items-center gap-1.5 ">

                                                                <span
                                                                    class="text-sm leading-6 text-gray-950 dark:text-white  "
                                                                    style="">{!! $request->title !!}</span>

                                </div>

                            </div>

                        </div>

                    </div>

                </a>

            </div>
        </td>

        <td class="p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3"
        >
            <a href="{{ route('student.request.details',$request->request_code) }}"
               class="flex w-full disabled:pointer-events-none justify-start text-start">
                <div class="grid w-full gap-y-1 px-3 py-4">

                    <div class="flex gap-1.5 flex-wrap ">
                        <x-students.status request="{{$request->status}}"/>
                    </div>
                </div>

            </a>
        </td>

        <td class="p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3"
        >
            <div class="">
                <a
                    href="{{ route('student.request.details',$request->request_code) }}"
                    class="flex w-full disabled:pointer-events-none justify-start text-start">
                    <div class="grid w-full gap-y-1 px-3 py-4">

                        <div class="flex ">

                            <div class="flex max-w-max">

                                <div
                                    class="inline-flex items-center gap-1.5 ">

                                                                    <span
                                                                        class="text-sm leading-6 text-gray-950 dark:text-white  "
                                                                        style="">
                                                                    {!! $request->created_at !!}
                                                                    </span>


                                </div>

                            </div>

                        </div>

                    </div>

                </a>

            </div>
        </td>
        <td class="p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3"
        >
            <div class="">
                <a
                    href="{{ route('student.request.details',$request->request_code) }}"
                    class="flex w-full disabled:pointer-events-none justify-start text-start">
                    <div class="grid w-full gap-y-1 px-3 py-4">

                        <div class="flex ">

                            <div class="flex max-w-max">

                                <div
                                    class="inline-flex items-center gap-1.5 ">

                                                                    <span
                                                                        class="text-sm leading-6 text-gray-950 dark:text-white  "
                                                                        style="">
                                                                    {!! $request->updated_at !!}
                                                                    </span>


                                </div>

                            </div>

                        </div>

                    </div>

                </a>

            </div>
        </td>

        <td class="p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3">
            <div class="whitespace-nowrap px-3 py-4">
                <div class="flex shrink-0 items-center gap-3 justify-end">

                    <x-students.actions open-cancel-modal="openCancelModal('{{$request->request_code}}')"
                                        title="{{$request->title}}" show-cancel-modal="{{$showCancelModal}}"
                                        status="{{$request->status}}" request_code="{{$request->request_code}}"/>
                </div>
            </div>
        </td>

    </tr>
@endforeach
</tbody>
