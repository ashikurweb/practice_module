@props(['minutes' => 2])

@once
<script>
    {!! App\Services\IdleTimerService::generateScript($minutes) !!}
</script>
@endonce