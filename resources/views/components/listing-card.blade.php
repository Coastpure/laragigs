<!--this makes the listings part to one component, eg, put the six listings in one component--->

@props(['listing']) <!-- make props to access listing, this is the name of the componet i.e 'listing'--> 

<x-card> <!--wrap around the card, this card component file name is card.blade.php-->
    <div class="flex">
        <img
            class="hidden w-48 mr-6 md:block "
            src="{{asset('images/no-image.png')}}"
            alt=""
        />
        <div class="">
            <h3 class="text-2xl">
                <a href="/listings/{{$listing->id}}">{{$listing->title}}</a> 
            </h3>
            <div class="text-xl font-bold mb-4">{{$listing->company}}</div>
            <x-listing-tags :tagsCsv="$listing->tags" /> <!--call the tags,  located on card.blade.php-->
            
            <div class="text-lg mt-4">
                <i class="fa-solid fa-location-dot"></i> {{$listing->location}}
            </div>
        </div>
    </div>
</x-card>