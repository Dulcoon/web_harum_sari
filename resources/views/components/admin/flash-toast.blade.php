@props([
    'type' => 'success',
    'message' => '',
    'timeout' => 4200,
])

@php
    $styles = match ($type) {
        'error' => [
            'icon' => 'error',
            'iconClass' => 'bg-red-500/15 text-red-500 border border-red-500/25',
            'barClass' => 'from-red-500 to-red-400',
        ],
        'warning' => [
            'icon' => 'warning',
            'iconClass' => 'bg-amber-500/15 text-amber-500 border border-amber-500/25',
            'barClass' => 'from-amber-500 to-amber-400',
        ],
        'info' => [
            'icon' => 'info',
            'iconClass' => 'bg-sky-500/15 text-sky-500 border border-sky-500/25',
            'barClass' => 'from-sky-500 to-sky-400',
        ],
        default => [
            'icon' => 'check_circle',
            'iconClass' => 'bg-emerald-500/15 text-emerald-500 border border-emerald-500/25',
            'barClass' => 'from-primary to-primary-deep',
        ],
    };
@endphp

<div
    class="admin-flash-toast pointer-events-auto relative overflow-hidden rounded-2xl border border-[#eadfd4] bg-white/80 p-4 pr-10 shadow-xl backdrop-blur-xl dark:border-white/10 dark:bg-[#0f1116]/85"
    data-timeout="{{ (int) $timeout }}"
>
    <div class="flex items-start gap-3">
        <span class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-xl {{ $styles['iconClass'] }}">
            <span class="material-symbols-outlined text-[18px]">{{ $styles['icon'] }}</span>
        </span>

        <div class="min-w-0">
            <p class="text-xs font-bold uppercase tracking-[0.18em] text-[#8b7266] dark:text-[#9a6c4c]">Notification</p>
            <p class="mt-1 text-sm font-medium text-[#1b1c1b] dark:text-white">{{ $message }}</p>
        </div>
    </div>

    <button
        type="button"
        class="admin-flash-close absolute right-2 top-2 inline-flex h-7 w-7 items-center justify-center rounded-full text-[#8b7266] transition-colors hover:bg-black/5 hover:text-[#1b1c1b] dark:text-white/60 dark:hover:bg-white/10 dark:hover:text-white"
        aria-label="Dismiss notification"
    >
        <span class="material-symbols-outlined text-[16px]">close</span>
    </button>

    <div class="absolute inset-x-0 bottom-0 h-0.5 bg-black/5 dark:bg-white/10">
        <div class="admin-flash-progress h-full w-full origin-left bg-gradient-to-r {{ $styles['barClass'] }}"></div>
    </div>
</div>

@once
    <script>
        (function () {
            const toasts = document.querySelectorAll('.admin-flash-toast');
            if (!toasts.length) return;

            const dismiss = (toast) => {
                toast.classList.add('opacity-0', 'translate-y-2');
                setTimeout(() => toast.remove(), 220);
            };

            toasts.forEach((toast) => {
                toast.classList.add('transition-all', 'duration-200');

                const progress = toast.querySelector('.admin-flash-progress');
                const closeBtn = toast.querySelector('.admin-flash-close');
                const timeout = Number(toast.getAttribute('data-timeout')) || 4200;

                if (progress) {
                    progress.style.transition = `transform ${timeout}ms linear`;
                    requestAnimationFrame(() => {
                        progress.style.transform = 'scaleX(0)';
                    });
                }

                const timer = setTimeout(() => dismiss(toast), timeout);

                if (closeBtn) {
                    closeBtn.addEventListener('click', () => {
                        clearTimeout(timer);
                        dismiss(toast);
                    });
                }
            });
        })();
    </script>
@endonce
