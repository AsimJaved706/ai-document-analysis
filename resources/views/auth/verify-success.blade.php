<x-guest-layout>
    <div class="mb-8 text-center">
        <!-- Success Icon -->
        <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-emerald-100 mb-6">
            <svg class="h-8 w-8 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </div>

        <h2 class="text-3xl font-bold text-teal-900 mb-4">Email Verified!</h2>
        <p class="text-teal-700 text-lg mb-8">
            Thank you for successfully verifying your email address.
        </p>

        <div class="bg-teal-50 rounded-lg p-6 mb-8 text-left border border-teal-100">
            <h3 class="font-semibold text-teal-900 mb-2">Next Steps</h3>
            <p class="text-sm text-teal-700">
                Please proceed below to access your document checklist and begin your application process. Our team will
                assist you shortly.
            </p>
        </div>

        <a href="{{ route('dashboard') }}"
            class="w-full inline-flex justify-center items-center px-4 py-3 auth-btn-primary text-base font-semibold">
            Proceed to Document Checklist
            <svg class="ml-2 -mr-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                    clip-rule="evenodd" />
            </svg>
        </a>
    </div>
</x-guest-layout>