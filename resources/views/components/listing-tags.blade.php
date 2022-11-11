<!--this component is what contains the listing tags i.e laravel, api, backend-->

@props(['tagsCsv']) <!--tagsCsv is the name of the component-->

@php //to loop through and display the tags as an array
    $tags = explode(',', $tagsCsv); /*create tags variable i.e $tags, used comma to split the string where the commas are located
    second argument is the prop i.e $tagsCsv*/
@endphp

<ul class="flex">
    @foreach ($tags as $tag)  <!--make the tags come from the database-->
        
    <li
        class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs"
    >
        <a href="/?tag={{$tag}}">{{$tag}}</a> <!--we also want to click on a tag and filter the listings by that tag 
           thats why on the href we put "/?tag={[$tag}} 
           eg if you hover on api tag it will show aragigs.test/?tag=api" -->
    </li>
    @endforeach
</ul>