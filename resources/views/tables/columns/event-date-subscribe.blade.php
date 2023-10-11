
@php
    $eventSubscribe = \App\Models\EventSubscribe::find($getRecord()->event_subscribe_id);
@endphp


<div class="flex max-w-max">
    <div class="fi-ta-text-item inline-flex items-center gap-1.5 text-sm text-gray-950 dark:text-white  " style="">
        <div>
            {{ $eventSubscribe->name }}
        </div>
    </div>
</div>

