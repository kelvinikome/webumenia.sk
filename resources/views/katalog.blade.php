@extends('layouts.master')

@section('title')

    @if (!empty($search))
        {{ trans('katalog.title_searched') }} "{!!$search!!}"
    @else
        @if (($year_from > $year_min) || ($year_until < $year_max))
            {!! getTitleWithFilters('App\Item', $input, ' | ', $year_from, $year_until) !!}
        @else
            {!! getTitleWithFilters('App\Item', $input, ' | ') !!}
        @endif
        {{ trans('katalog.title') }}
    @endif
    |
    @parent
@stop

@section('link')
    @include('includes.pagination_links', ['paginator' => $paginator])
    <link rel="canonical" href="{!! getCanonicalUrl() !!}">
@stop

@section('content')

<section class="filters">
    <div class="container content-section"><div class="expandable">
            {!! Form::open(array('id'=>'filter', 'method' => 'get')) !!}
            {!! Form::hidden('search', @$search) !!}
            <div class="row">
                <!-- <h3>Filter: </h3> -->
                <div  class="col-md-4 col-xs-6 bottom-space">
                        {!! Form::select('author', array('' => '') + $authors, @$input['author'], array('class'=> 'custom-select form-control', 'data-placeholder' => trans('katalog.filters_author'))) !!}
                 </div>
                <div  class="col-md-4 col-xs-6 bottom-space">
                        {!! Form::select('work_type', array('' => '') + $work_types,  @$input['work_type'], array('class'=> 'custom-select form-control', 'data-placeholder' => trans('katalog.filters_work_type'))) !!}
                </div>
                <div  class="col-md-4 col-xs-6 bottom-space">
                        {!! Form::select('tag', array('' => '') + $tags, @$input['tag'], array('class'=> 'custom-select form-control', 'data-placeholder' => trans('katalog.filters_tag'))) !!}
                </div>
                <div  class="col-md-4 col-xs-6 bottom-space">
                        {!! Form::select('gallery', array('' => '') + $galleries, @$input['gallery'], array('class'=> 'custom-select form-control', 'data-placeholder' => trans('katalog.filters_gallery'))) !!}
                </div>
                <div  class="col-md-4 col-xs-6 bottom-space">
                        {!! Form::select('topic', array('' => '') + $topics, @$input['topic'], array('class'=> 'custom-select form-control', 'data-placeholder' => trans('katalog.filters_topic'))) !!}
                </div>
                <div  class="col-md-4 col-xs-6 bottom-space">
                        {!! Form::select('technique', array('' => '') + $techniques, @$input['technique'], array('class'=> 'custom-select form-control', 'data-placeholder' => trans('katalog.filters_technique'))) !!}
                </div>
                <div class="col-md-4 col-xs-6">
                        <div class="checkbox">
                            {!! Form::checkbox('has_image', '1', @$input['has_image'], ['id'=>'has_image']) !!}
                            <label for="has_image">
                              {{ trans('katalog.filters_has_image') }}
                            </label>
                        </div>
                </div>
                <div class="col-md-4 col-xs-6">
                        <div class="checkbox">
                            {!! Form::checkbox('has_iip', '1', @$input['has_iip'], ['id'=>'has_iip']) !!}
                            <label for="has_iip">
                              {{ trans('katalog.filters_has_iip') }}
                            </label>
                        </div>
                </div>
                <div class="col-md-4 col-xs-6">
                        <div class="checkbox">
                            {!! Form::checkbox('is_free', '1', @$input['is_free'], ['id'=>'is_free']) !!}
                            <label for="is_free">
                              {{ trans('katalog.filters_is_free') }}
                            </label>
                        </div>
                </div>
            </div>
            <div class="row mt-10">
                <div class="col-xs-6 col-sm-1 text-left text-sm-right">
                    <input class="sans" id="from_year" maxlength="4" pattern="[0-9]{1-4}" step="5" value="{{ $year_from }}" />
                </div>
                <div class="col-xs-6 col-sm-1 col-sm-push-10 text-right text-sm-left ">
                    <input class="sans" id="until_year"  maxlength="4" pattern="[0-9]{1-4}" step="5" value="{{ $year_until }}" />
                </div>
                <div class="col-xs-12 col-sm-10 col-sm-pull-1">
                    @include('components.year_slider', ['id' => 'yearRangeFilter'])
                    @include('components.year_slider_js', [
                        'yearRange' => $year_from . ', ' . $year_until,
                        'min' => $year_min,
                        'max' => $year_max,
                        'id' => 'yearRangeFilter'
                        ])
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-10 col-md-push-1">
                    <div class="color-picker">
                        @include('components.color_picker', ['id'=>'colorpicker'])
                        @include('components.color_picker_js', ['id' => 'colorpicker', 'color' => $color])
                    </div>
                </div>
            </div>
            {!! Form::hidden('color', @$input['color'], ['id'=>'color']) !!}
            {!! Form::hidden('sort_by', @$input['sort_by'], ['id'=>'sort_by']) !!}
            {!! Form::hidden('year-range', @$input['year-range'], ['id'=>'year-range']) !!}
            {!! Form::close() !!}
        </div>
    </div>
