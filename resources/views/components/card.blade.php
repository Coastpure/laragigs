<!--this is a card component that wraps around whatever we want we wrap is as x-card /xcard -->


<!-- this is the backgroung where a single listing is contained in the listings where image, description, tags, location is contained, 
    it is also found in the single listing page-->

<div {{$attributes->merge(['class' => 'bg-gray-50 border border-gray-200 rounded p-6']) }} > <!--attributes helps to make
    another class work or add another class not included here when calling it on x-card
    it will use the above classes by default but it will also merge other classes we add on the x-card class = ''-->
{{$slot}} <!--sloth helps to wrap around the card, it adds the contents of the card 
            whatever we soround the x tags with will be output here-->

</div>
