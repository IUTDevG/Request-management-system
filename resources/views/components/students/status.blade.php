@use('App\Enums\SchoolRequestStatus')
@props([
    'request' => null,
    'canEdit' => false,
    'canDelete' => false,
    'canViewSchoolDetails' => false,
    'canViewStudentDetails' => false,
    'canViewTeacherDetails' => false,
])
<div class="flex w-max">
    <div
        @php
            $status = SchoolRequestStatus::from($request);
            $styleVariables = match($request) {
        SchoolRequestStatus::Submitted->value => [
            '--c-400' => 'var(--info-400)',
            '--c-500' => 'var(--info-500)',
            '--c-600' => 'var(--info-600)',
            '--c-50'  => 'var(--info-50)',
        ],
        SchoolRequestStatus::Completed->value => [
            '--c-400' => 'var(--success-400)',
            '--c-500' => 'var(--success-500)',
            '--c-600' => 'var(--success-600)',
            '--c-50'  => 'var(--success-50)',
        ],
         SchoolRequestStatus::Draft->value => [
            '--c-400' => 'var(--warning-400)',
            '--c-500' => 'var(--warning-500)',
            '--c-600' => 'var(--warning-600)',
            '--c-50'  => 'var(--warning-50)',
        ],
        SchoolRequestStatus::Cancelled->value,SchoolRequestStatus::Rejected->value => [
             '--c-400' => 'var(--danger-400)',
            '--c-500' => 'var(--danger-500)',
            '--c-600' => 'var(--danger-600)',
            '--c-50'  => 'var(--danger-50)',
        ],
        default => [],
    };

    $style = collect($styleVariables)->map(fn($value, $key) => "$key:$value")->implode(';');
        @endphp

        style="{{ $style }}"
        class="flex items-center justify-center gap-x-1 rounded-md text-xs font-medium ring-1 ring-inset px-2 min-w-[theme(spacing.6)] py-1 bg-success-50 text-custom-500 ring-custom-600/10 dark:bg-custom-400/10 dark:text-custom-400 dark:ring-custom-400/30">


                                                                <span class="grid">
                                                                    <span class="truncate capitalize">
                                                                        {!! $status->label() !!}
                                                                    </span>
                                                                </span>

    </div>
</div>
