<div class="col-3 border p-t-10 p-b-10" id="extra-info-{{ $info->id }}">
    <div class="d-inline float-right">
    	<button type="button" onclick="deleteExtraInfo({{ $info->id }})" class="btn text-white btn-danger btn-sm"> <i class="ti-trash"></i></button>
    </div>
    <div class="clearfix"></div>
    <div class="text-center p-10">
        <h2><strong>{{ $info->value }}</strong></h2> <hr> 
        {{ trans('sitrep-extra-info-' . $emergency->id . '-list.' . $info->slug) }}
    </div>
</div>