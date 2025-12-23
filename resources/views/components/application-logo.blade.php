<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" {{ $attributes }}>
    <defs>
        <linearGradient id="logo_gradient" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" style="stop-color:#9333ea;stop-opacity:1" /> <!-- Purple-600 -->
            <stop offset="100%" style="stop-color:#db2777;stop-opacity:1" /> <!-- Pink-600 -->
        </linearGradient>
    </defs>
    <!-- Bag Handle -->
    <path d="M16 11V7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7V11" stroke="url(#logo_gradient)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <!-- Bag Body with soft fill for color -->
    <path d="M5 9H19L20 21H4L5 9Z" stroke="url(#logo_gradient)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="url(#logo_gradient)" fill-opacity="0.15"/>
    <!-- Keyhole/Lock Accent -->
    <circle cx="12" cy="15" r="1.5" fill="url(#logo_gradient)"/>
</svg>