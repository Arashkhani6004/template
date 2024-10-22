<div class="{{@$data['class'] != null ? @$data['class'] : 'col-sm-6 col-12'}} p-2">
    <div class="form-group">
        <label for="">{{@$data['p_name']}}</label>
        <input requiredCms type="text" class="form-control bg-light rounded-custom" name="{{@$data['type']}}[{{@$data['key']}}]" placeholder="" value="{{@$data['value']}}" >
    </div>
</div>
