<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'SaferWealth Analyst' }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|quicksand:400,500,600,700&display=swap"
        rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        :root {
            --background: 40 25% 98%;
            --foreground: 175 35% 25%;
            --card: 0 0% 100%;
            --card-foreground: 175 35% 25%;
            --popover: 0 0% 100%;
            --popover-foreground: 175 35% 25%;
            --primary: 175 45% 32%;
            --primary-foreground: 0 0% 100%;
            --secondary: 170 35% 75%;
            --secondary-foreground: 175 45% 22%;
            --muted: 170 15% 94%;
            --muted-foreground: 175 20% 45%;
            --accent: 175 50% 40%;
            --accent-foreground: 0 0% 100%;
            --destructive: 0 84% 60%;
            --destructive-foreground: 0 0% 100%;
            --border: 170 20% 88%;
            --input: 170 20% 88%;
            --ring: 175 45% 32%;
            --radius: .5rem;
            --hero-gradient: linear-gradient(135deg, hsl(170 40% 75%) 0%, hsl(175 45% 85%) 100%);
            --card-shadow: 0 4px 24px -4px hsl(175 30% 25% / .08);
            --card-shadow-hover: 0 12px 40px -8px hsl(175 30% 25% / .15);
            --glow-teal: 0 0 40px -10px hsl(175 45% 40% / .35);
            --font-display: "Cormorant Garamond", Georgia, serif;
            --font-body: "Inter", system-ui, sans-serif;
            --sidebar-background: 0 0% 98%;
            --sidebar-foreground: 240 5.3% 26.1%;
            --sidebar-primary: 240 5.9% 10%;
            --sidebar-primary-foreground: 0 0% 98%;
            --sidebar-accent: 240 4.8% 95.9%;
            --sidebar-accent-foreground: 240 5.9% 10%;
            --sidebar-border: 220 13% 91%;
            --sidebar-ring: 175 45% 32%;
        }

        body {
            font-family: var(--font-body, 'Inter', sans-serif);
            background: hsl(var(--background));
            color: hsl(var(--foreground));
        }

        .hero-gradient {
            background: var(--hero-gradient);
        }

        .text-foreground {
            color: hsl(var(--foreground));
        }

        .text-gradient {
            -webkit-text-fill-color: transparent;
            background: linear-gradient(135deg, rgb(49, 129, 123), rgb(57, 172, 153)) text;
        }

        .text-foreground\/90 {
            color: hsl(var(--foreground) / 0.9);
        }

        .bg-primary\/10 {
            background-color: hsl(var(--primary) / 0.1);
        }

        .text-foreground\/80 {
            color: hsl(var(--foreground) / 0.8);
        }

        .bg-primary {
            background-color: hsl(var(--primary));
        }

        .text-muted-foreground {
            color: #5c8a86;
        }

        .bg-secondary\/20 {
            background-color: hsl(var(--secondary) / 0.2);
        }

        .text-gradient {
            background: linear-gradient(135deg, #31817b, #39ac99);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .from-primary {
            --tw-gradient-from: hsl(var(--primary)) var(--tw-gradient-from-position);
            --tw-gradient-to: hsl(var(--primary) / 0) var(--tw-gradient-to-position);
            --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
        }

        .container {
            padding: 0 20px;
        }

        @media (max-width: 767px) {
            .container {
                padding: 0 10px;
            }
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var header = document.querySelector('.sticky-header');
            if (header) {
                function onScroll() {
                    if (window.scrollY > 0) {
                        header.classList.add('scrolled');
                    } else {
                        header.classList.remove('scrolled');
                    }
                }
                window.addEventListener('scroll', onScroll);
                onScroll();
            }
        });
    </script>
</head>

