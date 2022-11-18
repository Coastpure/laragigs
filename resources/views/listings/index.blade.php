<x-layout> <!--the layout is now a component, if you want to add a new view all you have to do is wrap x-layout around it
    instead of doind extending and section , it comes from layout.blade.php-->
    
@include('partials._hero')
@include('partials._search')



<div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4" >


@if(count($listings) == 0)
<p>No listings found</p>
@endif

@foreach($listings as $listing)
<x-listing-card :listing="$listing" /> <!-- x-listing-card to access the card component,
     to pass in a variable, ie $listing, you must add : before listing
    name of component is listing, from props(['listing'])
    file name of component is listing-card.blade.php-->

@endforeach

</div>

<div class="mt-6 p-4">
    {{$listings->links()}}
</div>
</x-layout>
