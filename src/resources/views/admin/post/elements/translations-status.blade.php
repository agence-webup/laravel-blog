@if($isPublished)
    <i class="tag tag--green mr05 right">{{ __("laravel-blog::post.state.published") }}</i>
@elseif($isDraw)
    <i class="tag tag--red mr05 right">{{ __("laravel-blog::post.state.draw") }}</i>
@else
    <i class="tag tag--grey mr05 right">{{ __("laravel-blog::post.state.unknown") }}</i>
@endif