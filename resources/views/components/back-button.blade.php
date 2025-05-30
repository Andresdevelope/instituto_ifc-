@props(['backUrl' => null])

@if($backUrl)
    <a href="{{ $backUrl }}" class="btn-back" style="background-color:#1e3a8a; color:white; padding:8px 16px; border:none; border-radius:5px; cursor:pointer; font-weight:bold; text-decoration:none; display:inline-block;">
        ← Volver
    </a>
@else
    <button onclick="window.history.back()" class="btn-back" style="background-color:#1e3a8a; color:white; padding:8px 16px; border:none; border-radius:5px; cursor:pointer; font-weight:bold;">
        ← Volver
    </button>
@endif
