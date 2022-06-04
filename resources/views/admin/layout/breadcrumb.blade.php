<div class="container px-4 breadcrumb my-1">
    <h4>
        Home
        <i class="fas fa-chevron-right fs-6"></i>
        <small class="text-muted">{{$data->breadcrumb}}</small>
        @if($data->breadcrumbsub != 1)
        <i class="fas fa-chevron-right fs-6"></i>
        <small class="text-muted">{{$data->breadcrumbsub}}</small>
        @endif
    </h4>
</div>