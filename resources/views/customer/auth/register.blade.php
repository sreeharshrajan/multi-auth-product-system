<x-customer.layouts.auth :title="'Customer Register'">
    <div class="min-h-screen flex items-center justify-center bg-base-200">
        <div class="card w-full max-w-md shadow-xl bg-base-100">
            <div class="card-body">
                <h1 class="text-3xl font-bold text-center">Customer Register</h1>
                <p class="text-center text-base-content/70 mb-4">
                    Create your account
                </p>
                <form method="POST" action="{{ route('customer.register.submit') }}" class="space-y-4">
                    @csrf
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Name</span>
                        </label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="input input-bordered w-full @error('name') input-error @enderror"
                            placeholder="Your Name" autofocus />
                        @error('name')
                            <label class="label mt-1">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Email</span>
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="input input-bordered w-full @error('email') input-error @enderror"
                            placeholder="customer@example.com" />
                        @error('email')
                            <label class="label mt-1">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>
                    <div class="form-control">
                        <label class="label font-semibold">Password</label>
                        <input type="password" name="password"
                            class="input input-bordered w-full @error('password') input-error @enderror"
                            placeholder="**********" />
                        @error('password')
                            <label class="label mt-1">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>
                    <div class="form-control">
                        <label class="label font-semibold">Confirm Password</label>
                        <input type="password" name="password_confirmation"
                            class="input input-bordered w-full" placeholder="**********" />
                    </div>
                    <button type="submit" class="btn btn-primary w-full mt-3">
                        Register
                    </button>
                </form>
                <p class="text-center text-xs text-base-content/50 mt-6">
                    © {{ date('Y') }} Multi Auth Product System
                </p>
            </div>
        </div>
    </div>
</x-customer.layouts.auth>
