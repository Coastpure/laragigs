<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24 bg-orange-200">
                    <header class="text-center">
                        <h2 class="text-2xl font-bold uppercase mb-1">
                            Forgot Password
                        </h2>
                        <p class="mb-4">Enter email address attatched to this account </p>
                    </header>

                    <form method="POST" action="/forgotPassword">
                        @csrf
                        <div class="mb-6">
                            <label for="email" class="inline-block text-lg mb-2"
                                >Email</label
                            >
                            <input
                                type="email"
                                class="border border-gray-200 rounded p-2 w-full"
                                name="email" value="{{old('email')}}"
                            />

                            @error('email')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="mb-6 flex flex-row items-center justify-between">
                            <button
                                type="submit"
                                class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                            >
                                Send Reset Link
                            </button>
                            <a href="/resetpass">reset</a>
                            {{-- "/listings/{{$listing->id}}/edit"        --}}
                        </div>

                        
                    </form>
    </x-card>
</x-layout>