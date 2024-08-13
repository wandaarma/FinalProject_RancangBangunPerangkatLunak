<button {{ $attributes->merge(['class' => 'btn btn-block', 'style' => 'display: inline-block; font-size: 16px; border-radius: 10px; cursor: pointer; background-color: #A6B59A; color: #FFF;', 'onmouseover' => 'this.style.backgroundColor=\'#54634A\';', 'onmouseout' => 'this.style.backgroundColor=\'#A6B59A\';']) }}>
    {{ $slot }}
</button>
