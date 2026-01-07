<x-customer.layouts.auth :title="'Customer Login'">
    <div class="min-h-screen flex items-center justify-center bg-base-200">
        <div class="card w-full max-w-md shadow-xl bg-base-100">
            <div class="card-body">

                <h1 class="text-3xl font-bold text-center">Customer Login</h1>
                <p class="text-center text-base-content/70 mb-4">
                    Sign in to access your account
                </p>

                <form method="POST" action="{{ route('customer.login.submit') }}" class="space-y-4">
                    @csrf

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Email</span>
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="input input-bordered w-full @error('email') input-error @enderror"
                            placeholder="customer@example.com" autofocus />
                        @error('email')
                            <label class="label mt-1">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="form-control">
                        <label class="label font-semibold">Password</label>
                        <div class="relative password-input-div">
                            <input type="password" id="password" name="password" placeholder="**********"
                                class="input input-bordered w-full pr-12 @error('password') input-error @enderror" />
                            <label class="swap swap-rotate absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer">
                                <input type="checkbox" onclick="togglePassword(this)" />
                                <span class="swap-off">👁</span>
                                <span class="swap-on">🙈</span>
                            </label>
                        </div>
                        @error('password')
                            <label class="label mt-1">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-full mt-3">
                        Login
                    </button>
                </form>

                <p class="text-center text-xs text-base-content/50 mt-6">
                    © {{ date('Y') }} Multi Auth Product System
                </p>
            </div>
        </div>
    </div>
    <script>
        function togglePassword(checkbox) {
            const wrapper = checkbox.closest('.password-input-div');
            const input = wrapper.querySelector('input[type="password"], input[type="text"]');
            if (!input) return;
            input.type = checkbox.checked ? 'text' : 'password';
        }
    </script>
</x-customer.layouts.auth>
