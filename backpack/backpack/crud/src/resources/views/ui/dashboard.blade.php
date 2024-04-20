@extends(backpack_view('blank'))



@php
    $widgets['before_content'][]=[
        'type'  => 'jumbotron',
        'heading'   => trans('backpack::base.welcome'),
        'content'   => trans('backpack::base.use_sidebar'),
        'button_link' => backpack_url('logout'), 
        'button_text' => trans('backpack::base.logout'),
        
    ];
    
        ->to('before_content')
        ->type('div')
        -class('row mt-3')
        ->content([
            Widget::make()
                ->'type'          => 'progress_white',
                ->'class'         => 'card mb-2',
                ->'value'         => '11.456',
                ->'description'   => 'Registered users.',
                ->'progress'      => 57, // integer
                ->'progressClass' => 'progress-bar bg-primary',
                ->'hint'          => '8544 more until next milestone.',
            
        ]);

@endphp




@section('content')
    
@endsection
