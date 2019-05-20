<div class="card-body collapse show">
    <div class="float-right">
        @if( auth()->user()->id === $user->id )
        <button class="btn btn-outline-info btn-sm btn-rounded" style="margin-top: -8px;" data-toggle="modal" data-target="#bankInfoTabModal">
            @lang('agency::tab-bank-info.modify-btn')
        </button>
        @endif
    </div>

    <h4 class="card-title">@lang('agency::tab-bank-info.info-bank-label')</h4>
    <hr>
   
    <p class="card-text">
        <strong>@lang('agency::tab-bank-info.name-bank-label')</strong> 
        {!! $bankInfo ? $bankInfo->bank_name : '<small class="text-muted"><i>No establecido</i></small>' !!}
    </p>

    <p class="card-text">
        <strong>@lang('agency::tab-bank-info.route-bank-label')</strong> 
        {!! $bankInfo ? $bankInfo->account_route : '<small class="text-muted"><i>No establecido</i></small>' !!}
    </p>

    <p class="card-text">
        <strong>@lang('agency::tab-bank-info.account-number-label')</strong> 
        {!! $bankInfo ? $bankInfo->account_number : '<small class="text-muted"><i>No establecido</i></small>' !!}
    </p>
</div>

@include('agency::modals.update-bank-info-tab')