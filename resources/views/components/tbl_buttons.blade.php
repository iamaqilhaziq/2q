@isset($create)
<a role="button" href="{{ $create['route'] ?? '#' }}" class="btn btn-info float-right ml-2" @isset($create['attribute']) {!! $create['attribute'] !!} @endisset>
    <i class="fa fa-plus"></i>
    {{ trans('buttons.create_with_label', ['label' => array_key_exists("label", $create) ? $create['label'] : null]) }}
</a>
@endisset