</section>

@foreach ($items as $i=>$item)
    @if ( ! $item->hasTranslation(App::getLocale()) )
        <section>
            <div class="container content-section">
                <div class="row">
                    @include('includes.message_untranslated')
                    @break
                </div>
            </div>
        </section>
    @endif
@endforeach

<section class="catalog" data-searchd-engine="{!! Config::get('app.searchd_id') !!}">
    <div class="container content-section">
            <div class="row content-section">
            	<div class="col-xs-6">
                    @if (!empty($search))
                        <h4 class="inline">{{ utrans('katalog.catalog_found_artworks') }} &bdquo;{!! $search !!}&ldquo; (<span data-searchd-total-hits>{!! $items->total() !!}</span>) </h4>
                    @else
                		<h4 class="inline">{!! $items->total() !!} {{ trans('katalog.catalog_artworks') }} </h4>
                    @endif
                    @if ($items->count() == 0)
                        <p class="text-center">{{ utrans('katalog.catalog_no_artworks') }}</p>
                    @endif

                    @if (count(Input::all()) > 0)
                        <a class="btn btn-sm btn-default btn-outline sans" href="{!! URL::to('katalog')!!}">{{ trans('general.clear_filters') }}  <i class="icon-cross"></i></a>
                    @endif

                    @if ($color)
                        <a class="btn btn-sm btn-default btn-outline sans" href="{!! URL::to('katalog')!!}" id="clear_color">{{ trans('general.clear_color') }} <span class="picked-color" style="background-color: #{{ $color }};">&nbsp;</span> <i class="icon-cross"></i></a>
                    @endif
                </div>
                <div class="col-xs-6 text-right">
                    <div class="dropdown">
                      <a class="dropdown-toggle" type="button" id="dropdownSortBy" data-toggle="dropdown" aria-expanded="true">
                        {{ trans('general.sort_by') }} {{ trans($sort_options[$sort_by]) }}
                        <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu dropdown-menu-right dropdown-menu-sort" role="menu" aria-labelledby="dropdownSortBy">
                        @foreach ($sort_options as $key => $label)
                            @if ($key != $sort_by)
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#" rel="{{ $key }}">{{ trans($label) }}</a></li>
                            @endif
                        @endforeach
                      </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 isotope-wrapper">
                    <?php // $items = $items->paginate(18) ?>
                    <div id="iso">
                        @foreach ($items as $i=>$item)
                            @include('components.artwork_grid_item', [
                                'item' => $item,
                                'isotope_item_selector_class' => 'item',
                                'class_names' => 'col-md-3 col-sm-4 col-xs-6',
                            ])
                        @endforeach
                    </div>
                    <div class="col-sm-12 text-center">
                        {!! $paginator->appends(@Input::except('page'))->render() !!}
                        @if ($paginator->hasMorePages() )
                            <a id="next" href="{!! URL::to('katalog')!!}"><svg xmlns="http://www.w3.org/2000/svg" width="100px" height="100px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve"> <path d="M0.492,8.459v83.427c4.124,0.212,7.409,3.497,7.622,7.622h83.357
        c0.22-4.265,3.719-7.664,8.036-7.664V8.571c-4.46,0-8.079-3.617-8.079-8.079H8.157C8.157,4.774,4.755,8.239,0.492,8.459z"/>
<text text-anchor="middle" alignment-baseline="middle" x="50" y="50">
    {{ trans('katalog.catalog_show_more') }}
  </text>
   </svg></a>
                        @endif
                    </div>
                </div>

            </div>
    </div>
</section>


@stop

@section('javascript')

{!! Html::script('js/bootstrap-slider.min.js') !!}
{{-- {!! Html::script('js/bootstrap-checkbox.js') !!} --}}
{!! Html::script('js/selectize.min.js') !!}
{!! Html::script('js/readmore.min.js') !!}
<script src="{!! asset_timed('js/scroll-frame.js') !!}"></script>

