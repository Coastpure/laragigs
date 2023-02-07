
<section
class="relative w-full h-48 flex flex-col justify-center align-center text-center space-y-4 mb-4"
style="background-image: url('images/hero2.jpg')"
>
<div
    class="absolute top-0 left-0 w-full h-full opacity-10 bg-no-repeat bg-center"
    style="background-image: url('images/laravel-logo.png')"
></div>

<div class="z-10">
    <h1 class="hidden sm:block text-6xl font-bold uppercase text-white">
        <span class="text-black"></span>
    </h1>
    <p class="hidden sm:block text-2xl text-gray-200 font-bold my-4">
        Find or post jobs & projects
    </p>
    <div>
        <a
            href="/register"
            class="inline-block border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:text-black hover:border-black"
            >Sign Up to List a Gig</a
        >
    </div>
    <div class="pb-4">
        @include('partials._search')
    </div>
</div>
</section>