@php
$user = auth()->user()
@endphp

<div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ $user->image  }}" alt="">
        </div>
    </div>
</div>