<body class="bg-gradient-to-br from-blue-50 via-white to-indigo-50 bk-body relative min-h-screen">
    <!-- Header Section -->
    <header class="bg-[#EBEBE4] border-b border-[#006767] fixed top-0 left-0 right-0 z-50 transition-all duration-300"
        x-data="{ isMobileMenuOpen: false }">
        <div class="container mx-auto px-6">
            <div class="flex items-center justify-between h-16 lg:h-20">
                <!-- Logo -->
                <a href="/" class="flex items-center gap-2">
                    <x-application-logo class="w-8 h-8 text-[#006767]" />
                    <div class="text-[18px] font-normal text-[#006767] tracking-[0.1em] transition-colors"
                        style="font-family: 'quicksand', sans-serif;">
                        SaferWealth
                    </div>
                </a>

                <!-- Desktop Nav -->
                <nav class="hidden md:flex items-center gap-8 text-[#006767]">
                    <a href="{{ url('/') }}#how-it-works"
                        class="text-sm font-medium transition-colors hover:opacity-80">How It
                        Works</a>
                    <a href="{{ url('/') }}#benefits"
                        class="text-sm font-medium transition-colors hover:opacity-80">Benefits</a>
                    <a href="{{ url('/') }}#faq" class="text-sm font-medium transition-colors hover:opacity-80">FAQ</a>
                    <a href="{{ url('/') }}#about"
                        class="text-sm font-medium transition-colors hover:opacity-80">About</a>
                </nav>

                <!-- CTA Desktop -->
                <div class="hidden md:flex items-center gap-3">
                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="px-6 py-2.5 bg-primary text-white rounded-lg font-medium hover:opacity-90 transition-all duration-200">Check
                            Eligibility</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-6 py-2.5 bg-primary text-white rounded-lg font-medium hover:opacity-90 transition-all duration-200">Check
                            Eligibility</a>
                    @endauth
                </div>

                <!-- Mobile Menu Toggle -->
                <button class="md:hidden p-2" @click="isMobileMenuOpen = !isMobileMenuOpen"
                    aria-label="Toggle mobile menu">
                    <span x-show="!isMobileMenuOpen">
                        <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </span>
                    <span x-show="isMobileMenuOpen">
                        <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </span>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="isMobileMenuOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 h-0" x-transition:enter-end="opacity-100 h-auto"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 h-auto"
            x-transition:leave-end="opacity-0 h-0"
            class="md:hidden bg-[#EBEBE4] border-b border-[#006767] overflow-hidden text-[#006767]">
            <nav class="container mx-auto py-6 flex flex-col gap-4">
                <a href="{{ url('/') }}#how-it-works" class="font-medium py-2" @click="isMobileMenuOpen = false">How It
                    Works</a>
                <a href="{{ url('/') }}#benefits" class="font-medium py-2"
                    @click="isMobileMenuOpen = false">Benefits</a>
                <a href="{{ url('/') }}#faq" class="font-medium py-2" @click="isMobileMenuOpen = false">FAQ</a>
                <a href="{{ url('/') }}#about" class="font-medium py-2" @click="isMobileMenuOpen = false">About</a>
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="mt-2 px-6 py-3 bg-primary text-white rounded-lg font-semibold text-center"
                        @click="isMobileMenuOpen = false">Check Eligibility</a>
                @else
                    <a href="{{ route('login') }}"
                        class="mt-2 px-6 py-3 bg-primary text-white rounded-lg font-semibold text-center"
                        @click="isMobileMenuOpen = false">Check Eligibility</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="min-h-screen">
        {{ $slot }}
    </main>

    <!-- Footer Section -->
    <footer class="bg-[#4a817b] text-white py-12 lg:py-16">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 lg:gap-12">
                <!-- Brand & Legal -->
                <div class="flex flex-col gap-4">
                    <div class="font-display text-xl font-bold">SaferWealth™</div>
                    <p class="text-white/70 text-sm">© {{ date('Y') }} by SaferWealth</p>
                </div>

                <!-- Social & Contact -->
                <div class="flex flex-col gap-4">
                    <div class="flex items-center gap-4">
                        <a href="#" class="hover:text-white/80 transition-colors" aria-label="Facebook">
                            <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                        <a href="#" class="hover:text-white/80 transition-colors" aria-label="Instagram">
                            <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.344 3.608 1.319.975.975 1.257 2.242 1.319 3.608.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.062 1.366-.344 2.633-1.319 3.608-.975-.975-2.242 1.257-3.608 1.319-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.366-.062-2.633-.344-3.608-1.319-.975-.975-1.257-2.242-1.319-3.608-.058-1.266-.07-1.646-.07-4.85s.012-3.584.07-4.85c.062-1.366.344-2.633 1.319-3.608.975-.975 2.242-1.257 3.608-1.319 1.266-.058 1.646-.07 4.85-.07zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>
                        <a href="#" class="hover:text-white/80 transition-colors" aria-label="LinkedIn">
                            <svg class="w-6 h-6 fill-current" viewBox="0 24 24">
                                <path
                                    d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                            </svg>
                        </a>
                    </div>
                    <a href="mailto:support@saferwealth.com"
                        class="text-white/70 hover:text-white text-sm transition-colors">support@saferwealth.com</a>
                </div>

                <!-- Site Links -->
                <div>
                    <h4 class="font-semibold mb-4 text-white">Navigate</h4>
                    <ul class="space-y-3 text-white/70 text-sm">
                        <li><a href="{{ url('/') }}#how-it-works" class="hover:text-white transition-colors">How It
                                Works</a></li>
                        <li><a href="{{ url('/') }}#benefits" class="hover:text-white transition-colors">Benefits</a>
                        </li>
                        <li><a href="{{ url('/') }}#faq" class="hover:text-white transition-colors">FAQ</a></li>
                        <li><a href="{{ url('/') }}#about" class="hover:text-white transition-colors">About</a></li>
                    </ul>
                </div>

                <!-- Legal Links -->
                <div>
                    <h4 class="font-semibold mb-4 text-white">Legal</h4>
                    <ul class="space-y-3 text-white/70 text-sm">
                        <li><a href="{{ route('legal') }}" class="hover:text-white transition-colors">Legal</a></li>
                        <li><a href="{{ route('privacy') }}" class="hover:text-white transition-colors">Privacy
                                Policy</a></li>
                        <li><a href="{{ route('accessibility') }}"
                                class="hover:text-white transition-colors">Accessibility Statement</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>