<script type="text/javascript">

// start with isotype even before document is ready
$('.isotope-wrapper').each(function(){
    var $container = $('#iso', this);
    spravGrid($container);
});

$(document).ready(function(){
    // $('.expandable').readmore({
    //     moreLink: '<a href="#" class="text-center">viac možností <i class="icon-arrow-down"></i></a>',
    //     lessLink: '<a href="#" class="text-center">menej možností <i class="icon-arrow-up"></i></a>',
    //     maxHeight: 40,
    //     // blockCSS: 'display: block;',
    //     // embedCSS: false,
    //     afterToggle: function(trigger, element, expanded) {
    //       // if(! expanded) { // The "Close" link was clicked
    //         // $('html, body').animate( { scrollTop: element.offset().top }, {duration: 100 } );
    //       // }
    //     }
    // });

    // $('.checkbox').checkbox();

    $("form").submit(function()
    {
        $(this).find('input[name], select[name]').each(function(){
            if (!$(this).val()){
                $(this).data('name', $(this).attr('name'));
                $(this).removeAttr('name');
            }
        });
        if ( $('#year-range').val()=='{{$year_min}},{{$year_max}}' ) {
            $('#year-range').attr("disabled", true);
        }
    });

    yearRangeFilter.$on('change', function(range) {
        $('#year-range').val(range.join(','));
        $('#filter').submit();
    });
    yearRangeFilter.$on('slide', function(range) {
        $('#from_year').val(range[0]);
        $('#until_year').val(range[1]);
    });

    colorpicker.$on('change', function(clr){
        $('#color').val(clr.hex.substr(1));
        $('#filter').submit();
    })
    $('#from_year,#until_year').on('change', function(event){
        const min = {{ $year_min }};
        const max = {{ $year_max }};
        const fy = +$('#from_year').val().replace(/\D/g, '')
        const uy = +$('#until_year').val().replace(/\D/g, '');
        const from = Math.min(Math.max(min, fy), max);
        const until = Math.max(Math.min(max, uy), min);
        $('#year-range').val([from,until].sort().join(','));
        $('#filter').submit();
    })



    // $(".custom-select").chosen({allow_single_deselect: true})
    $(".custom-select").selectize({
        plugins: ['remove_button'],
         // maxItems: 2,
        maxItems: 1,
        placeholder: $(this).attr('data-placeholder'),
        mode: 'multi',
        render: {
                 // option: function(data, escape) {
                 //     return '<div class="option">' +
                 //             '<span class="title">' + escape(data.value) + '</span>' +
                 //             '<span class="url">' + escape(data.value) + '</span>' +
                 //         '</div>';
                 // },
                 item: function(data, escape) {
                     return '<div class="selected-item">'  + '<span class="color">'+this.settings.placeholder+': </span>' +  data.text.replace(/\(.*?\)/g, "") + '</div>';
            }
        }
    });

    $(".custom-select, input[type='checkbox']:not(#use_color)").change(function() {
        var form = $(this).closest('form');
        form.submit();
    });

    $(".dropdown-menu-sort a").click(function(e) {
        e.preventDefault();
        $('#sort_by').val($(this).attr('rel'));
        $('#filter').submit();
    });

    // clear color filter
    $("#clear_color").click(function(e){
        e.preventDefault();
        $('input#color').val('');
        $('#filter').submit();
    });

    var $container = $('#iso');

    $( window ).resize(function() {
        spravGrid($container);
    });

    $container.infinitescroll({
        navSelector     : ".pagination",
        nextSelector    : ".pagination a:last",
        itemSelector    : ".item",
        debug           : false,
        dataType        : 'html',
        path            : undefined,
        bufferPx     : 200,
        loading: {
            msgText: '<i class="fa fa-refresh fa-spin fa-lg"></i>',
            img: '/images/transparent.gif',
            finishedMsg: '{{ utrans('katalog.catalog_finished') }}'
        }
    }, function(newElements, data, url){
        history.replaceState({infiniteScroll:true}, null, url);
        var $newElems = jQuery( newElements ).hide();
        $container.isotope( 'appended', $newElems );
    });

    $(window).unbind('.infscr'); //kill scroll binding


    // fix artwork detail on iOS https://github.com/artsy/scroll-frame/issues/30
    if (!isMobileSafari() && !isIE()) {
      scrollFrame('.item a');
    }


    $('a#next').click(function(){
        $(this).fadeOut();
        $container.infinitescroll('bind');
        $container.infinitescroll('retrieve');
        return false;
    });



});

</script>
@stop
